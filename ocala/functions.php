<?php
/**
 * ocala functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ocala
 */
require_once 'include/Hps.php';

if ( ! function_exists( 'ocala_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ocala_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ocala, use a find and replace
     * to change 'ocala' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'ocala', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'ocala' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'ocala_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif;
add_action( 'after_setup_theme', 'ocala_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ocala_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ocala_content_width', 640 );
}
add_action( 'after_setup_theme', 'ocala_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ocala_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'ocala' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'ocala' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ocala_widgets_init' );

function get_link_thanks_page(){
    $link_thanks_page = "none";
    // Get attribute thanks page
    $args = array(
        'post_type'  => 'page',
        'meta_query' => array(
            array(
                'key'   => '_wp_page_template',
                'value' => 'thankyou-page.php'
            )
        ),
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'orderby' => 'modified'
    );
    $query = new WP_Query($args);

    if(!empty($query->posts)){
        $link_thanks_page = get_permalink($query->posts[0]->ID);
        return $link_thanks_page;
    } else {
        return $link_thanks_page;
    }

}


/**
 * Enqueue scripts and styles.
 */
function ocala_scripts() {
    wp_enqueue_style( 'ocala-style', get_stylesheet_uri() );

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/style/slick.css',false,'1.1','all');
    wp_enqueue_script( 'ocala-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'jquery-multipage', get_template_directory_uri() . '/js/jquery.multipage.js', array('jquery'));
    wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), '2.1', true);
    wp_enqueue_script('heartland-securesubmit', 'https://api2.heartlandportico.com/SecureSubmit.v1/token/2.1/securesubmit.js', array(), '2.1', true);

    wp_enqueue_script( 'ocala-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'heartland-securesubmit'));
    wp_localize_script( 'ocala-scripts', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script( 'ocala-scripts', 'LinkThanksPage', array('linkpage' => get_link_thanks_page()) );

    wp_enqueue_script( 'multiform', get_template_directory_uri() . '/js/multiform.js', array('jquery'));

    wp_enqueue_script( 'ocala-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'));

    wp_enqueue_script( 'ocala-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ocala_scripts' );


/**
 * Admin scripts for displaying member ID
 */
function ocala_scripts_admin_enqueue_scripts() {
    $screen       = get_current_screen();
    global $post;
    if (in_array($screen->id, array('leadership'))) {
        $partnership =  array(
            'previous_option' => get_post_meta( $post->ID, '_meta_member_id', true )
        );
        wp_register_script( 'jonggrang.task', get_template_directory_uri() . '/js/task.js', array(), '0.0.1');
        wp_enqueue_script( 'ocala-admin-partnership', get_template_directory_uri() . '/js/partnership.js', array('jquery', 'jonggrang.task'));
        wp_localize_script( 'ocala-admin-partnership', 'partnership_settings', $partnership );
    }
}
add_action('admin_enqueue_scripts', 'ocala_scripts_admin_enqueue_scripts');

/** ------- Tambahan -------------- */

/**
 * Leadership CPT
 */
add_action( 'init', 'codex_leadership_init' );

function codex_leadership_init() {
    $labels = array(
        'name'               => _x( 'Partnerships', 'post type general name', 'ocala' ),
        'singular_name'      => _x( 'Partnership', 'post type singular name', 'ocala' ),
        'menu_name'          => _x( 'Partnership', 'admin menu', 'ocala' ),
        'name_admin_bar'     => _x( 'Partnership', 'add new on admin bar', 'ocala' ),
        'add_new'            => _x( 'Add New', 'Partnership', 'ocala' ),
        'add_new_item'       => __( 'Add New Partnership', 'ocala' ),
        'new_item'           => __( 'New Parternship', 'ocala' ),
        'edit_item'          => __( 'Edit Parternship', 'ocala' ),
        'view_item'          => __( 'View Parternship', 'ocala' ),
        'all_items'          => __( 'All Parterships', 'ocala' ),
        'search_items'       => __( 'Search Parterships', 'ocala' ),
        'parent_item_colon'  => __( 'Parent Parterships:', 'ocala' ),
        'not_found'          => __( 'No Parterships found.', 'ocala' ),
        'not_found_in_trash' => __( 'No Parterships found in Trash.', 'ocala' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'ocala' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'leadership' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor' )
    );

    register_post_type( 'leadership', $args );
}

/**
 * Price Metabox
 */

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
    // add_meta_box( 'price', 'Price', 'price_cb', 'leadership', 'normal', 'high' );
    $screens = array( 'leadership' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'price',            // Unique ID
            'Setting',      // Box title
            'price_cb',  // Content callback
             $screen                      // post type
        );
    }
}

function price_cb($post)
{

    $key_1_value = get_post_meta( get_the_ID(), '_meta_price_value', true );
    $key_2_value = get_post_meta( get_the_ID(), '_meta_favorite_value', true );
    ?>

        <label for="price_value">Price :</label>
        <input type="number" name="price_value" id="price_value" value="<?php if ( ! empty( $key_1_value ) ) {echo $key_1_value;} ?>"  />
        <br />
        <br />
        <input type="checkbox" name="c_favorite" id="c_favorite" value="favorite" <?php echo ($key_2_value=='favorite' ? 'checked' : '');?>> Most Popular
    <?php
}

add_action ('save_post', 'meta_price_save');
function meta_price_save($post_id) {
    if( isset( $_POST['price_value'] ) ) {
        update_post_meta( $post_id, '_meta_price_value', $_POST['price_value']);
    }

        update_post_meta( $post_id, '_meta_favorite_value', $_POST['c_favorite']);
        update_post_meta( $post_id, '_meta_member_id', $_POST['member_value']);
}



/**
 * member Metabox
 */

add_action( 'add_meta_boxes', 'cd_meta_box_id' );
function cd_meta_box_id()
{
    // add_meta_box( 'price', 'Price', 'price_cb', 'leadership', 'normal', 'high' );
    $screens = array( 'leadership' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'member_id',            // Unique ID
            'Member ID',      // Box title
            'member_cb',  // Content callback
             $screen                      // post type
        );
    }
}

