<?php
/**
 * Plains functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Plains
 */

if ( ! function_exists( 'plains_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function plains_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Plains, use a find and replace
	 * to change 'plains' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'plains', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'plains' ),
        'menu-2' => esc_html__( 'Footer nav', 'plains' ),
		'menu-3' => esc_html__( 'Box Link Nav ', 'plains' ),
	) );

	add_filter('wp_nav_menu_items','plains_footer_nav', 10, 2);
	function plains_footer_nav( $items, $args ) {
		$home = '';
        $copyright = '';
		if ($args->theme_location == 'menu-2') {
            if(get_theme_mod('footer_info_setting')):
                $info_setting = get_theme_mod('footer_info_setting');
                $home =  '<li class="no-pipe">'.$info_setting.'</li><br>';
            else :
                $home =  '<li class="no-pipe">'.
            '<strong>Corporate Headquarters:</strong>'.
            '333 Clay Street, Suite 1600, Houston, TX 77002 -'.
            'phone: <a href="tel:+7136464100">713-646-4100</a>'.
            '</li>'.
            '<br>';
            endif;
			if(get_theme_mod('footer_info_copyright_setting')):
                $info_setting_copy = get_theme_mod('footer_info_copyright_setting');
                $copyright = '<li>'.$info_setting_copy.'</li>';
            else :
                $copyright = '<li>© Copyright 2017 Plains All American Pipeline, L.P.</li>';
            endif;
		}

		return $home.$copyright.$items;
	}
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
	add_theme_support( 'custom-background', apply_filters( 'plains_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'plains_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function plains_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'plains_content_width', 640 );
}
add_action( 'after_setup_theme', 'plains_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function plains_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'plains' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'plains' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar(array(
        'name' => __('Inside Page', 'plains'),
        'id' => 'inside_page', 'description' => __('Widget area on top of the page', 'plains'),
        'before_widget' => '<div id="%1$s" class="ip-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>'
    ));
}
add_action( 'widgets_init', 'plains_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function plains_scripts() {
	wp_enqueue_style( 'plains-google-webfonts', 'https://fonts.googleapis.com/css?family=Raleway:400,700|Open+Sans:400,300,700,400italic,300italic,700italic' );

	wp_enqueue_style( 'plains-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'plains-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'plains-jquery-ui', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.css' );

	wp_enqueue_style( 'plains-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

    wp_enqueue_style( 'plains-calendar-blue', get_template_directory_uri() . '/inc/calendar-js/calendar-blue.css' );

	wp_enqueue_style( 'plains-style', get_stylesheet_uri() );

	wp_enqueue_script( 'plains-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

    wp_enqueue_script( 'plains-jquery-cycle2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.js', array('jquery'), '2.1.6', true );

    wp_enqueue_script( 'plains-jquery-cycle2-caption2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.caption2.js', array(), '20130708', true);

	wp_enqueue_script( 'plains-jquery-ui-js', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.js', array(), '1.1.0', true );

	wp_enqueue_script( 'plains-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'plains-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'plains-calendar-custom', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar.js', array(), '1.1' , true);
    wp_enqueue_script( 'plains-calendar-eng-lang', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-en.js', array(), '1.1', true );
    wp_enqueue_script( 'plains-calendar-custom-setup', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-setup.js', array(), '1.1' , true);

    wp_enqueue_script( 'plains-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'plains_scripts' );


function plains_load_scripts_admin() {
    global $pagenow;

   wp_enqueue_script( 'plains-rotator', get_template_directory_uri() . '/js/metabox-rotator.js', array('jquery'), '1.1.1', true );
   wp_enqueue_style('plains-admin-styles', get_template_directory_uri().'/inc/admin-css/custom-admin-style.css');

   // rotator
   // register first, so other code can enqueue it by name if needed
   $url = get_template_directory_uri() . '/inc/jetty-irotator-widget/';
    // register first, so other code can enqueue it by name if needed
    wp_register_script('jirw-admin-uploader', $url . 'assets/js/jetty-irotator-widget.js', array('jquery'));
    wp_register_style('jirw-admin-uploader', $url . 'assets/css/jetty-irotator-widget.css');
    wp_localize_script('jirw-admin-uploader', 'jirw_admin_uploader_i18n', array(
        'title' => __('Upload or Select an Image', 'jirw'),
        'text'  => __('Select', 'jirw'),
        'btn_text' => __('+', 'jirw'),
        'remove_text' => __('x', 'jirw'),
        'label_url' => __( 'Link URL', 'jirw' )
    ));
    // only loads our scripts on widgets page and customizer
    if (in_array($pagenow,  array('widgets.php', 'customize.php'))) {
        wp_enqueue_media();
        wp_enqueue_script('jirw-admin-uploader');
        wp_enqueue_style('jirw-admin-uploader');
    }

}
add_action('admin_enqueue_scripts', 'plains_load_scripts_admin');

function plains_breadcrumbs($addTexts = true) {
    $home = 'Home';
    $before = '<li class="active">';
    $sep = '';
    $after = '</li>';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<ol class="breadcrumb hidden-sm hidden-xs" id="plains_breadcrumbs">';
        global $post;
        $homeLink = home_url();
        echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $sep . '</li> ';
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo '<li>'.get_category_parents($parentCat, true, "{$sep}</li><li>").'</li>';
            }
            $format = $before . ($addTexts ? (__('Archive by category ', 'plains') . '"%s"') : '%s') . $after;
            echo sprintf($format, single_cat_title('', false));

        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
            ) . '</a></li> ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                    'F'
            ) . '</a></li> ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
            ) . '</a></li> ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo '<li>' . get_category_parents($cat, true, $sep) . '</li>';
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search()) {
            $post_type = get_post_type_object(get_post_type());
            if(!empty($post_type)) :
            echo $before . $post_type->labels->singular_name . $after;
            endif;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo '<li>'.get_category_parents($cat, true, $sep).'</li> ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title(
                                $page->ID
                        ) . '</a>' . $sep . '</li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . 'Search'. $after;
        } elseif (is_tag()) {
            $format = $before . ($addTexts ? (__('Posts tagged "', 'plains') . '"%s"') : '%s') . $after;
            echo sprintf($format, single_tag_title('', false));
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            $format = $before . ($addTexts ? (__('Articles posted by ', 'plains') . '"%s"') : '%s') . $after;
            echo sprintf($format, $userdata->display_name);
        } elseif (is_404()) {
            echo $before . __('Error 404', 'plains') . $after;
        }
        echo '</ol>';
    }
}

/**
 * navigation.
 */
require get_template_directory() . '/inc/plains-menu.php';

/**
 * Page Image Rotator.
 */
require get_template_directory() . '/inc/jetty-irotator-widget/jetty-irotator-widget.php';

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

/**
 * Implement the Custom Customizer.
 */
require get_template_directory() . '/inc/plains-custom-customizer.php';

/**
 * Implement the Custom Function.
 */
require get_template_directory() . '/inc/custom-function.php';

/**
 * Implement the Jetty Advance Search.
 */
require get_template_directory() . '/inc/jetty-advance-search.php';


// margin if admin bar showing
function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
           #plaints-header {
                margin-top: 18px;
            }
        }
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

if( function_exists( 'add_image_size' ) ) {
    add_image_size( 'plains_image_rotate', 278, 440, true  );
}
