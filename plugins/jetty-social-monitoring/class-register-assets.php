<?php
class JSSM{
  protected static $instance = null;
  protected static $prefix = 'jssm_';
  private static $postTypeInquiry = 'inquiry';
  private static $programaticInquiryArray;

  private function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'EnqueueAdminStyles' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'EnqueueAdminScripts' ) );
    add_action( 'wp_ajax_HandleAjaxRequest', array($this, 'HandleAjaxRequest') );
    add_action( 'wp_ajax_HandleSaveAjaxRequest', array($this, 'HandleSaveAjaxRequest') );
    add_action( 'init', array($this, 'UserRoles'));
  }

  public function UserRoles(){
    $getRole = get_role( 'contact' );
    if(!isset($getRole)){
      add_role(
        'contact',
        __('Contact'),
        [
            'read' => true,
        ]
      );
    }
  }

  public function HandleAjaxRequest(){
 
      $user_id      = get_current_user_id();
      $postTitle    = $_POST['post_title'];
      $postContent  = $_POST['post_content'];
      $sourceTitle  = $_POST['source_title'];
      $username     = $_POST['username'];

      $retrieveContactUsername = $this->GetContact($username);
      
      $new_inquiry_data = array(
        'post_author'     => $retrieveContactUsername->ID,
        'post_title'      => $postTitle,
        'post_content'    => $postContent,
        'inquiry_contact' => $retrieveContactUsername->ID,
        'inquiry_source'  => $sourceTitle
      );
      
      // create the inquiry
      $new_inquiry_id = self::CreateInquiry($new_inquiry_data, $retrieveContactUsername->ID);
      update_post_meta( $new_inquiry_id, 'inquiry_contact', $retrieveContactUsername->ID  );
      update_post_meta( $new_inquiry_id, 'inquiry_source', $sourceTitle );
      update_post_meta( $new_inquiry_id, 'inquiry_owner', $user_id );
      update_post_meta( $new_inquiry_id, 'inquiry_username', $username );
      die();
  }

  public static function InputTextarea(){
    $inputName = array(
      'twitter_username',
      'ig_user_id',
      'textarea_feeds'
    );
    return $inputName;
  }

  public function HandleSaveAjaxRequest(){
    global $pagenow;

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    $fd = $_POST['formData'];
    $data_sanitaze = [];
    $loop_i = 0;
    parse_str($fd, $parseFd);
    $obj = json_decode(json_encode($parseFd), FALSE);

    foreach ($obj as $key => $entry)
    {
        if(in_array($key, self::InputName())){
          if(in_array($key, self::InputTextarea())){
            update_option($key, esc_textarea($entry));
            // $data_sanitaze[$loop_i] = sanitize_textarea_field(str_replace('"',"'",$entry));
            $data_sanitaze[$loop_i] = esc_textarea($entry);
          } else {
            update_option($key, esc_html($entry));
            // $data_sanitaze[$loop_i] = sanitize_text_field(str_replace('"',"'",$entry));
            $data_sanitaze[$loop_i] = esc_html($entry);
          }
        }
        $loop_i++;
    }

    echo json_encode(array(
        'data' => $obj,
        'data_sanitaze' => $data_sanitaze
    ));
    die();
  }

  public function GetContact($username){
    $args = [
        'meta_query' => [
            'relation' => 'and',
            [
                'key' => self::$prefix . 'user_name',
                'value' => $username,
                'compare' => '=='
            ]
        ],
        'fields' => array('ID'),
    ];
    $contacts = get_users($args);

    if (is_array($contacts) && count($contacts) >= 1) {

      $contactId = $contacts[0]->ID;
      $contact = get_user_by('id', $contactId);

    } else {
      $userData = [
          'user_login' => $this->CreateUsername($username),
          'display_name' => $username,
          'user_email' => null,
          'role' => 'contact',
          'user_pass' => null,
      ];

      add_action('user_profile_update_errors', array($this, 'jssmRemoveEmptyEmailError'), 0, 3);

      $contactId = wp_insert_user($userData);

      remove_action('user_profile_update_errors', array($this, 'jssmRemoveEmptyEmailError'), 0, 3);

      $contact = get_user_by('id', $contactId);

      update_user_meta($contact->ID, self::$prefix . 'user_name', $username);
    }

    return $contact;
  }

  public function CreateUsername($userName){

    $username = str_replace(' ', '', $userName);
    $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);

    $existingUser = get_user_by('login', $username);
    if ($existingUser) {

        while ($existingUser) {
            $randomName = $username . wp_rand(1, 999);
            $existingUser = get_user_by('login', $randomName);
        }

        $username = $randomName;
    }

    return $username;
  }

  protected function jssmRemoveEmptyEmailError($errors, $update, $user){
    if (!empty($errors->errors['empty_email'])) {
        unset($errors->errors['empty_email']);
    }

    if (!empty($errors->errors['empty_user_login'])) {
        unset($errors->errors['empty_user_login']);
    }
  }

  public function RenderHelp($socialType){
    $contentHtml = '';
    switch ($socialType) {
      case 'twitter':
        $contentHtml .= '<div class="jetty_smm_twitter_help" style="display:none;">';
        $contentHtml .= 'Twitter has 3 different feed options:<br/>';
        $contentHtml .= '<b>1. Tweets from a specific user name -</b><br/>';
        $contentHtml .= 'Enter the required user name (minus the "@" symbol) -<br/>';
        $contentHtml .= 'e.g. "designchemical"<br/>';

        $contentHtml .= '<b>2. Tweets from a list -</b><br/>';
        $contentHtml .= 'To show a list enter "/" followed by the list ID you want to display -<br/>';
        $contentHtml .= 'e.g. "/9927875"<br/>';

        $contentHtml .= '<b>3. Tweets from a search -</b><br/>';
        $contentHtml .= 'Enter "#" followed by the search term -<br/>';
        $contentHtml .= 'e.g. "#designchemical" <br/></br>';
        $contentHtml .= '</div>';
        break;

      case 'facebook':
        $contentHtml .= '<div class="jetty_smm_facebook_help" style="display:none;">';
        $contentHtml .= 'Facebook has 2 different ID options:<br/>';
        $contentHtml .= '<b>1. Facebook page wall posts -</b><br/>';
        $contentHtml .= 'Enter the page ID<br />';

        $contentHtml .= '<b>2. Facebook page gallery images -</b><br/>';
        $contentHtml .= 'Enter the gallery name followed by "/" followed by the page gallery ID -<br/>';
        $contentHtml .= 'e.g. "Facebook Timeline/376995711728 <br/><br/>';
        $contentHtml .= '</div>';
        break;

      case 'instagram':
        $contentHtml .= '<div class="jetty_smm_instagram_help" style="display:none;">';
        $contentHtml .= 'Insert ! followed by your instagram user ID. To get your user ID use the <br/>';
        $contentHtml .= 'following link: <a href="http://www.otzberg.net/iguserid/" target="_blank">http://www.otzberg.net/iguserid/</a>. <br /><br />';

        $contentHtml .= 'As with all networks multiple feeds can be entered by separating each feed ID <br/>';
        $contentHtml .= 'with a comma:<br/>';
        $contentHtml .= 'e.g. id: \'!12345,!67890\'<br/><br/>';
        $contentHtml .= '</div>';
        break;

      case 'youtube':
        $contentHtml .= '<div class="jetty_smm_youtube_help" style="display:none;">';
        $contentHtml .= 'Youtube has 2 different ID options:<br/>';
        $contentHtml .= '<b>1. Videos from a specific play list ID or Channel ID -</b><br/>';
        $contentHtml .= 'Enter the text you would like to show for the feed profile name followed by / <br/>';
        $contentHtml .= 'followed by the required list ID -<br />';
        $contentHtml .= 'e.g. "My Youtube Feed/UUPPPrnT5080hPMxK1N4QSjA"<br />';

        $contentHtml .= '<b>2. Your youtube list ID -</b><br/>';
        $contentHtml .= 'To get your youtube list ID from a profile name we have created a simple online <br/>';
        $contentHtml .= 'tool - <a href="http://designchemical.com/lab/sandbox/youtube_id.html" target="_blank">How to get your Youtube ID</a><br/>';

        $contentHtml .= '<b>3. Videos from a search -</b><br/>';
        $contentHtml .= 'Enter "#" followed by the search term -<br/>';
        $contentHtml .= 'e.g. "#designchemical"<br/><br/>';
        $contentHtml .= '</div>';
        break;
      
      default:
        $contentHtml .= 'empty';
        break;
    }
    
    return $contentHtml;
  }

  public function EnqueueAdminStyles(){
    $screen = get_current_screen();
    if($screen->id == 'toplevel_page_jetty_social_media_monitoring'){
      wp_enqueue_style( self::PluginSlug() .'-social-stream-style', plugins_url( 'assets/jcs/css/dcsns_wall.css', __FILE__ ), array(), '1.0.0' );
      wp_enqueue_style( self::PluginSlug() .'-admin-social-stream-style', plugins_url( 'assets/css/admin-social-stream.css', __FILE__ ), array(), '1.0.0' );
    }
    if($screen->id == 'social_page_jetty_social_media_monitoring_setting'){
      wp_enqueue_style( self::PluginSlug() .'-admin-social-stream-settings-style', plugins_url( 'assets/css/admin-social-stream-settings.css', __FILE__ ), array(), '1.0.0' );
    }
  }

  public function EnqueueAdminScripts(){
    $screen = get_current_screen();
    if($screen->id == 'toplevel_page_jetty_social_media_monitoring'){
      // wp_enqueue_script( self::PluginSlug() . '-jquery-min', plugins_url( 'assets/js/jquery.min.js', __FILE__ ), array(), '1.10.1', true );

      wp_enqueue_script( self::PluginSlug() . '-social-stream-wall', plugins_url( 'assets/jcs/js/jquery.social.stream.wall.1.8.js', __FILE__ ), array('jquery'), '1.8', true );
      wp_enqueue_script( self::PluginSlug() . '-social-stream', plugins_url( 'assets/jcs/js/jquery.social.stream.1.6.2.js', __FILE__ ), array('jquery'), '1.6.2', true );
      wp_enqueue_script( self::PluginSlug() . '-admin-social-stream', plugins_url( 'assets/js/admin-social-stream.js', __FILE__ ), array('jquery'), '1.0.0', true );

      wp_enqueue_script( self::PluginSlug() . '-ass-ajax', plugins_url( 'assets/js/ass-ajax.js', __FILE__ ), array( 'jquery'), '1.0.0', true );
      wp_localize_script( self::PluginSlug() . '-ass-ajax', 'ass_ajax_action', array(
        'ajax_url' => self::AjaxUrl()
      ));
    }

    if($screen->id == 'social_page_jetty_social_media_monitoring_setting'){
      wp_enqueue_script( self::PluginSlug() . '-admin-social-stream-settings', plugins_url( 'assets/js/admin-social-stream-settings.js', __FILE__ ), array('jquery'), '1.0.0', true );

      wp_enqueue_script( self::PluginSlug() . '-asss-ajax', plugins_url( 'assets/js/asss-ajax.js', __FILE__ ), array( 'jquery'), '1.0.0', true );
      wp_localize_script( self::PluginSlug() . '-asss-ajax', 'asss_ajax_action', array(
        'ajax_url' => self::AjaxUrl()
      ));
    }
  }
  
  public static function GetInstance() { 
    if ( null == self::$instance ) {
      self::$instance = new self;
    }

    return self::$instance;
  }

  public static function AjaxUrl(){
    $ajaxUrl = site_url().'/wp-admin/admin-ajax.php';
    return $ajaxUrl;
  }
      
  public function PluginMenu() {
    add_menu_page(__('Social',self::PluginSlug()), __('Social',self::PluginSlug()), 'manage_options','jetty_social_media_monitoring', array($this, 'RenderPage'), 'dashicons-groups', 25);
    add_submenu_page('jetty_social_media_monitoring', __('Settings',self::PluginSlug()), __('Settings',self::PluginSlug()), 'manage_options', 'jetty_social_media_monitoring_setting' , array($this, 'RenderPageSubmenu'));
    // add_submenu_page('jetty_social_media_monitoring', __('Help',self::PluginSlug()), __('Help',self::PluginSlug()), 'manage_options', 'jetty_social_media_monitoring_help' , array($this, 'RenderPageSubmenuHelp'));
  }

  public static function PluginSlug(){
    $plugin_slug = 'jetty_smm';
    return $plugin_slug;
  }

  public static function CreateInquiry($inquiryArray, $postAuthor){
    // Set Inquiry array defaults
    $postArrayDefaults = [
      'post_content'      => '',
      'post_title'        => '',
      'post_status'       => 'publish',
      'post_type'         => self::$postTypeInquiry,
      'post_author'       => $postAuthor,
      'post_parent'       => 0,
      'post_date'         => NULL,
      'post_date_gmt'     => NULL
    ];
    $inquiryArray = array_merge( $postArrayDefaults, $inquiryArray );

    self::$programaticInquiryArray = $inquiryArray;
    $inquiryId = wp_insert_post( $inquiryArray );
    self::$programaticInquiryArray = NULL;
    
    if ( 'draft' != $inquiryArray[ 'post_status' ] ) { 
      $inquiryArray[ 'ID' ] = $inquiryId; 
      wp_insert_post( $inquiryArray ); 
    }

    return $inquiryId;
  }

  public static function InputName(){
    $inputName = array(
      'twitter_consumer_key',
      'twitter_consumer_secret',
      'twitter_oauth_access_token',
      'twitter_oauth_access_token_secret',
      'twitter_username',
      'ig_client_id',
      'ig_access_token',
      'ig_user_id',
      'fb_app_id',
      'fb_app_secret',
      'fb_gallery_id',
      'youtube_api_key',
      'youtube_id',
      'textarea_feeds'
    );
    return $inputName;
  }

  public function RenderPageSubmenuHelp(){
    ?>
    <div class="wrap">
      <h3><?php _e('Help',self::PluginSlug()); ?></h3>
    </div>
    <?php
  }

  public function RenderPageSubmenu(){
    global $pagenow;

    $screen = get_current_screen();

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }
    if (isset($_POST) && isset($_POST['jetty-smm-settings-submit'])) {
      if($_POST['jetty-smm-settings-submit'] == "Y"){
        foreach ($_POST as $key => $entry)
        {
            if(in_array($key, self::InputName())){
              update_option($key, $_POST[$key]);
            }
        }
      }
    }
  ?>
  <script>
    var imgurlLoading = '<?= plugins_url('assets/img/loading.gif', __FILE__); ?>';
    var all_settings = {};
    var currentScreenId = '<?= $screen->id; ?>';
    all_settings = {
      'value_twitter_consumer_key'              : "<?= esc_html(get_option('twitter_consumer_key', ''));?>",
      'value_twitter_consumer_secret'           : "<?= esc_html(get_option('twitter_consumer_secret', ''));?>",
      'value_twitter_oauth_access_token'        : "<?= esc_html(get_option('twitter_oauth_access_token', ''));?>",
      'value_twitter_oauth_access_token_secret' : "<?= esc_html(get_option('twitter_oauth_access_token_secret', ''));?>",
      'value_twitter_username'                  : "<?= esc_textarea(get_option('twitter_username', ''));?>",
      'value_ig_client_id'                      : "<?= esc_html(get_option('ig_client_id', ''));?>",
      'value_ig_access_token'                   : "<?= esc_html(get_option('ig_access_token', ''));?>",
      'value_ig_user_id'                        : "<?= esc_textarea(get_option('ig_user_id', ''));?>",
      'value_fb_app_id'                         : "<?= esc_html(get_option('fb_app_id', ''));?>",
      'value_fb_app_secret'                     : "<?= esc_html(get_option('fb_app_secret', ''));?>",
      'value_fb_gallery_id'                     : "<?= esc_html(get_option('fb_gallery_id', ''));?>",
      'value_youtube_api_key'                   : "<?= esc_html(get_option('youtube_api_key', ''));?>",
      'value_youtube_id'                        : "<?= esc_html(get_option('youtube_id', ''));?>",
      'value_textarea_feeds'                    : "<?= esc_textarea(get_option('textarea_feeds', ''));?>",
    };
  </script>
    <div class="wrap">
        <h2><?php _e('Settings',self::PluginSlug()); ?></h2>
        <?php 
          settings_errors();
        if ( $pagenow == 'admin.php' && $_GET['page'] == 'jetty_social_media_monitoring_setting' ){
        ?>
        <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'jetty_smm_terms_network'; ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_terms_network" class="nav-tab <?php echo $active_tab == 'jetty_smm_terms_network' ? 'nav-tab-active' : ''; ?>">Search Terms</a>
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_twitter" class="nav-tab <?php echo $active_tab == 'jetty_smm_twitter' ? 'nav-tab-active' : ''; ?>">Twitter</a>
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_fb" class="nav-tab <?php echo $active_tab == 'jetty_smm_fb' ? 'nav-tab-active' : ''; ?>">Facebook</a>
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_ig" class="nav-tab <?php echo $active_tab == 'jetty_smm_ig' ? 'nav-tab-active' : ''; ?>">Instagram</a>
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_youtube" class="nav-tab <?php echo $active_tab == 'jetty_smm_youtube' ? 'nav-tab-active' : ''; ?>">Youtube</a>
            <a href="?page=jetty_social_media_monitoring_setting&tab=jetty_smm_feed" class="nav-tab <?php echo $active_tab == 'jetty_smm_feed' ? 'nav-tab-active' : ''; ?>">Feeds</a>
        </h2>
         
        <form method="POST" id="on_form_settings">
          <div class="content-wrap">
          <?php
          switch ($active_tab) {
            case 'jetty_smm_twitter':
              $html = '';
              $html .= '<h3 class="on_title">'.__('SET YOUR TWITTER API DETAILS HERE', self::PluginSlug()).'</h3>';

              $html .= '<p>';
                $html .= '<label for="twitter_consumer_key">'.__('CONSUMER KEY', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="twitter_consumer_key" name="twitter_consumer_key" value="'.esc_html(get_option('twitter_consumer_key', '')).'" autocomplete="off">';
              $html .= '</p>';

              $html .= '<p>';
                $html .= '<label for="twitter_consumer_secret">'.__('CONSUMER SECRET', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="twitter_consumer_secret" name="twitter_consumer_secret" value="'.esc_html(get_option('twitter_consumer_secret', '')).'" autocomplete="off">';
              $html .= '</p>';

              $html .= '<p>';
                $html .= '<label for="twitter_oauth_access_token">'.__('OAUTH ACCESS TOKEN', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="twitter_oauth_access_token" name="twitter_oauth_access_token" value="'.esc_html(get_option('twitter_oauth_access_token', '')).'" autocomplete="off">';
              $html .= '</p>';

              $html .= '<p>';
                $html .= '<label for="twitter_oauth_access_token_secret">'.__('OAUTH ACCESS TOKEN SECRET', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="twitter_oauth_access_token_secret" name="twitter_oauth_access_token_secret" value="'.esc_html(get_option('twitter_oauth_access_token_secret', '')).'" autocomplete="off">';
              $html .= '</p>';

              echo $html;
              break;

            case 'jetty_smm_ig':
              $html = '';
              $html .= '<h3 class="on_title">'.__('SET YOUR INSTAGRAM API DETAILS HERE', self::PluginSlug()).'</h3>';

              $html .= '<p>';
                $html .= '<label for="ig_client_id">'.__('CLIENT ID', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="ig_client_id" name="ig_client_id" value="'.esc_html(get_option('ig_client_id', '')).'" autocomplete="off">';
              $html .= '</p>';

              $html .= '<p>';
                $html .= '<label for="ig_access_token">'.__('ACCESS TOKEN', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="ig_access_token" name="ig_access_token" value="'.esc_html(get_option('ig_access_token', '')).'" autocomplete="off">';
              $html .= '</p>';

              echo $html; 
              break;

            case 'jetty_smm_fb':
              $html = '';
              $html .= '<h3 class="on_title">'.__('SET YOUR FACEBOOK API DETAILS HERE', self::PluginSlug()).'</h3>';

              $html .= '<p>';
                $html .= '<label for="fb_app_id">'.__('APP ID', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="fb_app_id" name="fb_app_id" value="'.esc_html(get_option('fb_app_id', '')).'" autocomplete="off">';
              $html .= '</p>';

              $html .= '<p>';
                $html .= '<label for="fb_app_secret">'.__('APP SECRET', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="fb_app_secret" name="fb_app_secret" value="'.esc_html(get_option('fb_app_secret', '')).'" autocomplete="off">';
              $html .= '</p>';

              echo $html;
              break;

            case 'jetty_smm_youtube':
              $html = '';
              $html .= '<h3 class="on_title">'.__('SET YOUR YOUTUBE API DETAILS HERE', self::PluginSlug()).'</h3>';

              $html .= '<p>';
                $html .= '<label for="youtube_api_key">'.__('API KEY', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<input type="text" id="youtube_api_key" name="youtube_api_key" value="'.esc_html(get_option('youtube_api_key', '')).'" autocomplete="off">';
              $html .= '</p>';

              echo $html;
              break;

            case 'jetty_smm_feed':
              $html = '';
              $html .= '<h3 class="on_title">'.__('SET YOUR FEEDS HERE', self::PluginSlug()).'</h3>';
              $html .= '<p>';
                $html .= '<label for="textarea_feeds">'.__('You can paste link multiple feed in here using separate comma ( , )', self::PluginSlug()).'</label>';
                $html .= '<br>';
                $html .= '<textarea rows="5" id="textarea_feeds" name="textarea_feeds">'.esc_textarea(get_option('textarea_feeds', '')).'</textarea>';
              $html .= '</p>';
              echo $html;
              break;

            case 'jetty_smm_terms_network':
              $html = '';
               $html .= '<div id="twit_setting"><h3>Twitter</h3><p>';
                $html .= '<label for="twitter_username">'.__('TERMS (add multiple TERM with comma ( , ) separate.', self::PluginSlug());
                $html .= '<b><span class="dashicons dashicons-editor-help" data-social="twitter" id="social-term-help"></span></b>';
                $html .= $this->RenderHelp('twitter');
                $html .= '</label>';
                $html .= '<textarea rows="5" id="twitter_username" name="twitter_username">'.esc_textarea(get_option('twitter_username', '')).'</textarea>';
              $html .= '</p></div>';

              $html .= '<div id="fb_setting"><h3>Facebook</h3><p>';
                $html .= '<label for="fb_gallery_id">'.__('GALLERY ID/PAGE ID.', self::PluginSlug());
                $html .= '<b><span class="dashicons dashicons-editor-help" data-social="facebook" id="social-term-help"></span></b>';
                $html .= $this->RenderHelp('facebook');
                $html .= '</label>';
                $html .= '<input type="text" id="fb_gallery_id" name="fb_gallery_id" value="'.esc_html(get_option('fb_gallery_id', '')).'" autocomplete="off">';
              $html .= '</p></div>';

              $html .= '<div id="ig_setting"><h3>Instagram</h3><p>';
                $html .= '<label for="ig_user_id">'.__('USER ID (add multiple USER ID with comma ( , ) separate.', self::PluginSlug());
                $html .= '<b><span class="dashicons dashicons-editor-help" data-social="instagram" id="social-term-help"></span></b>';
                $html .= $this->RenderHelp('instagram');
                $html .= '</label>';
                $html .= '<textarea rows="5" id="ig_user_id" name="ig_user_id">'.esc_textarea(get_option('ig_user_id', '')).'</textarea>';
              $html .= '</p></div>';

              $html .= '<div id="yt_setting"><h3>Youtube</h3><p>';
                $html .= '<label for="youtube_id">'.__('YOUTUBE ID.', self::PluginSlug());
                $html .= '<b><span class="dashicons dashicons-editor-help" data-social="youtube" id="social-term-help"></span></b>';
                $html .= $this->RenderHelp('youtube');
                $html .= '</label>';
                $html .= '<input type="text" id="youtube_id" name="youtube_id" value="'.esc_html(get_option('youtube_id', '')).'" autocomplete="off">';
              $html .= '</p></div>';

              echo $html;
              break;
          }
        }
          submit_button('Save', 'primary', 'save_jetty_smm_settings'); 
          ?>
          <input type="hidden" name="jetty-smm-settings-submit" value="Y" />
          </div><!-- .content-wrap -->  
        </form>
    </div>
  <?php }

  public function RenderPage(){
    $screen = get_current_screen();
    if($screen->id == 'toplevel_page_jetty_social_media_monitoring'):
  ?>
  <script type="text/javascript">
    var PluginUrl = '<?= plugins_url('assets/jcs', __FILE__); ?>';
    var imgurl = '<?= plugins_url('assets/img/loading.gif', __FILE__); ?>';
    var url_social_stream_obj = {};
    var all_setting = {};
    url_social_stream_obj = {
      'rss'       : PluginUrl+'/rss.php',
      'twitter'   : PluginUrl+'/twitter.php',
      'facebook'  : PluginUrl+'/facebook.php'
    };

    all_setting = {
      'value_twitter_consumer_key'              : "<?= esc_html(get_option('twitter_consumer_key', ''));?>",
      'value_twitter_consumer_secret'           : "<?= esc_html(get_option('twitter_consumer_secret', ''));?>",
      'value_twitter_oauth_access_token'        : "<?= esc_html(get_option('twitter_oauth_access_token', ''));?>",
      'value_twitter_oauth_access_token_secret' : "<?= esc_html(get_option('twitter_oauth_access_token_secret', ''));?>",
      'value_twitter_username'                  : "<?= esc_textarea(get_option('twitter_username', ''));?>",
      'value_ig_client_id'                      : "<?= esc_html(get_option('ig_client_id', ''));?>",
      'value_ig_access_token'                   : "<?= esc_html(get_option('ig_access_token', ''));?>",
      'value_ig_user_id'                        : "<?= esc_textarea(get_option('ig_user_id', ''));?>",
      'value_fb_app_id'                         : "<?= esc_html(get_option('fb_app_id', ''));?>",
      'value_fb_app_secret'                     : "<?= esc_html(get_option('fb_app_secret', ''));?>",
      'value_fb_gallery_id'                     : "<?= esc_html(get_option('fb_gallery_id', ''));?>",
      'value_youtube_api_key'                   : "<?= esc_html(get_option('youtube_api_key', ''));?>",
      'value_youtube_id'                        : "<?= esc_html(get_option('youtube_id', ''));?>",
      'value_textarea_feeds'                    : "<?= esc_textarea(get_option('textarea_feeds', ''));?>",
    };
  </script>
      <div class='wrap' id="on_monitoring_main">
        <h2>Social Monitoring</h2>
        <div class="if_no_content_streaming" style="display: none;">
          <h3>No Social Content</h3>
          <p><a href="<?php esc_url(menu_page_url( 'jetty_social_media_monitoring_setting', 1 )); ?>" class="button button-primary">Settings</a></p>
        </div>

        <div id="wrapper" class="jetty_smm_monitoring_main">
          <p><input type="text" class="quicksearch" placeholder="Live Search" /> <a href="<?php esc_url(menu_page_url( 'jetty_social_media_monitoring_setting', 1 )); ?>" id="jac_button_settings"><span class="jac_on_settings">Settings</span></a></p>
          <div id="container"> 
            <div id="wall">
              <div id="jetty-smm-social-stream"></div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
  <?php
endif;
  }

  public function InitPlugin() {
    add_action('admin_menu', array( $this , 'PluginMenu' ));
  }
} ?>