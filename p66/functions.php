<?php
/**
 * p66 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package p66
 */

if ( ! function_exists( 'p66_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function p66_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on p66, use a find and replace
	 * to change 'p66' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'p66', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'p66' ),
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
	add_theme_support( 'custom-background', apply_filters( 'p66_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


}
endif;
add_action( 'after_setup_theme', 'p66_setup' );

add_action( 'init', 'p66_excerpts_to_pages' );
function p66_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function p66_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'p66_content_width', 640 );
}
add_action( 'after_setup_theme', 'p66_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function p66_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'p66' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'p66' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'p66_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function p66_scripts() {
	wp_enqueue_style( 'p66-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'p66-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'p66-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style('opensans','https://fonts.googleapis.com/css?family=Open+Sans:400,700,800');

	wp_enqueue_style( 'p66-slick-style', get_template_directory_uri() . '/inc/slick.css' );


	wp_enqueue_style( 'p66-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'p66-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	// wp_enqueue_script( 'p66-bootstrap-toolkit-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap-responsive-toolkit.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'p66-slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), '20151215', true );

	wp_enqueue_script( 'p66-images-loaded-js', get_template_directory_uri() . '/js/imagesloaded.min.js', array(), '20151215', true );

	wp_enqueue_script( 'p66-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'p66-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'p66-dependence', get_template_directory_uri() . '/js/dependencies.js', array(), '', true );

	wp_enqueue_script( 'p66-app-js', get_template_directory_uri() . '/js/app.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'p66-script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), '20151215', true );





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'p66_scripts' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function p66_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'p66_pingback_header' );


// search header icon
function new_nav_menu_items($items, $args) {
	//print_r($args->walker->p_nav);
		if (isset($args->walker->p_nav)) {
			if ($args->walker->p_id == -1) {
				$items = '<div class="mobile-no-subnav"></div>';
			}
		} else {
			if( $args->theme_location == 'menu-1' ){
				$homelink = '<div class="mobile-search-container hidden-xs"><span class="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only">Site search</span></span><span class="close-btn"><span>Close search</span></span></div>';
				$items = $items.$homelink ;
			}
		}

    return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );

function p66_array_first($array, callable $callback, $default = null) {
	foreach ($array as $k => $v) {
		if (call_user_func($callback, $v, $k)) {
			return $v;
		}
	}
}

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
       /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
            header#masthead {
                margin-top: 18px;
            }
        }
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
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
require get_template_directory() . '/inc/p66-custom-customizer.php';

/**
 * Load all custom widget.
 */
require get_template_directory() . '/inc/custom-widget-loader.php';

/**
 * Load custom shortcodes.
 */
require get_template_directory() . '/inc/p66-custom-shortcodes.php';

/**
 * Walker
 */
require get_template_directory() . '/inc/p66-menu-walker.php';


/***** Add Custom Image Sizes *****/

function p66_image_sizes() {
	add_image_size('promo-full-width', 1280, 560, true);
	add_image_size('promo-mobile', 400, 200, true);
	add_image_size('image-grid', 354, 354, true);
	add_image_size('image-grid-detail', 351);
	add_image_size('carousel', 1064, 550, true);
	add_image_size('feature-stories', 406, 250, true);
}
add_action('after_setup_theme', 'p66_image_sizes');

function p66_custom_excerpts($limit = 40) {
    echo '<p>'.wp_trim_words(get_the_excerpt(), $limit, '').'</p>';
}

