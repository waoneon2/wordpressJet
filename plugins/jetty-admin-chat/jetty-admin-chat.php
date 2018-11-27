<?php
/**
 * @package Jetty Admin Chat
 * @version 1.0
 */
/*
Plugin Name: Jetty Admin Chat
Plugin URI: https://jettyapp.com/
Description: Jetty Admin Chat
Author: Jetty Team
Version: 1.0
Author URI: https://jettyapp.com/
Text Domain: jchat

*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Required if your environment does not handle autoloading
require plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;

$options          = NULL;
$options_two      = NULL;
$options_three    = NULL;
$error_notif      = '';
$services_arr     = [];
$bol_not_set      = FALSE;
$bol_on_settings  = TRUE;
$bol_other_settings = TRUE;
$bol_empty_service  = FALSE;
$bol_set_api_key = FALSE;
$default_service_sid    = get_option('jchat_default_service_sid', '' );
$default_key_sid        = get_option('jchat_default_key_sid', '' );
$default_key_secret     = get_option('jchat_default_key_secret', '' );
$sid = NULL;
$token = NULL;
$on_submit = FALSE;
$services_arr_id = [];
$client = NULL;

define("JCHAT_DEFAULT_SERVICE_NAME", "Jetty Default Service", true);
define("JCHAT_DEFAULT_API_KEY_NAME", "User Jetty Team", true);

if(is_multisite()){
    $current_site = get_current_site();
    if(get_option('twilio_subaccount_' . $current_site->id) === FALSE && get_option('twilio_authtoken_' . $current_site->id) === FALSE){
        if(defined('TWILIO_ACCOUNTSID') && defined('TWILIO_AUTHTOKEN')){
            $sid     = TWILIO_ACCOUNTSID;
            $token   = TWILIO_AUTHTOKEN;
            $bol_on_settings = FALSE;
        } else {
            $sid    = isset( get_option( 'jchat_option_name' )['twilio_accountsid']) ? esc_attr( get_option( 'jchat_option_name' )['twilio_accountsid']) : '';
            $token  = isset( get_option( 'jchat_option_name' )['twilio_authtoken']) ? esc_attr( get_option( 'jchat_option_name' )['twilio_authtoken']) : '';
            $bol_on_settings = TRUE;
        } 
    } else {
        $sid    = get_option('twilio_subaccount_' . $current_site->id);
        $token  = get_option('twilio_authtoken_' . $current_site->id);
        $bol_on_settings = FALSE;
    }
} else {
    if(defined('TWILIO_ACCOUNTSID') && defined('TWILIO_AUTHTOKEN')){
        $sid     = TWILIO_ACCOUNTSID;
        $token   = TWILIO_AUTHTOKEN;
        $bol_on_settings = FALSE;
    } else {
        $sid    = isset( get_option( 'jchat_option_name' )['twilio_accountsid']) ? esc_attr( get_option( 'jchat_option_name' )['twilio_accountsid']) : '';
        $token  = isset( get_option( 'jchat_option_name' )['twilio_authtoken']) ? esc_attr( get_option( 'jchat_option_name' )['twilio_authtoken']) : '';
        $bol_on_settings = TRUE;
    } 
}


if(empty(get_option( 'jchat_option_name' )['twilio_accountsid']) || empty(get_option( 'jchat_option_name_three' )['twilio_api_key_three']) || empty(get_option( 'jchat_option_name_three' )['twilio_api_secret_three'])){
    $bol_other_settings = FALSE;
}

if( (empty($sid) && empty($token)) && (empty($sid) || empty($token)) ){
    $bol_not_set = TRUE;
}

if(!$bol_not_set):
try {
	$client = new Client($sid, $token);

    $services = $client->chat->services->read();
    $fetch_key = $client->keys->read();

    if(empty($fetch_key)){
        $key = $client->newKeys->create(
            array('friendlyName' => JCHAT_DEFAULT_API_KEY_NAME)
        );

        $options_three['twilio_api_key_three'] = $key->sid;
        $options_three['twilio_api_secret_three'] = $key->secret;

        update_option('jchat_option_name_three', $options_three);

        update_option('jchat_default_key_sid', $key->sid );
        update_option('jchat_default_key_secret', $key->secret );
        $bol_set_api_key = FALSE;
        $bol_other_settings = TRUE;
    } else {
        $arr_key = [];
        $ji = 0;

        foreach ($fetch_key as $fkey) {
            $arr_key[$ji] = $fkey->sid;
            $ji++;
        }

        if(in_array($default_key_sid, $arr_key)){

        } else {
            $key_new = $client->newKeys->create(
                array('friendlyName' => JCHAT_DEFAULT_API_KEY_NAME)
            );

            $options_three['twilio_api_key_three'] = $key_new->sid;
            $options_three['twilio_api_secret_three'] = $key_new->secret;

            update_option('jchat_option_name_three', $options_three);

            update_option('jchat_default_key_sid', $key_new->sid );
            update_option('jchat_default_key_secret', $key_new->secret );
        }
        $bol_other_settings = TRUE;
        $bol_set_api_key = TRUE;
    }

    if(!empty($services)){
        $bol_empty_service = FALSE;
        $int_num = 0;
        foreach ($services as $service) {
            $services_arr[$service->friendlyName] = $service->sid;
            $services_arr_id[$int_num] = $service->sid;
            $int_num++;
        }
    } else {
        $bol_empty_service = TRUE;
        $create_service = $client->chat->services->create(JCHAT_DEFAULT_SERVICE_NAME);
        $services_from_create = $client->chat->services->read();
        foreach ($services_from_create as $service) {
            $services_arr[$service->friendlyName] = $service->sid;
        }
        $options_two['twilio_service_instance_sid_two'] = $create_service->sid;
        update_option( 'jchat_option_name_two', $options_two);
    }

    if(get_option( 'jchat_option_name_two' ) === FALSE || empty(get_option( 'jchat_option_name_two' ))) {
        if(!empty($services_arr)){
            $first_choose = array_values($services_arr)[0];
            update_option('jchat_default_service_sid', $first_choose );
        }
    } else {
        if(!in_array(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'], $services_arr_id)){
            $f_t = $services_arr_id[0];
            $options_two['twilio_service_instance_sid_two'] = $f_t;
            update_option( 'jchat_option_name_two', $options_two);
        }
    }
} catch (Exception $e) {
	$error_notif = 'Caught exception: '.$e->getMessage();
}
endif;

function jchat_ajax_url(){
    $ajaxUrl = site_url().'/wp-admin/admin-ajax.php';
    return $ajaxUrl;
}

function jchat_handle_ajax_req(){
    global $default_key_sid, $default_key_secret, $default_service_sid, $sid;

    $user = wp_get_current_user();
    $appName = 'JettyAdminChat';

    $identity = $user->user_email;

    $userEmail = $user->user_email;

    $userAvatarUrl = esc_url( get_avatar_url( $user->ID ) );

    $endpointId = $appName . ':' . $identity . ':' . $userEmail;

    if(!empty(get_option( 'jchat_option_name_three' )['twilio_api_key_three']) && !empty(get_option( 'jchat_option_name_three' )['twilio_api_secret_three'])){
        $token = new AccessToken(
            $sid,
            get_option( 'jchat_option_name_three' )['twilio_api_key_three'],
            get_option( 'jchat_option_name_three' )['twilio_api_secret_three'],
            86400,
            $identity
        );
    } else {
        $token = new AccessToken(
            $sid,
            $default_key_sid,
            $default_key_secret,
            86400,
            $identity
        );
    }

    // Grant access to Chat
    if (!empty(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'])) {
        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two']);
        $chatGrant->setEndpointId($endpointId);
        $token->addGrant($chatGrant);
    } else {
        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid($default_service_sid);
        $chatGrant->setEndpointId($endpointId);
        $token->addGrant($chatGrant);
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array(
        'identity' => $identity,
        'token' => $token->toJWT(),
        'userEmail' => $userEmail,
        'userAvatarUrl' => $userAvatarUrl
    ));
    die();
}
add_action( 'wp_ajax_jchat_handle_ajax_req', 'jchat_handle_ajax_req' );

function jchat_handle_retrieve_all_users_chat(){
    global $client;

    if(isset($_POST['jchat_key_rt']) && $_POST['jchat_key_rt'] === 'jchat_rau'){
        $service = get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'];
        $arr_users_twilio = [];
        $loop_int_tw = 0;
        $users = $client->chat
            ->services($service)
            ->users
            ->read();

        foreach ($users as $user) {
            $arr_users_twilio[$loop_int_tw] = $user->identity;
            $loop_int_tw++;
        }

        if(!empty($arr_users_twilio)){
            echo json_encode(array(
                'error' => false,
                'message' => 'Users on Twilio',
                'content' => $arr_users_twilio
            ));
        } else {
            echo json_encode(array(
                'error' => true,
                'message' => 'No users',
                'content' => 'empty'
            ));
        }
    } else {
        echo json_encode(array(
            'error'   => true,
            'message' => 'Failed to retieve all users on twilio',
            'content' => ''
        ));
    }

    die();
}
add_action( 'wp_ajax_jchat_handle_retrieve_all_users_chat', 'jchat_handle_retrieve_all_users_chat' );

function jchat_get_all_user_handle(){

    if(isset($_POST['jchat_key']) && $_POST['jchat_key'] === 'jchat_get_all_user'){
        $blogusers = get_users( 'orderby=nicename' );
        $current_user = wp_get_current_user();
        $arrUser = [];
        $intLoop = 0;
        foreach ( $blogusers as $user ) {
            if($user->user_email !== $current_user->user_email){
                $arrUser[$intLoop] = [
                    'user_id' => $user->ID,
                    'username' => $user->user_nicename,
                    'user_email' => $user->user_email
                ];
            }
            $intLoop++;

        }
        if(!empty($arrUser)){
            echo json_encode(array(
                'error' => false,
                'message' => 'User Collection',
                'content' => $arrUser
            ));
        } else {
            echo json_encode(array(
                'error' => true,
                'message' => 'No users',
                'content' => 'empty'
            ));
        }
    }
    
    die();
}
add_action( 'wp_ajax_jchat_get_all_user_handle', 'jchat_get_all_user_handle' );

function jchat_get_all_user_wp(){
    $ar = [];
    $kLoop = 0;
    $blogusers = get_users( 'orderby=nicename' );
    foreach ($blogusers as $user) {
        $ar[$kLoop] = $user->user_email;
        $kLoop++;
    }

    return $ar;
}

function jchat_list_all_member_on_channel($channel){
    global $bol_not_set, $client;

    $allMembers = [];
    $iLoop = 0;

    if(!$bol_not_set){
        $service = get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'];
        $currentChannel = $channel;

        $members = $client->chat
            ->services($service)
            ->channels($currentChannel)
            ->members
            ->read();
        foreach ($members as $member) {
            $allMembers[$iLoop] = $member->identity;
            $iLoop++;
        }

        return $allMembers;
    }

    return false;
}

function jchat_add_member_on_channel(){
    global $bol_not_set, $client;

    if(isset($_POST['key_jchat_']) && $_POST['key_jchat_'] === 'jchat_get_all_member'){
        if(!$bol_not_set){
            $currChannel = $_POST['jchat_curr_channel'];
            $restData = jchat_list_all_member_on_channel($currChannel);
            $currEmail = $_POST['jchat_user_email'];

            if(!in_array($currEmail, $restData)){
                $member = $client->chat
                    ->services(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'])
                    ->channels($currChannel)
                    ->members
                    ->create($currEmail);
                echo json_encode(array(
                    'error'   => false,
                    'message' => 'User Added to channel',
                    'content' => $member
                )); 
            } else {
                echo json_encode(array(
                    'error'   => true,
                    'message' => 'User exists',
                    'content' => ''
                )); 
            }
        }
    } else {
        echo json_encode(array(
            'error'   => true,
            'message' => 'Failed',
            'content' => ''
        ));
    }

    die();
}

add_action( 'wp_ajax_jchat_add_member_on_channel', 'jchat_add_member_on_channel' );

function jchat_get_all_channel(){
    global $bol_not_set, $client;

    $arrCh = [];
    $arrMember = [];
    $lLoop = 0;
    $eLopp = 0;

    $current_user = new WP_User(wp_get_current_user()->ID);
    if(is_array($current_user->roles)){
        $user_role = $current_user->roles[0];
    } else {
        $user_role = $current_user->roles;
    }

    if(isset($_POST['key_jchat_gac']) && $_POST['key_jchat_gac'] === 'jchat_get_l_c_'){
        if(!$bol_not_set){
            $channels = $client->chat
                ->services(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'])
                ->channels
                ->read();

            foreach ($channels as $channel) {
                $date = $channel->dateCreated;

                $arrCh[$lLoop] = [
                    'sid'         => $channel->sid,
                    'accountSid'  => $channel->accountSid,
                    'serviceSid'  => $channel->serviceSid,
                    'friendlyName'=> $channel->friendlyName,
                    'uniqueName'  => $channel->uniqueName,
                    'datetime'    => $date->format('Y-m-d H:i:s'),
                    'type'        => $channel->type,
                    'members'     => [],
                    'hidden_room' => 'no'
                ];

                if($channel->type === 'private'){
                    $members = $client->chat
                    ->services(get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'])
                    ->channels($channel->sid)
                    ->members
                    ->read();

                    foreach ($members as $member) {
                       $arrCh[$lLoop]['members'][] = $member->identity;
                    }
                }

                $lLoop++;
            };

            foreach ($arrCh as $key => $value) {
                
                if($arrCh[$key]['type'] === 'private'){
                    $k_arr = (array) $arrCh[$key]['members'];
                    if(!in_array($current_user->user_email, $k_arr) && $user_role !== 'administrator' && $user_role !== 'network_admin' && $user_role !== 'site_admin'){
                    $arrCh[$key]['hidden_room'] = 'yes';
                    }
                }
            }

            foreach ($arrCh as $key => $part) {
                $sort[$key] = strtotime($part['datetime']);
            }
            array_multisort($sort, SORT_ASC, $arrCh);

            if(!empty($arrCh)){
                echo json_encode(array(
                    'error'     => false,
                    'message'   => '',
                    'content'   => $arrCh,
                    'user_role' => $user_role
                )); 
            } else {
                echo json_encode(array(
                    'error'   => true,
                    'message' => 'Array is empty',
                    'content' => ''
                )); 
            }
        }
    } else {
        echo json_encode(array(
            'error'   => true,
            'message' => 'Failed',
            'content' => ''
        ));
    }

    die();
}

add_action( 'wp_ajax_jchat_get_all_channel', 'jchat_get_all_channel' );

function jchat_get_member_on_channel(){
    if(isset($_POST['channel'])){
        $g_moc = jchat_list_all_member_on_channel($_POST['channel']);
        $h_moc = jchat_get_all_user_wp();
        $_i_o = [];
        $__i = 0;

        $result = array_diff($h_moc, $g_moc);

        foreach ($result as $value) {
           $_i_o[$__i] = $value;
           $__i++;
        }

        echo json_encode(array(
            'error'   => false,
            'message' => 'ok',
            'content' => $_i_o,
            'member_on_channel' => $g_moc
        ));
    }

    die();
    
}
add_action( 'wp_ajax_jchat_get_member_on_channel', 'jchat_get_member_on_channel' );

function jchat_delete_channel(){
    global $client, $bol_not_set;

    if(isset($_POST['channel']) && isset($_POST['channelname']) && isset($_POST['service'])){
        if(!$bol_not_set){
            $client->chat
                ->services($_POST['service'])
                ->channels($_POST['channel'])
                ->delete();

            echo json_encode(array(
                'error'   => false,
                'message' => 'Room deleted !!!',
                'content' => 'room : '.$_POST['channelname'],
            ));
        }
    }

    die();
}
add_action( 'wp_ajax_jchat_delete_channel', 'jchat_delete_channel' );

function jchat_g_m_c(){
    global $client, $bol_not_set;

    $user = wp_get_current_user();
    if(is_array($user->roles)){
        $user_role = $user->roles[0];
    } else {
        $user_role = $user->roles;
    }

    if(isset($_POST['channel'])){
        $allMembers = [];
        $iLoop = 0;

        if(!$bol_not_set){
            $service = get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'];
            $currentChannel = $_POST['channel'];

            $members = $client->chat
                ->services($service)
                ->channels($currentChannel)
                ->members
                ->read();
            foreach ($members as $member) {
                $allMembers[$iLoop] = [
                    'midentity' => $member->identity,
                    'mid' => $member->sid
                ];
                $iLoop++;
            }

            echo json_encode(array(
                'error'   => false,
                'message' => 'ok',
                'content' => $allMembers,
                'user_role' => $user_role
            ));
        }
    }

    die();
}
add_action( 'wp_ajax_jchat_g_m_c', 'jchat_g_m_c' );

function jchat_delete_user_on_channel_handle(){
    global $client, $bol_not_set;

    if(isset($_POST['cid']) && isset($_POST['mid'])){
        $allMembers = [];
        $iLoop = 0;

        if(!$bol_not_set){
            $service = get_option( 'jchat_option_name_two' )['twilio_service_instance_sid_two'];
            $currentChannel = $_POST['cid'];

            $client->chat
                ->services($service)
                ->channels($currentChannel)
                ->members($_POST['mid'])
                ->delete();

            echo json_encode(array(
                'error'   => false,
                'message' => 'user deleted',
            ));
        }
    }
    die();
}
add_action( 'wp_ajax_jchat_delete_user_on_channel_handle', 'jchat_delete_user_on_channel_handle' );

function jchat_enqueue_scripts(){
    $screen = get_current_screen();
    if(!is_customize_preview() && $screen->id !== 'social_page_jetty_social_media_monitoring_setting' && $screen->id !== 'toplevel_page_jetty_social_media_monitoring'){
        wp_enqueue_style( 'jchat-jquery-ui-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), '1.0.0' );
        wp_enqueue_style( 'jchat-fontawesome', plugins_url( 'assets/admin/css/fontawesome/fontawesome-all.css', __FILE__ ), array(), '5.0.6' );
        wp_enqueue_style( 'jchat-style', plugins_url( 'assets/admin/css/jchat_style.css', __FILE__ ), array(), '1.0.0' );

        wp_enqueue_script( 'jchat-twilio-common', 'https://media.twiliocdn.com/sdk/js/common/v0.1/twilio-common.min.js', array('jquery'), '0.1', true );
        wp_enqueue_script( 'jchat-twilio-chat', 'https://media.twiliocdn.com/sdk/js/chat/v1.2/twilio-chat.min.js', array('jquery'), '1.2', true );
        wp_enqueue_script( 'jquery-ui-core','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-widget','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-autocomplete','', array('jquery'), false, true );
        wp_enqueue_script( 'jchat-area-script', plugins_url( 'assets/admin/js/jchat_area.js', __FILE__ ), array('jquery'), '1.0', true );
        wp_localize_script( 'jchat-area-script', 'jchat_ajax_action', array(
            'ajax_url' => jchat_ajax_url()
        ));

        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-autocomplete');

        wp_enqueue_script( 'jchat-dialog-extends', plugins_url( 'assets/admin/js/jquery.dialogextend.min.js', __FILE__ ), array('jquery'), '2.0.3', true );

        wp_enqueue_script( 'jchat-setting-script', plugins_url( 'assets/admin/js/jchat_script.js', __FILE__ ), array('jquery'), '1.0', true );
        wp_localize_script( 'jchat-setting-script', 'jchat_global_ajax_action', array(
            'ajax_url' => jchat_ajax_url()
        ));
    }
    
}
add_action( 'admin_enqueue_scripts', 'jchat_enqueue_scripts' );

function jchat_add_plugin_page(){
    global $error_notif, $bol_not_set, $bol_other_settings;
	add_submenu_page(
        'options-general.php', 
        'Chat Settings',
        'Chat Settings',
        'manage_options', 
        'jchat-twilio-settings', 
        'create_register_twilio_callback'
    );
    // if($bol_other_settings):
    //     if(!$bol_not_set):
    //         if(empty($error_notif)){
    //             add_menu_page('Admin Chat', 'Admin Chat', 'manage_options','jchat_area', 'jchat_chat_area_callback', 'dashicons-format-chat', 25);
    //         }
    //     endif;
    // endif;
    
}
add_action( 'admin_menu', 'jchat_add_plugin_page');

function jchat_chat_area_callback(){
    ?>
    <div class="wrap">
        <h1>Chat Area</h1>

        <div class="ui-widget">
          <label for="jbucket_user_email_search">User (email): </label>
          <input id="jbucket_user_email_search" placeholder="Please enter 3 or more characters">
        </div>

        <section id="jchat_admin_chat">
            <span class="notif_progress"></span>
            <ul id="jchat_roomlist">
                <!-- <li class="jchat_roomls jchat_on_room_plus">+</li> -->
            </ul>
            <div id="jchat_messages"></div>
            <textarea id="chat-input" placeholder="Your message..."></textarea>
        </section>
    </div>
    <?php
}

function jchat_content_inside_container(){
    $user = new WP_User(wp_get_current_user()->ID);
    if(is_array($user->roles)){
        $user_role = $user->roles[0];
    } else {
        $user_role = $user->roles;
    }

    ?>
    <div id="jchat_admin_chat">
        <div id="jchat_admin_content">
            <span class="notif_progress"></span>
            <?php 
            if($user_role === 'administrator' || $user_role === 'network_admin' || $user_role === 'site_admin'):
            ?>
            <div class="on_adding_user">
                <div class="ui-widget">
                    <label for="jbucket_user_email_search">User (email): </label>
                    <input id="jbucket_user_email_search" placeholder="Enter 3 or more chars">
                </div>
            </div>
            <?php endif; ?>

            <div class="jchat_on_create_room">
                <span id="jchat_input_create_room">
                    <input type="text" name="create_room" class="create_room" id="create_room" placeholder="name of room">
                    <input type="checkbox" id="jchat_type_room" name="type_room" value="private">Private
                    <button id="jchat_click_create_room">
                        Create Room
                    </button>
                </span>
            </div>

            <div id="jchat_on_button_room"></div>

            <div class="jchat_member_on_room"></div>

            <div id="jchat_messages"></div>
            <div class="user_is_typing"></div>
            <textarea id="chat-input" placeholder="Your message..."></textarea>
        </div>
    </div>
    <?php
}

function create_register_twilio_callback(){
	global $options, $error_notif, $options_two, $options_three, $bol_not_set, $bol_on_settings, $services_arr;
    // Set class property
    $options = get_option( 'jchat_option_name' );
    $options_two = get_option( 'jchat_option_name_two' );
    $options_three = get_option( 'jchat_option_name_three' );

    if($options_two === FALSE || empty($options_two)) {
        if(!empty($services_arr)){
            $first_choose = array_values($services_arr)[0];
            update_option('jchat_default_service_sid', $first_choose );
        }
    }

    ?>
    <div class="wrap">
    	<?php 
    		$msg = (!empty($error_notif)) ? '<span class="error_notif">'.$error_notif.'</span>' : ''; 
    		echo $msg;
    	?>
        <h1>Chat Settings</h1>
        <?php 
            if($bol_on_settings):
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'jchat_account_auth';
            else:
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'jchat_service_sid';
            endif;
        ?> 
        <h2 class="nav-tab-wrapper"> 
        <?php 
            if($bol_on_settings):
        ?>
            <a href="?page=jchat-twilio-settings&tab=jchat_account_auth" class="nav-tab <?php echo $active_tab == 'jchat_account_auth' ? 'nav-tab-active' : ''; ?>">Account SID & Auth Token Options</a>
        <?php
            endif;
        ?>
        <?php
        if(!$bol_not_set):
            if(empty($error_notif)): 
        ?>
            <a href="?page=jchat-twilio-settings&tab=jchat_service_sid" class="nav-tab <?php echo $active_tab == 'jchat_service_sid' ? 'nav-tab-active' : ''; ?>">Service Instance SID Options</a>
            <a href="?page=jchat-twilio-settings&tab=jchat_api_key_secret" class="nav-tab <?php echo $active_tab == 'jchat_api_key_secret' ? 'nav-tab-active' : ''; ?>">API Key & API Secret Options</a>
        <?php 
            endif;
        endif;
        ?>
        </h2>
        <form method="post" action="options.php">
        <?php
            if($active_tab == 'jchat_account_auth'){
                settings_fields( 'jchat_option_group' );
                do_settings_sections( 'jchat-twilio-settings' );
            } 
            else if( $active_tab == 'jchat_service_sid' ) {
                settings_fields( 'jchat_option_group_two' );
                do_settings_sections( 'jchat-twilio-settings-two' );
            } 
            else if( $active_tab == 'jchat_api_key_secret' ) {
                settings_fields( 'jchat_option_group_three' );
                do_settings_sections( 'jchat-twilio-settings-three' );
            }
            submit_button();
        ?>
        </form>
    </div>
    <?php
}

function jchat_page_init(){
    // Account SID & Auth Token Options
	register_setting(
        'jchat_option_group',
        'jchat_option_name',
        'sanitize'
    );
    add_settings_section(
        'setting_section_id', 
        '',
        'print_section_info',
        'jchat-twilio-settings'
    );  
    add_settings_field(
        'twilio_accountsid', 
        'Account SID',
        'jchat_twilio_accountsid_callback',
        'jchat-twilio-settings',
        'setting_section_id'       
    );      
    add_settings_field(
        'twilio_authtoken', 
        'Auth Token', 
        'jchat_twilio_authtoken_callback', 
        'jchat-twilio-settings', 
        'setting_section_id'
    );

    // Service Instance SID Options
    register_setting(
        'jchat_option_group_two',
        'jchat_option_name_two',
        'sanitize'
    );
    add_settings_section(
        'setting_section_id_two', 
        '',
        'print_section_info',
        'jchat-twilio-settings-two'
    );  
    add_settings_field(
        'twilio_service_instance_sid_two', 
        'Service Instance SID',
        'jchat_twilio_service_instance_sid_callback',
        'jchat-twilio-settings-two',
        'setting_section_id_two'       
    );

    // API Key & API Secret Options
    register_setting(
        'jchat_option_group_three',
        'jchat_option_name_three',
        'sanitize'
    );
    add_settings_section(
        'setting_section_id_three', 
        '',
        'print_section_info',
        'jchat-twilio-settings-three'
    );  
    add_settings_field(
        'twilio_api_key_three', 
        'API Key', 
        'jchat_twilio_api_key_callback', 
        'jchat-twilio-settings-three', 
        'setting_section_id_three'
    );
    add_settings_field(
        'twilio_api_secret_three', 
        'API Secret', 
        'jchat_twilio_api_secret_callback', 
        'jchat-twilio-settings-three', 
        'setting_section_id_three'
    );
}
add_action( 'admin_init', 'jchat_page_init' );

function sanitaze($input){
	$new_input = array();
    if( isset( $input['twilio_accountsid'] ) )
        $new_input['twilio_accountsid'] = sanitize_text_field( $input['twilio_accountsid'] );
    if( isset( $input['twilio_authtoken'] ) )
        $new_input['twilio_authtoken'] = sanitize_text_field( $input['twilio_authtoken'] );
    if( isset( $input['twilio_service_instance_sid_two'] ) )
        $new_input['twilio_service_instance_sid_two'] = sanitize_text_field( $input['twilio_service_instance_sid_two'] );
    if( isset( $input['twilio_api_key_three'] ) )
        $new_input['twilio_api_key_three'] = sanitize_text_field( $input['twilio_api_key_three'] );
    if( isset( $input['twilio_api_secret_three'] ) )
        $new_input['twilio_api_secret_three'] = sanitize_text_field( $input['twilio_api_secret_three'] );
    return $new_input;
}

function print_section_info(){
    // print 'Enter your Twilio Account below:';
}

function jchat_twilio_accountsid_callback(){
	global $options;
	printf(
        '<input type="text" id="twilio_accountsid" name="jchat_option_name[twilio_accountsid]" value="%s" />',
        isset( $options['twilio_accountsid'] ) ? esc_attr( $options['twilio_accountsid']) : ''
    );
}

function jchat_twilio_authtoken_callback(){
	global $options;
	printf(
        '<input type="text" id="twilio_authtoken" name="jchat_option_name[twilio_authtoken]" value="%s" />',
        isset( $options['twilio_authtoken'] ) ? esc_attr( $options['twilio_authtoken']) : ''
    );
}

function jchat_twilio_service_instance_sid_callback(){
    global $options_two, $services_arr, $bol_empty_service, $default_service_sid;
    if(!empty($services_arr)){
        echo "<select id='twilio_service_instance_sid_two' name='jchat_option_name_two[twilio_service_instance_sid_two]'>";
            foreach($services_arr as $name => $serviceID) {
                if($bol_empty_service){
                    $selected = ($default_service_sid == $serviceID) ? 'selected="selected"' : '';
                } else {
                    $selected = ($options_two['twilio_service_instance_sid_two'] == $serviceID) ? 'selected="selected"' : '';
                }
                echo "<option value='$serviceID' $selected>$name</option>";
            }
        echo "</select>";
    }
}

function jchat_twilio_api_key_callback(){
    global $options_three, $default_key_sid, $bol_set_api_key;
    printf(
        '<input type="text" id="twilio_api_key_three" name="jchat_option_name_three[twilio_api_key_three]" value="%s" />',
        isset( $options_three['twilio_api_key_three'] ) ? esc_attr( $options_three['twilio_api_key_three']) : $default_key_sid
    );
}

function jchat_twilio_api_secret_callback(){
    global $options_three, $default_key_secret, $bol_set_api_key;
    printf(
        '<input type="text" id="twilio_api_secret_three" name="jchat_option_name_three[twilio_api_secret_three]" value="%s" />',
        isset( $options_three['twilio_api_secret_three'] ) ? esc_attr( $options_three['twilio_api_secret_three']) : $default_key_secret
    );
}

function jchat_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=jchat-twilio-settings">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'jchat_plugin_add_settings_link' );


// Start for chat container
function jchat_container_of_chat(){
    $screen = get_current_screen();
    if($screen->id !== 'social_page_jetty_social_media_monitoring_setting' && $screen->id !== 'toplevel_page_jetty_social_media_monitoring'){
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            // var viewportWidth = window.innerWidth-20;
            var viewportHeight = window.innerHeight-20;
            // if (viewportWidth > 1000) viewportWidth = 1000;
            if (viewportHeight > 500) viewportHeight = 500;

            var $_jchatFirstContent = jQuery('#jchat_first_content').dialog({
                resizable: false,
                draggable: false,
                autoResize: false,
                width: "450",
                maxWidth: "500",
                height: viewportHeight,
                dialogClass: 'jac-jetty-dialog',
                position: {
                    my: "right bottom",
                    at: "right bottom",
                    of: window,
                    collision: "none"
                },
                create: function (event, ui) {
                    jQuery(event.target).parent().css('position', 'fixed');
                },
                open: function(event, ui){
                    jQuery(this).parent().find('.ui-dialog-titlebar').append('<span class="jchat_container_notif"><i class="far fa-comments" id="jchat_notif_msg"></i><span>');
                    /*jQuery(this).parent().promise().done(function () {
                        jQuery(event.target).parent().css({
                            'height': 'auto',
                            'position': 'fixed'
                        });
                    });*/
                }
            }).dialogExtend({
                "closable" : false,
                "maximizable" : false,
                "minimizable" : true,
                "collapsable" : false,
                "minimizeLocation" : "right",
                "minimize" : function(evt, dlg){ 
                    jQuery('.jac-jetty-dialog span.ui-dialog-title').css({
                        "float": "right",
                    });
                    jQuery('span.jchat_container_notif').show();

                    localStorage.jchat_remember_state_button = 'minimize';
                },
                "restore" : function(evt, dlg){ 
                    jQuery('span.jchat_container_notif').hide();
                    jQuery('i#jchat_notif_msg').attr('class', 'far fa-comments').css({
                        "color": "inherit",
                    });
                    jQuery('.jac-jetty-dialog span.ui-dialog-title').css({
                        "float": "left",
                    });

                    localStorage.jchat_remember_state_button = 'restore';
                }
            });

            if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('jchat_remember_state_button') === null){
                    localStorage.setItem('jchat_remember_state_button', 'restore');
                } else {
                    if(localStorage.jchat_remember_state_button === 'restore'){
                        jQuery('#jchat_first_content').dialogExtend("restore");
                    }

                    if(localStorage.jchat_remember_state_button === 'minimize'){
                        jQuery('#jchat_first_content').dialogExtend("minimize");
                    }
                }
            } else {
                console.log("Sorry! No Web Storage support...");
            }
        });
    </script>
    <div id="targetElement">
        <div class="jchat_content" id="jchat_first_content" title="<?php _e('Jetty Admin Chat', 'jchat'); ?>">
            <?php 
            jchat_content_inside_container();
            ?>
        </div>
    </div>
    <?php
    }
}

if(!is_customize_preview()){
    add_action('in_admin_footer', 'jchat_container_of_chat');
}
?>