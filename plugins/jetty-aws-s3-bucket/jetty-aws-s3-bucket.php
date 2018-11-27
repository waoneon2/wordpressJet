<?php
/**
 * @package Jetty AWS S3 Bucket
 * @version 1.0
 */
/*
Plugin Name: Jetty AWS S3 Bucket
Plugin URI: https://jettyapp.com/
Description: Plugin for storing files in an AWS S3 bucket. This is kind of like a private DropBox.
Author: Jetty Team
Version: 1.0
Author URI: https://jettyapp.com/
Text Domain: jbucket

*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Required if your environment does not handle autoloading
require plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
require 'jetty-aws-cpt.php';

use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\CachingStream;

@set_time_limit(6 * 60);

$options = NULL;
$options_bucket = NULL;
$options_create_bucket = NULL;
$options_upload_file = NULL;
$options_region_list = NULL;
$options_folder_of_bucket = NULL;
$options_network_bucket_name = NULL;
$jbucket_error_notif = '';
$buckets_arr = [];
$get_key = NULL;
$get_secret = NULL;
$bol_on_settings  = TRUE;
$jbucket_list_content = NULL;
$getLoc = NULL;
$isPluginOnNetwork = FALSE;
$isNetworkBucketSelected = FALSE;
$isSingleSite = TRUE;
$default_option_bucket_selected = NULL;
$blog_array = [];



define("JBUCKET_DEFAULT_ACL", "public-read", true);


if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if(is_multisite()){
    if(is_plugin_active( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
        if(is_plugin_active_for_network( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
            $isPluginOnNetwork = TRUE;

            $cur_blog_id = (int) get_current_blog_id();

            if(!empty(get_blog_option( $cur_blog_id, 'jbucket_network_bucket_selected' ))){
                $isNetworkBucketSelected = TRUE;
                $isSingleSite = FALSE;

                if(!is_network_admin()){
                    $default_arr_val = [
                        'jbucket_buckets_list' => ''
                    ];

                    if(!get_option('jbucket_buckets_settings')){
                        add_option( 'jbucket_buckets_settings', $default_arr_val, '', 'yes' );
                        $default_option_bucket_selected = get_option('jbucket_buckets_settings');
                        $default_option_bucket_selected['jbucket_buckets_list'] = get_blog_option( $cur_blog_id, 'jbucket_network_bucket_selected' );
                        update_option('jbucket_buckets_settings', $default_option_bucket_selected);
                    } else {
                        $default_option_bucket_selected = get_option('jbucket_buckets_settings');
                        if(isset($default_option_bucket_selected['jbucket_buckets_list'])){
                            $default_option_bucket_selected['jbucket_buckets_list'] = get_blog_option( $cur_blog_id, 'jbucket_network_bucket_selected' );
                            update_option('jbucket_buckets_settings', $default_option_bucket_selected);
                        } else {
                            $val_arr = [
                                'jbucket_buckets_list' => get_blog_option( $cur_blog_id, 'jbucket_network_bucket_selected' )
                            ];
                            update_option('jbucket_buckets_settings', $val_arr);
                        }
                    }
                }
            }
        }
    }

    $get_all_blog =  (int) get_blog_count();

    for ($bi=1; $bi <= $get_all_blog; $bi++) { 
        $blog_array[$bi] = get_blog_details($bi)->blogname;
    }
}

$jbucket_main_current_folder = 'jbucket_upload';

if(is_multisite()){
    if(is_plugin_active( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
        if(is_plugin_active_for_network( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
            if(!is_network_admin()){
                $curr_blog_id = (int) get_current_blog_id();
                if(get_blog_option( $curr_blog_id, 'jbucket_folder_of_blog' ) !== FALSE && !empty(get_blog_option( $curr_blog_id, 'jbucket_folder_of_blog' ))){
                    $jbucket_main_current_folder = get_blog_option( $curr_blog_id, 'jbucket_folder_of_blog' );
                }
            }
        }
    }
} else {
    if(get_option('jbucket_folder_bucket') !== FALSE){
        if(isset(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket']) && !empty(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'])){
            $jbucket_main_current_folder = get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'];
        }
    }
}


$list_s3_region = [
    'us-east-1'      => 'us-east-1',
    'us-east-2'      => 'us-east-2',
    'us-west-1'      => 'us-west-1',
    'us-west-2'      => 'us-west-2',
    'ca-central-1'   => 'ca-central-1',
    'ap-south-1'     => 'ap-south-1',
    'ap-northeast-2' => 'ap-northeast-2',
    'ap-southeast-1' => 'ap-southeast-1',
    'ap-southeast-2' => 'ap-southeast-2',
    'ap-northeast-1' => 'ap-northeast-1',
    'eu-central-1'   => 'eu-central-1',
    'eu-west-1'      => 'eu-west-1',
    'eu-west-2'      => 'eu-west-2',
    'eu-west-3'      => 'eu-west-3',
    'sa-east-1'      => 'sa-east-1'
];

$key = isset(get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id']) && !empty(get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id']);
$secret = isset(get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key']) && !empty(get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key']);

if(defined('AWS_ACCESS_KEY_ID') && defined('AWS_SECRET_ACCESS_KEY')){
    $get_key     = AWS_ACCESS_KEY_ID;
    $get_secret   = AWS_SECRET_ACCESS_KEY;
    $bol_on_settings = FALSE;

    if(is_multisite()){
        if(is_network_admin()){
            $all_blog_ =  (int) get_blog_count();

            for ($bg=1; $bg <= $all_blog_; $bg++) { 
                if(empty(get_blog_option( $bg, 'jbucket_network_key')) || empty(get_blog_option( $bg, 'jbucket_network_access'))) {
                    add_blog_option( $bg, 'jbucket_network_key', AWS_ACCESS_KEY_ID );
                    add_blog_option( $bg, 'jbucket_network_access', AWS_SECRET_ACCESS_KEY );
                } else {
                    update_blog_option( $bg, 'jbucket_network_key', AWS_ACCESS_KEY_ID );
                    update_blog_option( $bg, 'jbucket_network_access', AWS_SECRET_ACCESS_KEY );
                }
            }
        }
    }
} else {
    if($key && $secret){
        $get_key = get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id'];
        $get_secret = get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key'];
        $bol_on_settings = TRUE;

        if(is_multisite()){
            if(is_network_admin()){
                $_all_blog_ =  (int) get_blog_count();

                for ($_bg=1; $_bg <= $_all_blog_; $_bg++) { 
                    if(empty(get_blog_option( $_bg, 'jbucket_network_key')) || empty(get_blog_option( $_bg, 'jbucket_network_access'))) {
                        add_blog_option( $_bg, 'jbucket_network_key', get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id'] );
                        add_blog_option( $_bg, 'jbucket_network_access', get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key'] );
                    } else {
                        update_blog_option( $_bg, 'jbucket_network_key', get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id'] );
                        update_blog_option( $_bg, 'jbucket_network_access', get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key'] );
                    }
                }
            }
        }
    }
    $bol_on_settings = TRUE;
}

if($get_key && $get_secret){
    try{
        foreach ($list_s3_region as $value) {
            $s3_client = new S3Client([
                'region'      => $value,
                'version'     => '2006-03-01',
                'signature_version' => 'v4',
                'credentials' => [
                    'key'    => $get_key,
                    'secret' => $get_secret,
                ],
            ]);
        }


        if(get_option('jbucket_buckets_settings') !== FALSE){
            if(isset(get_option('jbucket_buckets_settings')['jbucket_buckets_list']) && !empty(get_option('jbucket_buckets_settings')['jbucket_buckets_list'])){
                $getLoc = $s3_client->getBucketLocation(array(
                    'Bucket' => get_option('jbucket_buckets_settings')['jbucket_buckets_list']
                ));
            }
        }

        if(!empty($getLoc)){
            update_option('jbucket_region_selected', $getLoc['LocationConstraint']);

            if(is_multisite()){
                if(is_network_admin()){
                    $__all_blog_ =  (int) get_blog_count();

                    for ($__bg=1; $__bg <= $__all_blog_; $__bg++) { 
                        if(empty(get_blog_option( $__bg, 'jbucket_network_region_selected'))) {
                            add_blog_option( $__bg, 'jbucket_network_region_selected', $getLoc['LocationConstraint'] );
                        } else {
                            update_blog_option( $__bg, 'jbucket_network_region_selected', $getLoc['LocationConstraint'] );
                        }
                    }
                }
            }

            $s3_client_second = new S3Client([
                'region'      => $getLoc['LocationConstraint'],
                'version'     => '2006-03-01',
                'signature_version' => 'v4',
                'credentials' => [
                    'key'    => $get_key,
                    'secret' => $get_secret,
                ],
            ]);

            // CORS to allowed upload from javascript
            $res = $s3_client_second->putBucketCors([
                'Bucket' => get_option('jbucket_buckets_settings')['jbucket_buckets_list'],
                'CORSConfiguration' => [
                    'CORSRules' => [
                        [
                            'AllowedHeaders' => [
                                '*',
                            ],
                            'AllowedMethods' => [
                                'GET',
                                'POST',
                                'PUT',
                                'DELETE',
                            ],
                            'AllowedOrigins' => [
                                '*',
                            ],
                            'MaxAgeSeconds' => 3000,
                        ],
                    ],
                ]
            ]);

            if(get_option('jbucket_buckets_settings') !== FALSE){
                    if(isset(get_option('jbucket_buckets_settings')['jbucket_buckets_list']) && !empty(get_option('jbucket_buckets_settings')['jbucket_buckets_list'])){
                        $jbucket_objects = $s3_client_second->listObjects(array(
                        'Bucket' => get_option('jbucket_buckets_settings')['jbucket_buckets_list'],
                        'Prefix' => $jbucket_main_current_folder.'/'
                    ));

                    if(!empty($jbucket_objects)){
                        $jbucket_list_content = $jbucket_objects;
                    }
                }
            }
        }

        $buckets = $s3_client->listBuckets();
        if(!is_null($buckets['Buckets'])){
            foreach ($buckets['Buckets'] as $bucket){
                $buckets_arr[$bucket['Name']] = $bucket['Name'];
            }
        }
    } catch (S3Exception $e) {
        $jbucket_error_notif = 'Caught exception: '.$e->getMessage();

    } catch (AwsException $e) {
        $jbucket_error_notif = 'Caught exception: '.$e->getAwsRequestId() . "\n" .$e->getAwsErrorType() . "\n" .$e->getAwsErrorCode() . "\n";
    }
}

if(get_option('jbucket_create_bucket_settings') !== FALSE){
    if(isset(get_option('jbucket_create_bucket_settings')['jbucket_create_bucket']) && !empty(get_option('jbucket_create_bucket_settings')['jbucket_create_bucket'])){
        $BUCKET_NAME = get_option('jbucket_create_bucket_settings')['jbucket_create_bucket'];
        try {
            $s3_client_third = new S3Client([
                'region'      => get_option('jbucket_region_selected','us-east-1'),
                'version'     => '2006-03-01',
                'signature_version' => 'v4',
                'credentials' => [
                    'key'    => $get_key,
                    'secret' => $get_secret,
                ],
            ]);
            $result = $s3_client_third->createBucket([
                'Bucket' => $BUCKET_NAME,
            ]);

            $options_create_bucket['jbucket_create_bucket'] = '';
            update_option( 'jbucket_create_bucket_settings', $options_create_bucket);

            $buckets = $s3_client->listBuckets();

            if(!is_null($buckets['Buckets'])){
                foreach ($buckets['Buckets'] as $bucket){
                    $buckets_arr[$bucket['Name']] = $bucket['Name'];
                }
            }
        } catch (AwsException $e) {
            $jbucket_error_notif = 'Caught exception: '.$e->getMessage();
        }
    }
}

function jbucket_network_settings_page(){

    add_submenu_page(
        'settings.php', 
        'Jetty AWS Bucket Credentials',
        'Jetty AWS Bucket Credentials',
        'manage_options', 
        'jbucket-credentials-settings', 
        'jbucket_credentials_settings_callback'
    );
}

function jbucket_single_settings_page(){

    add_submenu_page(
        'options-general.php', 
        'Jetty AWS Bucket Credentials',
        'Jetty AWS Bucket Credentials',
        'manage_options', 
        'jbucket-credentials-settings', 
        'jbucket_credentials_settings_callback'
    );
}

function jbucket_get_icon_document(){
    return plugins_url( 'assets/admin/img/jbucket_document.png', __FILE__ );
}

if($isPluginOnNetwork){
    add_action( 'network_admin_menu', 'jbucket_network_settings_page', 10);
} else {
    add_action( 'admin_menu', 'jbucket_single_settings_page', 10);
}

function jbucket_settings_page(){
	
    add_menu_page('Jetty Upload File', 'Jetty Upload File', 'manage_options','jbucket_content_area', 'jbucket_content_area_callback', 'dashicons-cloud', 25);
    add_submenu_page('jbucket_content_area', 'List File', 'List File', 'manage_options', 'jbucket_content_area_list_file' , 'jbucket_content_area_list_file_callback');
    // add_submenu_page('jbucket_content_area', 'Custom Post File', 'Custom Post File', 'manage_options', 'edit.php?post_type=jbucket-aws');
}
if($isNetworkBucketSelected){
    add_action( 'admin_menu', 'jbucket_settings_page', 11);
}
if(!is_multisite()){
    add_action( 'admin_menu', 'jbucket_settings_page', 11);
}

function jbucket_ajax_url(){
    $ajaxUrl = site_url().'/wp-admin/admin-ajax.php';
    return $ajaxUrl;
}

function jbucket_content_area_callback(){
     ?>
    <div class="wrap">
        <h1>Jetty Upload File</h1>
        <div id="jbucket_uploader">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>
    </div>
    <?php
}

function jbucket_handle_select_bucket(){
    $id = $_POST['id'];
    $val = $_POST['val'];
    if ($id && isset($id)) {
        update_post_meta($id, 'jbucket_access', $val);
        update_post_meta($id, 'meta_access_object_bucket', $val);
    }
    echo json_encode([
        'error' => false,
        'info'  => "Success",
        'ID'    => $id,
        'value' => $val
    ]);

    die();
}
add_action( 'wp_ajax_jbucket_handle_select_bucket', 'jbucket_handle_select_bucket' );

function jbucket_handle_file_uploaded(){
    global $s3_client_second;

    $saveToContent = [];

    @set_time_limit(6 * 60);

    $prefix = $_POST['prefix'];
    $filename = $_POST['filename'];
    $filetype = $_POST['filetype'];

    $key = $prefix.'/'.$filename;

    try {

        $result = $s3_client_second->getObject(array(
            'Bucket' => get_option('jbucket_buckets_settings')['jbucket_buckets_list'],
            'Key'    => $key
        ));

        $search_meta_bucket = $result["@metadata"];

        $saveToContent = [
            'effectiveUri' => $search_meta_bucket["effectiveUri"],
            'headers' => [
                'date' => $search_meta_bucket['headers']['date']
            ]
        ];

        // Create post object
        $cpt = array(
          'post_title'      => $key,
          'post_type'       => 'jbucket-aws',
          'post_content'    => json_encode($saveToContent),
          'post_status'     => 'publish',
          'comment_status'  => 'closed',
          'ping_status'     => 'closed',
        );
        // Insert the post into the database
        $cpt_id =  wp_insert_post( $cpt );

        add_post_meta($cpt_id, 'meta_url_object_bucket', esc_url($search_meta_bucket["effectiveUri"]), true);
        add_post_meta($cpt_id, 'meta_access_object_bucket', 'private', true);
        add_post_meta($cpt_id, 'meta_bucket_name', get_option('jbucket_buckets_settings')['jbucket_buckets_list'], true );
        add_post_meta($cpt_id, 'jbucket_access', 'private', true);
        add_post_meta($cpt_id, 'jbucket_meta_content_type', $filetype, true);

        echo json_encode([
            'message'   => 'Success Upload',
            'error'     => false,
            'cpt_id'    => $cpt_id,
            'result'    => $search_meta_bucket,
            'etag'      => $search_meta_bucket["headers"]["etag"],
            'filetype'  => $filetype
        ]);

    } catch (S3Exception $e) {
        $jbucket_error_notif = 'Caught exception: '.$e->getMessage();
        echo json_encode([
            'message' => 'S3Exception',
            'content' => $jbucket_error_notif
        ]);
    } catch (AwsException $e) {
        $jbucket_error_notif = 'Caught exception: '.$e->getAwsRequestId() . "\n" .$e->getAwsErrorType() . "\n" .$e->getAwsErrorCode() . "\n";
        echo json_encode([
            'message' => 'AwsException',
            'content' => $jbucket_error_notif
        ]);
    }

    die();
}
add_action( 'wp_ajax_jbucket_handle_file_uploaded', 'jbucket_handle_file_uploaded' );

function jbucket_handle_network_update_folder(){
    $id_blog = (int) $_POST['blogId'];
    $name_of_blog = $_POST['blogName'];

    $data_folder = 'jbucket_upload';

    $default_val_arr = [
        'jbucket_field_network_name_bucket' => $data_folder,
        'jbucket_field_folder_network_bucket' => 1
    ];

    if(!get_option('jbucket_folder_network_bucket')){
        add_option( 'jbucket_folder_network_bucket', $default_val_arr, '', 'yes' );
    }

    if(!get_blog_option( $id_blog, 'jbucket_folder_of_blog' )){
        add_blog_option( $id_blog, 'jbucket_folder_of_blog', $data_folder );
        $data_folder = get_blog_option( $id_blog, 'jbucket_folder_of_blog' );
    } else {
        $data_folder = get_blog_option( $id_blog, 'jbucket_folder_of_blog' );
    }
    
    echo json_encode([
        'error'         => false,
        'blog_id'       => $id_blog,
        'blog_name'     => $name_of_blog,
        'folder_name'   => $data_folder
    ]);
    die();
}
add_action( 'wp_ajax_jbucket_handle_network_update_folder', 'jbucket_handle_network_update_folder' );

function jbucket_credentials_settings_callback(){
	global $options, $jbucket_error_notif, $options_bucket, $options_create_bucket, $options_upload_file, $bol_on_settings, $options_region_list, $isPluginOnNetwork, $options_folder_of_bucket, $options_network_bucket_name;

	$options = get_option('jbucket_credentials_settings');
    $options_bucket = get_option('jbucket_buckets_settings');
    $options_create_bucket = get_option('jbucket_create_bucket_settings');
    $options_upload_file = get_option('jbucket_upload_file_settings');
    $options_region_list = get_option('jbucket_region_list');
    $options_folder_of_bucket = get_option('jbucket_folder_bucket');
    $options_network_bucket_name = get_option('jbucket_folder_network_bucket');

	?>

	<div class="wrap">
        <?php 
            $msg = (!empty($jbucket_error_notif)) ? '<span class="jbucket_error_notif">'.$jbucket_error_notif.'</span>' : ''; 
            echo $msg;
            if($bol_on_settings):
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'jbucket_key_secret';
            else:
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'jbucket_list_of_bucket';
            endif;
        ?>
        <h2 class="nav-tab-wrapper">
            <?php if($bol_on_settings): ?>
            <a href="?page=jbucket-credentials-settings&tab=jbucket_key_secret" class="nav-tab <?php echo $active_tab == 'jbucket_key_secret' ? 'nav-tab-active' : ''; ?>">AWS Key & Secret</a>
            <?php endif; ?>
            <a href="?page=jbucket-credentials-settings&tab=jbucket_list_of_bucket" class="nav-tab <?php echo $active_tab == 'jbucket_list_of_bucket' ? 'nav-tab-active' : ''; ?>">Buckets List</a>
            <a href="?page=jbucket-credentials-settings&tab=jbucket_create_new_bucket" class="nav-tab <?php echo $active_tab == 'jbucket_create_new_bucket' ? 'nav-tab-active' : ''; ?>">Create Bucket</a>
            <a href="?page=jbucket-credentials-settings&tab=jbucket_folder_of_bucket" class="nav-tab <?php echo $active_tab == 'jbucket_folder_of_bucket' ? 'nav-tab-active' : ''; ?>">Folder Bucket</a>

            <!-- <a href="?page=jbucket-credentials-settings&tab=jbucket_region_list" class="nav-tab <?php echo $active_tab == 'jbucket_region_list' ? 'nav-tab-active' : ''; ?>">Region</a> -->
        </h2>
		<form method="post" action="<?php echo ($isPluginOnNetwork ?  '../options.php' : 'options.php' ) ?>" enctype="multipart/form-data">
			<?php
                if($active_tab == 'jbucket_key_secret'){
				    settings_fields('jbucket_credentials_settings_group');
				    do_settings_sections('jbucket-credentials-settings');
                    submit_button();
                } 
                else if( $active_tab == 'jbucket_list_of_bucket' ) {
                    settings_fields( 'jbucket_buckets_settings_group' );
                    do_settings_sections( 'jbucket-buckets-settings' );
                    submit_button();
                } 
                else if( $active_tab == 'jbucket_create_new_bucket' ) {
                    settings_fields( 'jbucket_create_bucket_settings_group' );
                    do_settings_sections( 'jbucket-create-bucket-settings' );
                    submit_button('Create');
                }
                else if( $active_tab == 'jbucket_folder_of_bucket' ) {
                    

                    if(is_multisite()){
                        if(is_plugin_active( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
                            if(is_plugin_active_for_network( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
                                settings_fields( 'jbucket_folder_network_bucket_group' );
                                do_settings_sections( 'jbucket-folder-network-bucket-settings' );
                            }
                        }
                    } else {
                        settings_fields( 'jbucket_folder_bucket_group' );
                        do_settings_sections( 'jbucket-folder-bucket-settings' );
                    }

                    submit_button();
                }
                // else if( $active_tab == 'jbucket_region_list' ) {
                //     settings_fields( 'jbucket_region_list_group' );
                //     do_settings_sections( 'jbucket-region-list-settings' );
                //     submit_button('Save Region');
                // }
			?>
		</form>
	</div>
	<?php
}

function jbucket_fields_init(){
    // Main Setting
	register_setting(
        'jbucket_credentials_settings_group',
        'jbucket_credentials_settings',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_setting_section_credentials', 
        'AWS S3 Credentials',
        'jbucket_print_section_info',
        'jbucket-credentials-settings'
    );  
    add_settings_field(
        'jbucket_aws_access_key_id', 
        'AWS Access Key ID',
        'jbucket_aws_access_key_id_callback',
        'jbucket-credentials-settings',
        'jbucket_setting_section_credentials'       
    );      
    add_settings_field(
        'jbucket_aws_secret_access_key', 
        'AWS Secret Access Key', 
        'jbucket_aws_secret_access_key_callback', 
        'jbucket-credentials-settings', 
        'jbucket_setting_section_credentials'
    );
    // Buckets Lists
    register_setting(
        'jbucket_buckets_settings_group',
        'jbucket_buckets_settings',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_setting_section_buckets', 
        'Select the bucket that will be used to store the content.',
        'jbucket_print_section_info_buckets',
        'jbucket-buckets-settings'
    );
    add_settings_field(
        'jbucket_buckets_list', 
        'Buckets List',
        'jbucket_buckets_list_callback',
        'jbucket-buckets-settings',
        'jbucket_setting_section_buckets'       
    );
    // Create Bucket
    register_setting(
        'jbucket_create_bucket_settings_group',
        'jbucket_create_bucket_settings',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_setting_section_create_bucket', 
        'Create a new bucket and then select the bucket in Buckets List.',
        'jbucket_print_section_info_create_bucket',
        'jbucket-create-bucket-settings'
    );
    add_settings_field(
        'jbucket_create_bucket', 
        'Create Bucket',
        'jbucket_create_bucket_callback',
        'jbucket-create-bucket-settings',
        'jbucket_setting_section_create_bucket'       
    );
    // Upload File
    register_setting(
        'jbucket_upload_file_settings_group',
        'jbucket_upload_file_settings',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_setting_section_upload_file', 
        'Upload file on Bucket.',
        'jbucket_print_section_info_upload_file',
        'jbucket-upload-file-settings'
    );
    add_settings_field(
        'jbucket_upload_file', 
        'Upload File',
        'jbucket_upload_file_callback',
        'jbucket-upload-file-settings',
        'jbucket_setting_section_upload_file'       
    );
    // Region List
    register_setting(
        'jbucket_region_list_group',
        'jbucket_region_list',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_region_list_section', 
        'If there is an error about the region when choosing a bucket. Please change region here.',
        'jbucket_print_region_list',
        'jbucket-region-list-settings'
    );
    add_settings_field(
        'jbucket_buckets_region_list', 
        'Region List',
        'jbucket_region_list_callback',
        'jbucket-region-list-settings',
        'jbucket_region_list_section'       
    );
    // Folder of Bucket
    register_setting(
        'jbucket_folder_bucket_group',
        'jbucket_folder_bucket',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_folder_bucket_section', 
        'You can change the folder in the bucket. The default folder is <strong>jbucket_upload.</strong>',
        'jbucket_print_folder_bucket',
        'jbucket-folder-bucket-settings'
    );
    add_settings_field(
        'jbucket_field_folder_bucket', 
        'Name of Folder',
        'jbucket_field_folder_bucket_callback',
        'jbucket-folder-bucket-settings',
        'jbucket_folder_bucket_section'       
    );
    // Folder of Bucket on Network
    register_setting(
        'jbucket_folder_network_bucket_group',
        'jbucket_folder_network_bucket',
        'jbucket_sanitize'
    );
    add_settings_section(
        'jbucket_folder_network_bucket_section', 
        'You can change the folder in the bucket. The default folder is <strong>jbucket_upload.</strong>',
        'jbucket_print_folder_network_bucket',
        'jbucket-folder-network-bucket-settings'
    );
    add_settings_field(
        'jbucket_field_folder_network_bucket', 
        'Blogname',
        'jbucket_field_folder_network_bucket_callback',
        'jbucket-folder-network-bucket-settings',
        'jbucket_folder_network_bucket_section'       
    );
    add_settings_field(
        'jbucket_field_network_name_bucket', 
        'Name of Folder',
        'jbucket_field_network_name_bucket_callback',
        'jbucket-folder-network-bucket-settings',
        'jbucket_folder_network_bucket_section'       
    );
}
add_action( 'admin_init', 'jbucket_fields_init' );

function jbucket_print_section_info(){
	print 'Enter your AWS Credentials Account below:';
}

function jbucket_print_section_info_buckets() {
    // print 'Select the bucket that will be used to store the content.';
}

function jbucket_print_section_info_create_bucket() {
    // print 'Create a new bucket and then select the bucket in Buckets List.';
}

function jbucket_print_section_info_upload_file() {

}

function jbucket_print_region_list() {
    print 'Default region is us-east-1';
}

function jbucket_print_folder_bucket() {

}

function jbucket_print_folder_network_bucket() {

}

function jbucket_sanitize($input){
	$new_input = array();
    if( isset( $input['jbucket_aws_access_key_id'] ) )
        $new_input['jbucket_aws_access_key_id'] = sanitize_text_field( $input['jbucket_aws_access_key_id'] );
    if( isset( $input['jbucket_aws_secret_access_key'] ) )
        $new_input['jbucket_aws_secret_access_key'] = sanitize_text_field( $input['jbucket_aws_secret_access_key'] );
    if( isset( $input['jbucket_buckets_list'] ) )
        $new_input['jbucket_buckets_list'] = sanitize_text_field( $input['jbucket_buckets_list'] );
    if( isset( $input['jbucket_create_bucket'] ) )
        $new_input['jbucket_create_bucket'] = sanitize_text_field( $input['jbucket_create_bucket'] );
    if( isset( $input['jbucket_upload_file'] ) )
        $new_input['jbucket_upload_file'] = sanitize_text_field( $input['jbucket_upload_file'] );
    if( isset( $input['jbucket_buckets_region_list'] ) )
        $new_input['jbucket_buckets_region_list'] = sanitize_text_field( $input['jbucket_buckets_region_list'] );
    if( isset( $input['jbucket_field_folder_bucket'] ) )
        $new_input['jbucket_field_folder_bucket'] = sanitize_text_field( $input['jbucket_field_folder_bucket'] );
    if( isset( $input['jbucket_field_folder_network_bucket'] ) )
        $new_input['jbucket_field_folder_network_bucket'] = sanitize_text_field( $input['jbucket_field_folder_network_bucket'] );
    if( isset( $input['jbucket_field_network_name_bucket'] ) )
        $new_input['jbucket_field_network_name_bucket'] = sanitize_text_field( $input['jbucket_field_network_name_bucket'] );
    return $new_input;
}

function jbucket_aws_access_key_id_callback(){
	global $options;
	printf(
        '<input type="text" id="jbucket_aws_access_key_id" name="jbucket_credentials_settings[jbucket_aws_access_key_id]" value="%s" />',
        isset( $options['jbucket_aws_access_key_id'] ) ? esc_attr( $options['jbucket_aws_access_key_id']) : ''
    );
}

function jbucket_aws_secret_access_key_callback(){
	global $options;
	printf(
        '<input type="text" id="jbucket_aws_secret_access_key" name="jbucket_credentials_settings[jbucket_aws_secret_access_key]" value="%s" />',
        isset( $options['jbucket_aws_secret_access_key'] ) ? esc_attr( $options['jbucket_aws_secret_access_key']) : ''
    );
}

function jbucket_buckets_list_callback(){
    global $options_bucket, $buckets_arr;

    if(!empty($buckets_arr)){
        echo "<select id='jbucket_buckets_list' name='jbucket_buckets_settings[jbucket_buckets_list]'>";
            foreach($buckets_arr as $name => $mainname) {
                $selected = ($options_bucket['jbucket_buckets_list'] == $mainname) ? 'selected="selected"' : '';
                echo "<option value='$mainname' $selected>$name</option>";
            }
        echo "</select>";
    }
}

function jbucket_region_list_callback(){
    global $options_region_list, $list_s3_region;
    echo "<select id='jbucket_buckets_region_list' name='jbucket_region_list[jbucket_buckets_region_list]'>";
        foreach($list_s3_region as $name => $mainname) {
            $selected = ($options_region_list['jbucket_buckets_region_list'] == $mainname) ? 'selected="selected"' : '';
            echo "<option value='$mainname' $selected>$name</option>";
        }
    echo "</select>";
}

function jbucket_create_bucket_callback(){
    echo '<input type="text" id="jbucket_create_bucket" name="jbucket_create_bucket_settings[jbucket_create_bucket]" placeholder="Name of bucket" />';
}

function jbucket_field_folder_bucket_callback(){
    global $options_folder_of_bucket;
    printf(
        '<input type="text" id="jbucket_field_folder_bucket" name="jbucket_folder_bucket[jbucket_field_folder_bucket]" value="%s" />',
        isset( $options_folder_of_bucket['jbucket_field_folder_bucket'] ) ? esc_attr( $options_folder_of_bucket['jbucket_field_folder_bucket']) : ''
    );    
}

function jbucket_upload_file_callback() {
    echo '<input type="file" id="jbucket_upload_file" name="jbucket_upload_file_settings[jbucket_upload_file]" />';
}

function jbucket_field_folder_network_bucket_callback() {
    global $options_network_bucket_name, $blog_array;
    if(!empty($blog_array)){
        echo "<select id='jbucket_field_folder_network_bucket' name='jbucket_folder_network_bucket[jbucket_field_folder_network_bucket]'>";
            foreach($blog_array as $blogid => $blogname) {
                $selected = ($options_network_bucket_name['jbucket_field_folder_network_bucket'] == $blogid) ? 'selected="selected"' : '';
                echo "<option value='$blogid' $selected>$blogname</option>";
            }
        echo "</select>";
    }
}

function jbucket_field_network_name_bucket_callback() {
    global $options_network_bucket_name;
    printf(
        '<input type="text" id="jbucket_field_network_name_bucket" name="jbucket_folder_network_bucket[jbucket_field_network_name_bucket]" value="%s" />',
        isset( $options_network_bucket_name['jbucket_field_network_name_bucket'] ) ? esc_attr( $options_network_bucket_name['jbucket_field_network_name_bucket']) : ''
    );  
}

function jbucket_file_size_convert($bytes)
{
    $result = 0;
    if(!empty($bytes)){
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem)
        {
            if($bytes >= $arItem["VALUE"])
            {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }
        return $result;
    } else {
        return '';
    }
}

function jbucket_curl_get_file_size( $url ) {

  $result = -1;

  $curl = curl_init( $url );


  curl_setopt( $curl, CURLOPT_NOBODY, true );
  curl_setopt( $curl, CURLOPT_HEADER, true );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11" );

  $data = curl_exec( $curl );
  curl_close( $curl );

  if( $data ) {
    $content_length = "unknown";
    $status = "unknown";

    if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
      $status = (int)$matches[1];
    }

    if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
      $content_length = (int)$matches[1];
    }

    if( $status == 200 || ($status > 300 && $status <= 308) ) {
      $result = $content_length;
    }
  }

  return $result;
}

function jbucket_is_video($mime_type){

    $video_mime_types = array(
        'video/mp4',
        // 'video/quicktime',
        // 'video/asf.avi',
        // 'video/mpeg',
        'video/ogg',
        // 'video/x-flv',
        'video/webm'
    );
    
    if ( in_array( $mime_type, $video_mime_types ) )
        return true;
    return false;
}

function jbucket_is_image($mime_type){

    $image_mime_types = array(
        'image/jpeg',
        'image/gif',
        'image/png',
        'image/vnd.microsoft.icon'
    );
    
    if ( in_array( $mime_type, $image_mime_types ) )
        return true;
    return false;
}

function jbucket_is_document($mime_type){

    $document_mime_types = array(
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/msword',
        'application/epub+zip',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.oasis.opendocument.text',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/zip',
        'application/x-zip-compressed',
        'application/rtf',
        'application/vnd.oasis.opendocument.text',
        'application/vnd.oasis.opendocument.spreadsheet',
        'text/plain',
        'text/x-csv',
        'text/csv',
        'text/html',
        'text/css',
        'application/javascript',
        'application/json',
        'application/xml',
        'application/pdf',
        'image/vnd.adobe.photoshop',
        'application/postscript'
    );

    if ( in_array( $mime_type, $document_mime_types ) )
            return true;
        return false;
}

function jbucket_is_audio($mime_type){

    $audio_mime_types = array(
        'audio/mpeg',
        'audio/ogg',
        'audio/wav'
    );
        
    if ( in_array( $mime_type, $audio_mime_types ) )
        return true;
    return false;
}

function jbucket_get_url_mime_type($url){

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);

    if (!curl_errno($ch)) {
        $info = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        return $info;
    } else {
        return "error for get mime type";
    }

    curl_close( $ch );
}

add_filter('single_template', 'jbucket_custom_template');

function jbucket_custom_template($single){
    global $wp_query, $post;

    if ( $post->post_type === 'jbucket-aws' ) {
        return plugin_dir_path( __FILE__ ) . 'inc/jbucket_single_template.php';
    }

    return $single;
}

function jbucket_content_area_list_file_callback(){
    global $jbucket_list_content;
    ?>
    <div class="wrap">
        <h1>Jetty List File</h1>
        <div id="jbucket_uploader">
            <?php
                $args = array(
                    'post_type' => 'jbucket-aws',
                    'posts_per_page' => -1, 
                    'ignore_sticky_posts' => true,
                );

                $jbucket_post = new WP_Query($args);
            ?>
            <table id="jbucket_ca_list" class="wp-list-table widefat fixed striped">
                <thead>
                  <tr>
                    <th>Content</th>
                    <th>Size</th>
                    <th>Date created</th>
                    <th>URL/Link</th>
                    <th>Access</th>
                  </tr>
                </thead>
                <tbody>
              <?php
                if ($jbucket_post->have_posts()) {
                    $i = 0;
                    while ($jbucket_post->have_posts()): $jbucket_post->the_post(); ?>
                    <?php 
                        $json = str_replace('""', '"', get_the_content());
                        $jbucket_data = json_decode($json, true); 
                        $jbucket_link = explode('/', get_the_title());
                        $jbucket_access = get_post_meta(get_the_ID(), 'jbucket_access', true);
                        $jbucket_get_bucket_name = get_post_meta(get_the_ID(), 'meta_bucket_name', true );

                        $escUrl = esc_url( $jbucket_data['effectiveUri'] );
                    if(!empty($escUrl) && ($jbucket_get_bucket_name === get_option('jbucket_buckets_settings')['jbucket_buckets_list']) ):
                        $fz = jbucket_curl_get_file_size($escUrl);

                    ?>
                    <tr>
                        <td class="column-title"><?php the_title();?></td>
                        <td><?php echo jbucket_file_size_convert($fz); ?></td>
                        <td class="column-date">
                            <abbr title="<?php echo date('Y/m/d h:i:s a', strtotime($jbucket_data['headers']['date'] )) ?>">
                                <?php echo date('Y/m/d', strtotime($jbucket_data['headers']['date'] )) ?>
                            </abbr>
                        </td>
                        <td>
                            <a class="link_jbucket" href="<?php echo get_the_permalink(get_the_ID()); ?>"><?php echo $jbucket_link[1]; ?></a> 
                        </td>
                        <td>
                            <select name="jbucket_access" class="jbucket_access" data-accessid="<?php echo get_the_ID(); ?>" data-url-bucket="<?php echo esc_url($jbucket_data['effectiveUri']); ?>" data-url-post="<?php echo get_edit_post_link( get_the_ID() ); ?>">
                                <option value="public" <?php selected( $jbucket_access, "public" ); ?>>Public</option>
                                <option value="private" <?php selected( $jbucket_access, "private" ); ?>>Private</option>
                            </select>

                            <span class="prog_img_loading"></span>
                        </td>
                    </tr>
                    <?php
                    endif; 
                endwhile;
                    wp_reset_postdata();
                }

              ?>
            </tbody>
            </table>
        </div>
    </div>
    <?php
}

function jbucket_network_admin_notice(){
    $screen = get_current_screen();
    if($screen->id === 'settings_page_jbucket-credentials-settings-network'){
        if(isset($_GET['settings-updated']) && $_GET['settings-updated'] ){

            if(get_option('jbucket_buckets_settings') !== FALSE){
                if(isset(get_option('jbucket_buckets_settings')['jbucket_buckets_list']) && !empty(get_option('jbucket_buckets_settings')['jbucket_buckets_list'])){
                    if(is_multisite()){
                        if(is_network_admin()){
                            $all_blog =  (int) get_blog_count();

                            for ($bl=1; $bl <= $all_blog; $bl++) { 
                                if(empty(get_blog_option( $bl, 'jbucket_network_bucket_selected'))) {
                                    add_blog_option( $bl, 'jbucket_network_bucket_selected', get_option('jbucket_buckets_settings')['jbucket_buckets_list'] );
                                } else {
                                    update_blog_option( $bl, 'jbucket_network_bucket_selected', get_option('jbucket_buckets_settings')['jbucket_buckets_list'] );
                                }
                            }
                        }
                    }
                }
            }

            $data_folder = 'jbucket_upload';
            
            $default_val_arr = [
                'jbucket_field_network_name_bucket' => $data_folder,
                'jbucket_field_folder_network_bucket' => 1
            ];

            if(!get_option('jbucket_folder_network_bucket')){
                add_option( 'jbucket_folder_network_bucket', $default_val_arr, '', 'yes' );
            }

            $id_blog = (int) get_option('jbucket_folder_network_bucket')['jbucket_field_folder_network_bucket'];

            if(!get_blog_option( $id_blog, 'jbucket_folder_of_blog' )){
                add_blog_option( $id_blog, 'jbucket_folder_of_blog', $data_folder );
                update_blog_option( $id_blog, 'jbucket_folder_of_blog', get_option('jbucket_folder_network_bucket')['jbucket_field_network_name_bucket'] );
            } else {
                update_blog_option( $id_blog, 'jbucket_folder_of_blog', get_option('jbucket_folder_network_bucket')['jbucket_field_network_name_bucket'] );
            }

?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p><strong>Settings saved.</strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
<?php
        }
    }
}
add_action('network_admin_notices', 'jbucket_network_admin_notice');


function jbucket_enqueue_scripts(){
    global $get_key, $get_secret;

    if(is_multisite()){
        if(get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' ) !== FALSE && !empty(get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' ))){
            $region = get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' );
        }
    } else {
        $region = get_option('jbucket_region_selected', 'us-east-1');
    }

    $jbucket_current_folder = 'jbucket_upload';

    if(is_multisite()){
        if(is_plugin_active( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
            if(is_plugin_active_for_network( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
                if(!is_network_admin()){
                    $curr_blog_id_ajax = (int) get_current_blog_id();
                    if(get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' ) !== FALSE && !empty(get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' ))){
                        $jbucket_current_folder = get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' );
                    }
                }
            }
        }
    } else {
        if(get_option('jbucket_folder_bucket') !== FALSE){
            if(isset(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket']) && !empty(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'])){
                $jbucket_current_folder = get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'];
            }
        }
    }

    // Prepare 
    $access_key         = $get_key;
    $secret_key         = $get_secret;
    $current_bucket     = get_option('jbucket_buckets_settings')['jbucket_buckets_list'];
    $current_region     = $region;
    $allowd_file_size   = "714572800";

    //String Replace
    $str_rep = str_replace(' ', '-', $jbucket_current_folder);
    $str_rep = $str_rep.'/';

    //dates
    $short_date         = gmdate('Ymd'); //short date
    $iso_date           = gmdate("Ymd\THis\Z"); //iso format date
    $expiration_date    = date('Y-m-d\TH:i:s.000\Z', strtotime('+1 day'));

    //POST Policy required in order to control what is allowed in the request
    $policy = base64_encode(json_encode(array(
        'expiration' => $expiration_date,  
        'conditions' => array(
            array('acl' => defined('JBUCKET_DEFAULT_ACL') ? JBUCKET_DEFAULT_ACL : 'public-read'),  
            array('bucket' => $current_bucket), 
            array('starts-with', '$key', $jbucket_current_folder),
            array('starts-with', '$Content-Type', ''),
            array('starts-with', '$name', ''),
            array('starts-with', '$Filename', ''),
    )))); 

    //Signature
    $signature_new = base64_encode(hash_hmac('sha1', $policy, $secret_key, true));

    if($current_region === 'us-east-1'){
        $url_aws = 'https://'.$current_bucket.'.s3.amazonaws.com/';
    } else {
        $url_aws = 'https://'.$current_bucket.'.s3-'.$current_region.'.amazonaws.com/';
    }

    $screen = get_current_screen();
    $jbucket_ajx_data = array(
        'ajax_url'   => jbucket_ajax_url(),
        'directly_url' => plugins_url( 'inc/jbucket_upload_ajax.php', __FILE__ ),
        'jbucket_flash_url' => plugins_url( 'assets/plupload/Moxie.swf', __FILE__ ),
        'jbucket_silverlight_url' => plugins_url( 'assets/plupload/Moxie.xap', __FILE__ ),
        'jbucket_aws_s3_url' => $url_aws,
        'jbucket_current_folder_key' => $jbucket_current_folder,
        'jbucket_x_acl' => defined('JBUCKET_DEFAULT_ACL') ? JBUCKET_DEFAULT_ACL : 'public-read',
        'jbucket_x_credential' => ''.$access_key.'/'.$short_date.'/'.$current_region.'/s3/aws4_request',
        'jbucket_x_algorithm' => 'AWS4-HMAC-SHA256',
        'jbucket_x_date' => $iso_date,
        'jbucket_policy' => $policy,
        'jbucket_x_signature' => $signature_new,
        'jbucket_aws_access_key' => $access_key

    );

    wp_enqueue_style( 'jbucket-style', plugins_url( 'assets/admin/css/jbucket_style.css', __FILE__ ), array(), '1.0.0' );

    // Set up plupload with amazon S3
    if($screen->id === 'toplevel_page_jbucket_content_area'){
        wp_enqueue_style( 'jbucket-jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css', array(), '1.0.0' );
        wp_enqueue_style( 'jbucket-plupload-style', plugins_url( 'assets/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css', __FILE__ ), array(), '1.0.0' );

        wp_enqueue_script( 'jquery-ui-core','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-widget','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-button' ,'', array('jquery'), false, true);
        wp_enqueue_script( 'jquery-ui-progressbar','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-sortable' ,'', array('jquery'), false, true);
        wp_enqueue_script( 'jquery-ui-draggable','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-droppable','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-selectable','', array('jquery'), false, true );
        wp_enqueue_script( 'jquery-ui-resizable','', array('jquery'), false, true );
        
        wp_enqueue_script( 'jbucket-plupload', plugins_url( 'assets/plupload/plupload.full.min.js', __FILE__ ), array('jquery'), '1.5.7', true );
        wp_enqueue_script( 'jbucket-plupload-ui-js', plugins_url( 'assets/plupload/jquery.ui.plupload/jquery.ui.plupload.js', __FILE__ ), array('jquery'), '1.5.7', true );

        wp_enqueue_script( 'jbucket-settings-script', plugins_url( 'assets/admin/js/jbucket_script.js', __FILE__ ), array('jquery'), '1.0', true );
        wp_localize_script( 'jbucket-settings-script', 'jbucket_ajax_action', $jbucket_ajx_data);
    }

    if ($screen->id === 'jetty-upload-file_page_jbucket_content_area_list_file') {
        wp_enqueue_script( 'jbucket-list-script', plugins_url( 'assets/admin/js/jbucket_list_script.js', __FILE__ ), array('jquery'), '1.0', true );
        wp_localize_script( 'jbucket-list-script', 'jbucket_list_ajax_action', array(
            'ajax_url'      => jbucket_ajax_url(),
            'image_loading' => plugins_url( 'assets/admin/img/loading.gif', __FILE__ )
        ));
    }

    if($screen->id === 'settings_page_jbucket-credentials-settings-network'){
        wp_enqueue_script( 'jbucket-select-network-script', plugins_url( 'assets/admin/js/jbucket_on_select_network_script.js', __FILE__ ), array('jquery'), '1.0', true );
        wp_localize_script( 'jbucket-select-network-script', 'jbucket_select_network_ajax_action', array(
            'ajax_url'      => jbucket_ajax_url(),
            'image_loading' => plugins_url( 'assets/admin/img/loading.gif', __FILE__ )
        ));
    }
}
add_action( 'admin_enqueue_scripts', 'jbucket_enqueue_scripts' );

function jbucket_global_enqueue_scripts(){
    wp_enqueue_style( 'jbucket-global-style', plugins_url( 'assets/admin/css/jbucket_global_style.css', __FILE__ ), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'jbucket_global_enqueue_scripts');

function jbucket_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=jbucket-credentials-settings">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'jbucket_plugin_add_settings_link' );

?>