<?php
/**
 * US Army functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package US_Army
 */

if ( ! function_exists( 'us_army_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function us_army_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on US Army, use a find and replace
	 * to change 'us-army' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'us-army', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'us-army' ),
		'menu-2' => esc_html__( 'Footer', 'us-army' ),
		'menu-3' => esc_html__( 'Secondary', 'us-army' ),
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
	add_theme_support( 'custom-background', apply_filters( 'us_army_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'us_army_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function us_army_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'us_army_content_width', 640 );
}
add_action( 'after_setup_theme', 'us_army_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function us_army_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'us-army' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'us-army' ),
    'before_widget' => '<section id="%1$s" class="uswidget widget %2$s">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2><div class="us-army-widget-content">',
  ) );
	register_sidebar( array(
		'name'          => esc_html__( '2 Column Sidebar', 'us-army' ),
		'id'            => 'sidebar-column-page',
		'description'   => esc_html__( 'Add widgets here.', 'us-army' ),
		'before_widget' => '<section id="%1$s" class="uswidget widget col-md-6 %2$s">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="us-army-widget-content">',
	) );
}
add_action( 'widgets_init', 'us_army_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function us_army_scripts() {
	wp_enqueue_style( 'us_army-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'us_army-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'us_army-jquery-ui', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.css' );

	wp_enqueue_style( 'us_army-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'us_army-calendar-blue', get_template_directory_uri() . '/inc/calendar-js/calendar-blue.css' );

	wp_enqueue_style( 'us_army-style', get_stylesheet_uri() );

	wp_enqueue_script( 'us_army-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'us_army-jquery-cycle2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.js', array('jquery'), '2.1.6', true );

	wp_enqueue_script( 'us_army-jquery-cycle2-caption2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.caption2.js', array(), '20130708', true);

	wp_enqueue_script( 'us_army-jquery-ui-js', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'us_army-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'us_army-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'us_army-calendar-custom', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar.js', array(), '1.1' , true);
	wp_enqueue_script( 'us_army-calendar-eng-lang', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-en.js', array(), '1.1', true );
	wp_enqueue_script( 'us_army-calendar-custom-setup', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-setup.js', array(), '1.1' , true);

	wp_enqueue_script( 'us_army-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'us_army_scripts' );

/**
 * Advance Search
 */
require get_template_directory() . '/inc/jetty-advance-search.php';

/**
 * Us Army Menu.
 */
require get_template_directory() . '/inc/us-army-menu.php';

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

require get_template_directory() . '/inc/us-army-custom-customizer.php';


require get_template_directory() . '/inc/custom-function.php';

if( function_exists( 'add_image_size' ) ) {
    add_image_size( 'us_army_thumbnail', 120, 80, true  );
    /*add_image_size( 'plains_image_rotate', 278, 440 );*/
}

// remove category string on category title
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

// Apply Display date on Hot topics
function us_army_display_date_apply() {
    $get_display_date_status = get_theme_mod( 'hot_topics_display_date_setting' );

    if ( $get_display_date_status === 'hide' ) :
    ?>
        <style type="text/css">
            #hotTopics ul.ht-body li div span.date {
                display: none;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'us_army_display_date_apply' );

// Apply Show/Hide Publish date if using Gravity Form
function us_army_display_date_gf_apply() {
    $get_display_date_status_gf = get_theme_mod( 'us_army_hide_date_gf_setting','hide');

    if ( $get_display_date_status_gf === 'hide' ) :
    ?>
        <style type="text/css">
            header.page-header.on_gravity_form div.entry-meta {
                display: none;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'us_army_display_date_gf_apply' );

function set_header_text_color(){
    $link_color = get_header_textcolor();
    $link_color_default = 'fff';

        if ( $link_color !== 'blank' && $link_color !== '000000') :
    ?>
        <style type="text/css">
        .navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3  {
                color: #<?php echo $link_color; ?>;
            }
        </style>
    <?php else: ?>
        <style type="text/css">
        .navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3 {
                color: #<?php echo $link_color_default; ?>;
            }
        </style>
    <?php
    endif; ?>
    <?php

}
add_action('wp_head', 'set_header_text_color');

function set_background_color(){
    $link_color = get_background_color();
    $link_color_default = 'c2c2c2';

        if ( $link_color !== 'blank' && $link_color !== '000000' ) :
    ?>
        <style type="text/css">
        div#page {
                background: #<?php echo $link_color; ?>;
            }
        </style>
    <?php else: ?>
        <style type="text/css">
        div#page {
                background-color: #<?php echo $link_color_default; ?>;
            }
        </style>
    <?php
    endif; ?>
    <?php

}
add_action('wp_head', 'set_background_color');


function custom_customizer_styles() { ?>
	<style>
		#customize-theme-controls ul > li#accordion-section-background_image {
			display: none !important;
		}
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'custom_customizer_styles', 999 );

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
            div#page {
                margin-top: 18px;
            }
        }
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

//* Wrap first word of widget title into a span tag
add_filter ( 'widget_title', 'b3m_add_span_widgets' );
function b3m_add_span_widgets( $old_title ) {

  $len = strlen($old_title);
  if (!$len) {
    $title = 'title here';
  } else {
    $title = $old_title;
  }

  return $title;
}
// conditional to check whether Gravity Forms shortcode is on a page.
function has_gform() {
     global $post;
     $all_content = get_the_content();
     if (strpos($all_content,'[gravityform') !== false) {
	    return true;
     } else {
	    return false;
     }
}