function member_cb($post)
{

    $key_member_id = get_post_meta( get_the_ID(), '_meta_member_id', true );
    ?>

        <label for="member_value">Member ID :</label>
        <input type="number" name="member_value" id="member_value" value="<?php if ( ! empty( $key_member_id ) ) {echo $key_member_id;} ?>"  />
    <?php
}




/**
 * Logo
 */

function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
        'title'       => __( 'Logo', 'themeslug' ),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );
    $wp_customize->add_setting( 'themeslug_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
        'label'    => __( 'Logo', 'themeslug' ),
        'section'  => 'themeslug_logo_section',
        'settings' => 'themeslug_logo',
    ) ) );
}
add_action( 'customize_register', 'themeslug_theme_customizer' );

add_filter( 'post_updated_messages', 'post_published' );

function post_published( $messages )
{
 if( get_post_type() === 'leadership' )
    $messages['post'] = array(
     0 => '',
        1 => __('Partnership updated.'),
        2 => __('Custom field updated.'),
        3 => __('Custom field updated.'),
        4 => __('Partnership updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Partnership restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => __('Partnership published.'),
        7 => __('Partnership saved.'),
        8 => __('Partnership submitted.'),
        9 => sprintf( __('Partnership scheduled for: <strong>%1$s</strong>.'),
     // translators: Publish box date format, see http://php.net/date
     date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
        10 => __('Partnership draft updated.'),
    );

    return $messages;
}

function ocalaChargeToken($chargeService, $suToken, $amount, $validCardHolder = null, $additionalData = null)
{
    try {
        return $chargeService->charge(
            $amount,
            'usd',
            $suToken,
            $validCardHolder,
            false,
            $additionalData
        );
    } catch (CardException $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    } catch (Exception $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    }
}

function ocalaGetTransaction($chargeService,$transactionId){
    try {
        return $chargeService->get($transactionId);
    } catch (CardException $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    } catch (Exception $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    }
}

function ocalaListTransaction($chargeService, $startDate, $endDate, $filterBy = null){
    try {
        return $chargeService->listTransactions(
            $startDate,
            $endDate,
            $filterBy
        );
    } catch (CardException $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    } catch (Exception $e) {
        return 'Failure: ' . get_class($e) . $e->getMessage();
    }
}

function ocalaCreateBasicMembershipMicro($name, $email, $memberId){
    $mcid_ocala = 'mcid_ocala';
    $data_body = array('Name' => $name, 'Email' => $email, 'StatusType'=> 2, 'MemberTypeId' => $memberId);
    $endpoint = 'http://api.micronetonline.com/v1/associations(0698)/members';
    $apikey = 'f14de9e7-3b14-4e1b-80f2-7059bfce25fd';
    $response = wp_remote_post( $endpoint, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array('X-ApiKey' => $apikey, 'Content-Type' => 'application/json'),
        'body' => json_encode($data_body),
        'cookies' => array()
        )
    );

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo json_encode(array(
            'error' => $error_message
        ));
    } else {
        $response_gt = json_decode($response['body'], true);
        if(isset($_COOKIE[$mcid_ocala])) {
            unset( $_COOKIE[$mcid_ocala] );
            setcookie( $mcid_ocala, $response_gt['Id'], 30 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
        } else {
            setcookie( $mcid_ocala, $response_gt['Id'], 30 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
        }
    }
}
function ocalaCreateRep($fname,$lname,$workphone,$cname){
    $status = 2;
    if(isset($_COOKIE['mcid_ocala'])) {
        $data_body_rep = array(
            'MemberId' => $_COOKIE['mcid_ocala'],
            'Name' => $cname,
            'WorkPhone' => $workphone,
            'Primary' => true,
            'FirstName' => $fname,
            'LastName' => $lname,
            'Status' => $status,
            'ShowAnyToPublic' => true,
            'ShowAnyToMembers' => true
        );
        $endpoint = 'http://api.micronetonline.com/v1/associations(0698)/representatives';
        $apikey = 'f14de9e7-3b14-4e1b-80f2-7059bfce25fd';
        $response = wp_remote_post( $endpoint, array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('X-ApiKey' => $apikey, 'Content-Type' => 'application/json'),
                'body' => json_encode($data_body_rep),
                'cookies' => array()
            )
        );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            // echo json_encode(array(
            //     'error' => $error_message
            // ));
        } else {
            // unset( $_COOKIE['mcid_ocala'] );
            // setcookie( 'mcid_ocala', '', time() - ( 15 * 60 ) );
        }
    }
}
function ocalaCreateDetailsMembershipMicro(
    $OrganizationName,
    $Line1,
    $City,
    $Region,
    $PostalCode,
    $Line2,
    $Country,
    $Email,
    $Website,
    $ContactPrimaryPhone,
    $comments ){
    if(isset($_COOKIE['mcid_ocala'])) {
        $dta_bdy = array(
                    'OrganizationName' => $OrganizationName,
                    'Line1' => $Line1,
                    'City' => $City,
                    'Region' => $Region,
                    'PostalCode' => $PostalCode,
                    'Line2' => $Line2,
                    'Country' => $Country,
                    'Email' => $Email,
                    'Website' => $Website,
                    'ContactPrimaryPhone' => $ContactPrimaryPhone,
                    'Comment' => $comments
                    );
        $endpoint = 'http://api.micronetonline.com/v1/associations(0698)/members('.$_COOKIE['mcid_ocala'].')/details';
        $apikey = 'f14de9e7-3b14-4e1b-80f2-7059bfce25fd';
        $response = wp_remote_request( $endpoint, array(
                'method' => 'PUT',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array('X-ApiKey' => $apikey, 'Content-Type' => 'application/json'),
                'body' => json_encode($dta_bdy),
                'cookies' => array()
            )
        );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            // echo json_encode(array(
            //     'error' => $error_message
            // ));
        } else {
            unset( $_COOKIE['mcid_ocala'] );
            setcookie( 'mcid_ocala', '', time() - ( 15 * 60 ) );
        }

        }
}

