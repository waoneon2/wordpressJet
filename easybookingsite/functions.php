<?php
/**
 * staytohelp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package staytohelp
 */

if ( ! function_exists( 'sth_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sth_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on staytohelp, use a find and replace
	 * to change 'sth' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sth', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'sth' ),
		'primary' => esc_html__( 'Header Menu', 'sth')
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
	add_theme_support( 'custom-background', apply_filters( 'sth_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'sth_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sth_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sth_content_width', 640 );
}
add_action( 'after_setup_theme', 'sth_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sth_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sth' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sth' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sth_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sth_scripts() {
	wp_enqueue_style( 'sth-google-fonts','https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
	wp_enqueue_style( 'sth-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'sth-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'sth-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'sth-animations', get_template_directory_uri() . '/inc/animate.min.css' );

	wp_enqueue_style( 'sth-default-css', get_template_directory_uri() . '/inc/default.css' );

	wp_enqueue_style( 'sth-orange-css', get_template_directory_uri() . '/inc/orange.css' );

	wp_enqueue_style( 'sth-style', get_stylesheet_uri() );

	wp_enqueue_style( 'sth-style-responsive', get_template_directory_uri() . '/inc/style-responsive.css' );

	wp_enqueue_script( 'sth-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'sth-scrollmonitor-js', get_template_directory_uri() . '/js/scrollMonitor.js', array('jquery'), '', true );

	wp_enqueue_script( 'sth-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'sth-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'sth-pace', get_template_directory_uri() . '/js/pace.js', array('jquery'), '0.0.1', false);

	wp_enqueue_script( 'sth-app-main', get_template_directory_uri() . '/js/app.js', array('sth-pace'), '0.0.1', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sth_scripts' );

function printHeaderImage() {
	$headerImage = get_header_image();
	if ( '' == $headerImage ) {
		$headerImage = get_template_directory_uri() . '/images/header_logo.png';
	}
	echo( $headerImage );
}

add_action( 'init', 'sth_excerpts_to_pages' );
function sth_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        @media (min-width: 768px) {
            .navbar-fixed-top {
                top: 32px;
            }
        }
		@media (max-width: 767px){
			.navbar-fixed-top {
                top: 48px;
            }
		}
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

function defaultAssetsImage($name_of_section){
	if(empty($name_of_section)){
		return false;
	} else {
		switch ($name_of_section) {
			case 'content-main':
				$cm_assets = get_template_directory_uri() . '/images/ebs_image/body_hero.jpg';
				return $cm_assets;
				break;

			case 'feature-one':
				$fo = array(
					1 => get_template_directory_uri() . '/images/ebs_image/clock24.png',
					2 => get_template_directory_uri() . '/images/ebs_image/customize.png',
					3 => get_template_directory_uri() . '/images/ebs_image/money.png'
				);
				return $fo;
				break;

			case 'feature-two-image':
				$fti = get_template_directory_uri() . '/images/ebs_image/responsive_template.png';
				return $fti;
				break;

			case 'feature-two':
				$ft = array(
					1  => get_template_directory_uri() . '/images/ebs_image/tie.png',
					2  => get_template_directory_uri() . '/images/ebs_image/email.png',
					3  => get_template_directory_uri() . '/images/ebs_image/chartline.png',
					4  => get_template_directory_uri() . '/images/ebs_image/passport.png',
					5  => get_template_directory_uri() . '/images/ebs_image/controlpanel.png',
					6  => get_template_directory_uri() . '/images/ebs_image/cog.png',
					7  => get_template_directory_uri() . '/images/ebs_image/wallet.png',
					8  => get_template_directory_uri() . '/images/ebs_image/target.png',
					9  => get_template_directory_uri() . '/images/ebs_image/chartcolumn.png',
					10 => get_template_directory_uri() . '/images/ebs_image/talogo.png'
				);
				return $ft;
				break;

			case 'demo-ribbon-bg':
				$drb = get_template_directory_uri() . '/images/ebs_image/cta_mid_bgnd.jpg';
				return $drb;
				break;

			case 'demo-ribbon-icon':
				$dri = get_template_directory_uri() . '/images/ebs_image/suitcase.png';
				return $dri;
				break;

			case 'signup-ribbon-bg':
				$srb = get_template_directory_uri() . '/images/ebs_image/cta_bottom_bgnd.jpg';
				return $srb;
				break;

			case 'signup-ribbon-icon':
				$sri = get_template_directory_uri() . '/images/ebs_image/pen_orange.png';
				return $sri;
				break;

			case 'footer-setting':
				$fl = get_template_directory_uri() . '/images/ebs_image/footer_logo.png';
				return $fl;
				break;
			
			default:
				return false;
				break;
		}
	}
}

function ebs_create_default_menu(){
	$menu_name = "Easy Booking Site Menu";
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if(!$menu_exists){
		$menu_id = wp_create_nav_menu($menu_name);
		// Set up default menu items
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' =>  __('Home'),
	        'menu-item-classes' => 'home',
	        'menu-item-url' => '#home', 
	        'menu-item-type' => 'custom',
	        'menu-item-status' => 'publish'));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' =>  __('Features'),
	        'menu-item-classes' => 'features',
	        'menu-item-url' => '#features',
	        'menu-item-type' => 'custom',
	        'menu-item-status' => 'publish'));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' =>  __('Sign up'),
	        'menu-item-classes' => 'signup',
	        'menu-item-url' => '#sign_up',
	        'menu-item-type' => 'custom',
	        'menu-item-status' => 'publish'));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' =>  __('Contact Us'),
	        'menu-item-classes' => 'contactus',
	        'menu-item-url' => '#contact_us',
	        'menu-item-type' => 'custom',
	        'menu-item-status' => 'publish'));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' =>  __('Site Administration'),
	        'menu-item-classes' => 'siteadministration',
	        'menu-item-url' => esc_url('https://my.ezbookingsite.com/admin'),
	        'menu-item-type' => 'custom',
	        'menu-item-status' => 'publish'));
	    $locations = get_theme_mod( 'nav_menu_locations' );
		if(!empty($locations)){
		    foreach($locations as $locationId => $menuValue)
		    {
		        switch($locationId)
		        {
		            case 'primary':
		                $menu = get_term_by('name', $menu_name, 'nav_menu');
		            break;
		        }

		        if(isset($menu))
		        {
		            $locations[$locationId] = $menu->term_id;
		        }
		    }

		    set_theme_mod('nav_menu_locations', $locations);
		}
	} else {
		$locations = get_theme_mod( 'nav_menu_locations' );
		if(!empty($locations)){
		    foreach($locations as $locationId => $menuValue)
		    {
		        switch($locationId)
		        {
		            case 'primary':
		                $menu = get_term_by('name', $menu_name, 'nav_menu');
		            break;
		        }

		        if(isset($menu))
		        {
		            $locations[$locationId] = $menu->term_id;
		        }
		    }

		    set_theme_mod('nav_menu_locations', $locations);
		}
	}	
}
ebs_create_default_menu();

require get_template_directory() . '/inc/sth-header-custom-menu.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom customizer.
 */
require get_template_directory() . '/inc/sth-custom-customizer.php';
