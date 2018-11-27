<?php
/**
 * andeavor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package andeavor
 */

if ( ! function_exists( 'andeavor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function andeavor_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on andeavor, use a find and replace
		 * to change 'andeavor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'andeavor', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'andeavor' ),
			'menu-2' => esc_html__( 'Footer', 'andeavor' ),
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
		add_theme_support( 'custom-background', apply_filters( 'andeavor_custom_background_args', array(
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
add_action( 'after_setup_theme', 'andeavor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function andeavor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'andeavor_content_width', 640 );
}
add_action( 'after_setup_theme', 'andeavor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function andeavor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'andeavor' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'andeavor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'andeavor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function andeavor_scripts() {
	wp_enqueue_style( 'andeavor-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'andeavor-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'andeavor-style', get_stylesheet_uri() );

	wp_enqueue_script( 'andeavor-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'andeavor-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'andeavor-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'andeavor-matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', array('jquery'), '0.7.2', true );

	wp_enqueue_script( 'andeavor-script', get_template_directory_uri() . '/js/andeavor-script.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'andeavor_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 * Load all custom widget.
 */
require get_template_directory() . '/inc/custom-widget-loader.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load custom customizer.
 */
require get_template_directory() . '/inc/andeavor-custom-customizer.php';


function andeavor_pagination( $echo = true ) {
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

function andeavor_user() {
	global $current_user;
	echo ucfirst($current_user->display_name);
}

function printHeaderImage() {
  $headerImage = get_header_image();
  if ( '' == $headerImage ) {
    $headerImage = __DIR__ . '/images/logo.svg';
    echo '<a href="'.esc_url( home_url( '/' ) ).'" class="svg">'.file_get_contents($headerImage).'</a>';
    // echo file_get_contents($headerImage);
  } else {
  	echo '<a class="hallmark" href="'.esc_url( home_url( '/' ) ).'" title="andeavor">
		<img alt="andeavor" src="'.$headerImage.'">
	</a>';
  }

}

// Image support
add_image_size( 'category-thumb', 1120, 9999 );

// Gravity Form
add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
    return "<div class='validation_error'>Marked *</div>";
}

// Navigation
class andeavor_walker_nav_menu extends Walker {
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
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;

        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}

function andeavor_get_file_sheet_path($url) {
    global $post;
    $file_path = $url;
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

function andeavor_filesize($bytes, $decimals = 2) {
	$sz = [' Byte',' KB',' MB',' GB',' TB',' PB'];
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function andeavor_sizeinfo($url) {
	$filesize = filesize(andeavor_get_file_sheet_path($url));
	echo andeavor_filesize($filesize);
}