function ocala_ajax_get_member_type() {
    $endpoint = 'http://api.micronetonline.com/v1/associations(0698)/members/types';
    $apikey = 'f14de9e7-3b14-4e1b-80f2-7059bfce25fd';
    $response = wp_remote_get( $endpoint, array(
        'method' => 'GET',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array('X-ApiKey' => $apikey),
        'body' => array(),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        die();
    } else {
        $data_types = json_decode($response["body"], true );
        echo json_encode($data_types);
        die();
    }
}
add_action('wp_ajax_ocala_get_member_type', 'ocala_ajax_get_member_type');
add_action('wp_ajax_nopriv_ocala_get_member_type', 'ocala_ajax_get_member_type');

// Create Membership
function ocl_ajax_create_membership() {
    $today = date("n/j/Y");
    ocalaCreateRep($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['companyName']);
    ocalaCreateDetailsMembershipMicro(
        $_POST['companyName'],
        $_POST['physicalAddress'],
        $_POST['city'],
        $_POST['state'],
        $_POST['zipcode'],
        $_POST['physicalAddress2'],
        $_POST['country'],
        $_POST['email'],
        $_POST['cellphone'],
        $_POST['phone'],
        $_POST['comments']
    );
     die();
}

add_action('wp_ajax_ocl_create_membership', 'ocl_ajax_create_membership');
add_action('wp_ajax_nopriv_ocl_create_membership', 'ocl_ajax_create_membership');

// Handle single-token payment
function ocala_ajax_single_token() {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        $config = new HpsServicesConfig();
        $config->secretApiKey = 'skapi_cert_MePZAQDxnl4ATU8YwqbiQmzXE5iTmaK30VxfeXWfsw';
        $config->publicApiKey = 'pkapi_cert_BOP9XNMjW9NNUOgb4Y';
        // the following variables will be provided to you during certificaiton.
        $config->versionNumber = '0000';
        $config->developerId = '000000';

        $chargeService = new HpsCreditService($config);

        $validCardHolder = new HpsCardHolder();
        // $address = new HpsAddress();
        // $address->zip = "75024";
        // $address->address = "6860 Dallas Pkwy";
        // $validCardHolder->address = $address;
        $validCardHolder->firstName = $_POST["name"];

        $dateFormat = 'Y-m-d\TH:i:s.00\Z';
        $dateMinus10 = new DateTime();
        $dateMinus10->sub(new DateInterval('P10D'));
        $dateMinus10Utc = gmdate($dateFormat, $dateMinus10->Format('U'));
        $nowUtc = gmdate($dateFormat);

        $suToken = new HpsTokenData();
        $suToken->tokenValue = $_POST['token'];

        $response = ocalaChargeToken($chargeService, $suToken, $_POST['amount'], $validCardHolder, $details);
        $getTranscId = ocalaGetTransaction($chargeService, $response->transactionId);
        $listTransaction = ocalaListTransaction($chargeService, $dateMinus10Utc, $nowUtc, "CreditSale");

        if (is_string($response)) {
            echo json_encode(array(
                'error' => $response,
                'token' => $_POST['token']
            ));
            die(1);
        } else {
            ocalaCreateBasicMembershipMicro($_POST["name"], $_POST["email"], $_POST["memberId"]);
            echo json_encode(array(
                'no error' => true,
                'token' => $_POST['token'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'memberId' => $_POST["memberId"]
            ));
            die(1);
        }
    }
}
add_action('wp_ajax_ocala_single_token_payment', 'ocala_ajax_single_token');
add_action('wp_ajax_nopriv_ocala_single_token_payment', 'ocala_ajax_single_token');

function ocala_ajax_verify_recaptcha() {
    $token = $_POST['recaptcha'];
    $secret = '6LdJXygTAAAAAFcy2TU2xIYdHhCCex6p0MphEp4j';
    // try get IP address
    $ip = '';
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = (string) $_SERVER['REMOTE_ADDR'];
    } else {
        $proxies = $_SERVER['X_FORWARDED_FOR'];
        if (empty($proxies)) {
            $ip = '';
        } else {
            $proxies = array_map('trim', explode(',', $proxies[0]));
            $ip = array_pop($proxies);
        }
    }
    $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array( 'secret' => $secret, 'response' => $token, 'ip' => $ip ),
        'cookies' => array()
    ));
    if ( is_wp_error( $response ) ) {
       $error_message = $response->get_error_message();
       echo json_encode(array(
            'error' => $error_message
        ));
       die();
    } else {
       echo json_encode(array(
            'error'    => false,
            'response' => $response['body']
        ));
       die();
    }
}

add_action('wp_ajax_ocala_verify_recaptcha', 'ocala_ajax_verify_recaptcha');
add_action('wp_ajax_nopriv_ocala_verify_recaptcha', 'ocala_ajax_verify_recaptcha');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
