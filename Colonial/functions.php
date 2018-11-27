<?php
/**
 * Corporate functions and definitions
 *
 * @package Corporate
 */

if ( ! function_exists( 'jetty_corporate_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jetty_corporate_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Corporate, use a find and replace
	 * to change 'jetty-corporate-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'jetty-corporate-theme', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => esc_html__( 'Header Menu', 'jetty-corporate-theme' ),
		'footer' => esc_html__( 'Footer Menu', 'jetty-corporate-theme' ),
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
	add_theme_support( 'custom-background', apply_filters( 'jetty_corporate_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // jetty_corporate_theme_setup
add_action( 'after_setup_theme', 'jetty_corporate_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jetty_corporate_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jetty_corporate_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jetty_corporate_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function jetty_corporate_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'jetty-corporate-theme' ),
		'id'            => 'header-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jetty-corporate-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'jetty_corporate_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jetty_corporate_theme_scripts() {
	wp_enqueue_style( 'jetty-corporate-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jetty-corporate-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'jetty-corporate-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jetty_corporate_theme_scripts' );

/**
 * Put the archive type into it's own span.
 */
function edit_archive_title( $title ) {
	if ( is_category() || is_tag() || is_author() || is_year() || is_month() || is_day() ) {
		$firstColonIndex = strpos( $title, ':' );
		$archiveType     = substr( $title, 0, $firstColonIndex + 1 );

		$title =
			'<span class="archive-type">' .
				$archiveType .
			'</span>' .
			substr( $title, $firstColonIndex + 1 );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'edit_archive_title' );

/**
 * Customizer to add Google Analytic Code
 */

if(!function_exists('colonial_custom_customizer')):
	function colonial_custom_customizer($wp_customize){
		$wp_customize->add_section('add_ga_id',array(
	        'title' => __('Google Analytic','jetty-corporate-theme'),
	        'priority' => 30
	    ));

	    $wp_customize->add_setting('colonial_field_ga_analytic_id');
	    $wp_customize->add_control( 
	        new WP_Customize_Control( 
	        $wp_customize, 
	        'colonial_field_ga_analytic_id', 
	        array(
	            'label'      	=> __( 'Google Analytic Field', 'jetty-corporate-theme' ),
	            'description' 	=> __('This is to adding Google Analytic code to theme.<br /> Example: <b>UA-84821720-1</b>','jetty-corporate-theme'),
	            'section'   	=> 'add_ga_id',
	            'settings'   	=> 'colonial_field_ga_analytic_id',
	            'type'       	=> 'text',
	        ) ) 
	    );
	}
	add_action( 'customize_register', 'colonial_custom_customizer' );
endif;

if(!function_exists('cobalt_add_js_ga_analytic')):
function cobalt_add_js_ga_analytic() {
    $ga_id = get_theme_mod( 'colonial_field_ga_analytic_id' );
    
    if ( $ga_id != '' ) :
    ?>

       	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  <?php echo "ga('create', '".$ga_id."', 'auto');"."\n" ?>
		  ga('send', 'pageview');

		</script>
    <?php
    endif;
}
add_action( 'wp_head', 'cobalt_add_js_ga_analytic' );
endif;

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
