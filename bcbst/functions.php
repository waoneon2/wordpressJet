<?php
/**
 * BlueCross BlueShield of Tennessee functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

if ( ! function_exists( 'bcbst_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bcbst_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BlueCross BlueShield of Tennessee, use a find and replace
	 * to change 'bcbst' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bcbst', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'bcbst' ),
		'menu-2' => esc_html__( 'Footer Nav', 'bcbst' ),
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
	add_theme_support( 'custom-background', apply_filters( 'bcbst_custom_background_args', array(
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
add_action( 'after_setup_theme', 'bcbst_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bcbst_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bcbst_content_width', 640 );
}
add_action( 'after_setup_theme', 'bcbst_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bcbst_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bcbst' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bcbst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget area Left', 'bcbst' ),
		'id'            => 'widget-area-left',
		'description'   => esc_html__( 'Add widgets here.', 'bcbst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget area middle', 'bcbst' ),
		'id'            => 'widget-area-middle',
		'description'   => esc_html__( 'Add widgets here.', 'bcbst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget area right', 'bcbst' ),
		'id'            => 'widget-area-right',
		'description'   => esc_html__( 'Add widgets here.', 'bcbst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_widget('BCBST_Widget_Resources');
}
add_action( 'widgets_init', 'bcbst_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bcbst_scripts() {
	wp_enqueue_style( 'bcbst-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'bcbst-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'bcbst-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'bcbst-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bcbst-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'bcbst-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'bcbst-script', get_template_directory_uri() . '/js/bcbst-script.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bcbst_scripts' );

function bcbst_admin_scripts() {
    global $pagenow;
    // VERTICAL TABS
    wp_register_script('bcbst-resources', get_template_directory_uri() . '/js/bcbst-widget-resources.js', array('jquery'));
    wp_register_style('bcbst-admin', get_template_directory_uri() . '/css/admin.css');
    wp_localize_script('bcbst-resources', 'admin_resources', array(
        'remove_text' => __('Remove', 'bcbst'),
        'label_text' => __( 'Resource Text', 'bcbst' ),
        'label_url' => __( 'Resource URL', 'bcbst' ),
        'label_desc' => __( 'Description', 'bcbst' ),
    ));


    // only loads our scripts on widgets page and customizer
    if (in_array($pagenow,  array('widgets.php', 'customize.php'))) {
        wp_enqueue_media();
        wp_enqueue_script('bcbst-resources');
        wp_enqueue_style('bcbst-admin');
    }
}

add_action('admin_enqueue_scripts', 'bcbst_admin_scripts');

function printHeaderImage() {
    $headerImage = get_header_image();
    if ( '' == $headerImage ) {
      $headerImage = get_template_directory_uri() . '/img/bcbst_logo.png';
    }
    echo( $headerImage );
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
require get_template_directory() . '/inc/bcbst-custom-customizer.php';

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

/***** Add Custom Image Sizes *****/

require get_template_directory() . '/inc/widget/bcbst-widget-resources.php';

function bcbst_image_sizes() {
	add_image_size('sticky-post', 500, 335, true);
}
add_action('after_setup_theme', 'bcbst_image_sizes');

function bcbst_custom_excerpts($limit = 35) {
    echo '<p>'.wp_trim_words(get_the_excerpt(), $limit, '').'</p>';
}

class bcbst_walker_nav_menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul class=\"sub-menu dropdown-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
		if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;

        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}

// *** Front End Function *** //
function bcbst_homepage_button_link($url, $label, $default) {
	$label = trim($label);
	if (!$label) $label = $default;

	$label_ex 		= explode(' ', $label);
	$label_ex[0] 	= '<span>'.$label_ex[0].'</span>';
	$label 			= implode(' ', $label_ex); 

	//$url = esc_url($url);
	$urls = trim($url);
	if ($urls) {
		$urls = esc_url($urls);
	} else {
		$urls = '#';
	}
	
	
	echo $url ? '<a href="'.$url.'">'.$label.'</a>' : $label;
}