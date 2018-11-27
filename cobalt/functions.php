<?php
/**
 * cobalt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cobalt
 */

if ( ! function_exists( 'cobalt_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cobalt_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cobalt, use a find and replace
	 * to change 'cobalt' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cobalt', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'cobalt' ),
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
	add_theme_support( 'custom-background', apply_filters( 'cobalt_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'cobalt_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cobalt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cobalt_content_width', 640 );
}
add_action( 'after_setup_theme', 'cobalt_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cobalt_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'cobalt' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'cobalt' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'cobalt' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cobalt' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'cobalt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cobalt_scripts() {
	wp_enqueue_style( 'bootstrap-css', trailingslashit(get_stylesheet_directory_uri()) . 'libs/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'cobalt-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap-js', trailingslashit(get_template_directory_uri()) . 'libs/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'cobalt-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'cobalt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cobalt_scripts' );

class cobalt_walker_nav_menu extends Walker {
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

add_filter('wp_nav_menu_items','cobalt_alter_primary_nav', 10, 2);
function cobalt_alter_primary_nav( $objects, $args ) {
   // global $wp; add_query_arg( $wp->query_string, '', home_url( $wp->request ) )

    if ( $args->theme_location == 'primary')  {
        $signin =  '<li class="menu-item menu-item-type-custom menu-item-object-custom auth">';
        if ( is_user_logged_in() ) {
            $signin .= '<a href="'. wp_logout_url( "/wp-login.php" ).'">'.
                '<span>LOG OUT</span>'.
            '</a>';
        } else {
            $signin .= '<a href="/wp-login.php">'.
                '<span>SIGN IN</span>'.
            '</a>';
        }
        $signin .= '</li>';
    }
    return $objects.$signin;
}

function cobalt_pagination() {
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_next' => true,
        'prev_text' => __( '&laquo; prev', 'cobalt' ),
        'next_text' => __( 'next &raquo;', 'cobalt' ),
        'type' => 'list',
    ) );
    $paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='cob_pagination'>", $paginate_links );
    $paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
    $paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links );
    $paginate_links = str_replace( '</span>', '</a>', $paginate_links );
    $paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
    $paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
    // Display the pagination if more than one page is found.
    if ( $paginate_links ) {
        echo '<div class="pagination-centered">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}

add_action( 'admin_enqueue_scripts', 'cobalt_admin_enqueue_scripts');

function cobalt_admin_enqueue_scripts() {
    wp_enqueue_script('ncoc-publication', get_template_directory_uri() . '/js/imagevideo-admin.js', array('jquery'));
    wp_enqueue_script('ncoc-custom-script-admin', get_template_directory_uri() . '/js/custom-script-admin.js', array('jquery'));
}

function cobalt_get_file_image_video_path() {
    global $post;
    $file_path = get_post_meta($post->ID, '_cobalt_image_video_file', true);
    if (!$file_path) return false;
    $wp_uploads     = wp_upload_dir();
    $wp_uploads_dir = $wp_uploads['basedir'];
    $wp_uploads_url = $wp_uploads['baseurl'];

    // Replace uploads dir, site url etc with absolute counterparts if we can
    $replacements = array(
        $wp_uploads_url                  => $wp_uploads_dir,
        network_site_url( '/', 'https' ) => ABSPATH,
        network_site_url( '/', 'http' )  => ABSPATH,
        site_url( '/', 'https' )         => ABSPATH,
        site_url( '/', 'http' )          => ABSPATH
    );

    $file_path        = str_replace( array_keys( $replacements ), array_values( $replacements ), $file_path );
    $parsed_file_path = parse_url( $file_path );
    // See if path needs an abspath prepended to work
    if ( file_exists( ABSPATH . $file_path ) ) {
        $file_path   = ABSPATH . $file_path;

    // Check if we have an absolute path
    } elseif ( ( ! isset( $parsed_file_path['scheme'] ) || ! in_array( $parsed_file_path['scheme'], array( 'http', 'https', 'ftp' ) ) ) && isset( $parsed_file_path['path'] ) && file_exists( $parsed_file_path['path'] ) ) {
        $file_path   = $parsed_file_path['path'];
    }
    return $file_path;
}

function FileSizeConvert($bytes){
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
}

/**
 * Implement custom post type.
 */

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


function printHeaderImage() {
  $headerImage = get_header_image();
  if ( '' == $headerImage ) {
   $headerImage = get_template_directory_uri() . '/images/cobalt_logo.jpg';
  }
  echo( $headerImage );
}




