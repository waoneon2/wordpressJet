<?php
/**
 * Alabama Policy Institute functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Alabama_Policy_Institute
 */

if ( ! function_exists( 'alabama_policy_institute_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function alabama_policy_institute_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Alabama Policy Institute, use a find and replace
		 * to change 'alabama-policy-institute' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'alabama-policy-institute', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages, and declare new size
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 428, 240, true );
		add_image_size('alpi-full-width', 1327, 686, true);
		add_image_size('alpi-taxonomy-heading', 880, 455, true);
		add_image_size('alpi-research-thumbnail', 440, 440, true);
		add_image_size('alpi-staff-thumbnail', 317, 444, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'alabama-policy-institute' ),
			'menu-2' => esc_html__( 'Footer', 'alabama-policy-institute')
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
		add_theme_support( 'custom-background', apply_filters( 'alabama_policy_institute_custom_background_args', array(
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
add_action( 'after_setup_theme', 'alabama_policy_institute_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alabama_policy_institute_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alabama_policy_institute_content_width', 640 );
}
add_action( 'after_setup_theme', 'alabama_policy_institute_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alabama_policy_institute_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'alabama-policy-institute' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'alabama-policy-institute' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'alabama_policy_institute_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alabama_policy_institute_scripts() {
	global $post;
	wp_enqueue_style( 'alabama-policy-institute-style', get_stylesheet_uri() );

	wp_enqueue_script( 'alabama-policy-institute-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'alabama-policy-institute-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), null, true );
	wp_enqueue_script( 'site-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '0.0.2', true );
	wp_register_script('api-fp-readmore', get_template_directory_uri() . '/js/show-more-front-page.js', ['jquery'], '0.0.1', true);
	wp_localize_script('api-fp-readmore', 'api_fp_readmore', [
		'ajax_url' 			=> admin_url('admin-ajax.php', 'relative')
	]);
	wp_register_script('api-fp-readmore2', get_template_directory_uri() . '/js/show-more-pub-page.js', ['jquery'], '0.0.1', true);
	wp_localize_script('api-fp-readmore2', 'api_fp_readmore2', [
		'ajax_url' 			=> admin_url('admin-ajax.php', 'relative')
	]);

	if (is_singular('staff')) {
		$emp_authorID = get_post_meta($post->ID, 'api_staff_emp_author', true);
		wp_localize_script('api-fp-readmore', 'api_fp_readmore', [
			'ajax_url' 			=> admin_url('admin-ajax.php', 'relative'),
			'author_ID' 		=> $emp_authorID,
		]);
		wp_enqueue_script('api-fp-readmore');
	}
	if (is_tax()) {
		$current_taxonomy = get_query_var( 'taxonomy' );
		$current_term = get_query_var( 'term' );
		wp_localize_script('api-fp-readmore', 'api_fp_readmore', [
			'ajax_url' 			=> admin_url('admin-ajax.php', 'relative'),
			'tax' 				=> $current_taxonomy,
			'term' 				=> $current_term
		]);
		wp_enqueue_script('api-fp-readmore');
	}
	if (is_category()) {
		$obj = get_queried_object();
		wp_localize_script('api-fp-readmore', 'api_fp_readmore', [
			'ajax_url' 			=> admin_url('admin-ajax.php', 'relative'),
			'catID' 			=> $obj->term_id
		]);
		wp_enqueue_script('api-fp-readmore');
	}
	if (is_page()) {
		$obj = get_queried_object();
		wp_localize_script('api-fp-readmore2', 'api_fp_readmore2', [
			'ajax_url' 			=> admin_url('admin-ajax.php', 'relative'),
			'catID' 			=> $obj->term_id
		]);
		wp_enqueue_script('api-fp-readmore2');
	}

	if (is_front_page() || is_home()) {
		wp_enqueue_script('api-fp-readmore');
	}

	if ( is_tax( 'timeline' )) {
		wp_enqueue_style( 'alabama-policy-institute-timeline', get_template_directory_uri() . '/css/jquery.range.css' );
		wp_enqueue_script( 'alabama-policy-institute-timeline', get_template_directory_uri() . '/js/jquery.range-min.js', array( 'jquery' ), '0.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'alabama_policy_institute_scripts' );

function alabama_policy_institute_scripts_admin() {
	wp_register_style( 'alabama-policy-institute-style_admin', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'alabama-policy-institute-style_admin' );
}
add_action( 'admin_enqueue_scripts', 'alabama_policy_institute_scripts_admin' );

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
require get_template_directory() . '/inc/alabama-custom-customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load custom post types
 */
require get_template_directory() . '/post-types/research.php';
require get_template_directory() . '/post-types/staff.php';

/**
 * Menu walker
 */
require get_template_directory() . '/inc/class-alabama-nav-walker.php';
/**
 * Load custom taxonomies
 */
$taxonomies = array(
	'publication.php',
	'topic.php',
	'initiative.php',
	'press.php',
	'multimedia.php',
	'timeline.php',

);
foreach ( $taxonomies as $tax ) {
	require get_template_directory() . '/taxonomies/' . $tax;
}


function alabama_policy_institute_handle_ajax()
{
	 if (defined('DOING_AJAX')) {
        require_once get_template_directory() . '/inc/ajax.php';
    }
}
add_action('init', 'alabama_policy_institute_handle_ajax');

function alabama_policy_institute_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999;

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('« Prev'),
			'next_text'    => __('Next »'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination = '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li>$page</li>";
			continue;
		}

		$pagination .= '</ul>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}

function alabama_policy_institute_get_excerpt($count){
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  return $excerpt;
}