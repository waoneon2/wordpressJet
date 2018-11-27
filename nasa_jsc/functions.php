<?php
/**
 * Nasa_JSC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nasa_JSC
 */

if ( ! function_exists( 'nasa_jsc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nasa_jsc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Nasa_JSC, use a find and replace
	 * to change 'nasa_jsc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'nasa_jsc', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'nasa_jsc' ),
        'menu-2' => esc_html__( 'Footer Nav', 'nasa_jsc' ),
        'menu-3' => esc_html__( 'Additional Information', 'nasa_jsc' ),
		'menu-4' => esc_html__( 'Related Links', 'nasa_jsc' ),
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
	add_theme_support( 'custom-background', apply_filters( 'nasa_jsc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    add_image_size( 'slider-image-size', 370, 277.5 );
}
endif;
add_action( 'after_setup_theme', 'nasa_jsc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nasa_jsc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nasa_jsc_content_width', 640 );
}
add_action( 'after_setup_theme', 'nasa_jsc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nasa_jsc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nasa_jsc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'nasa_jsc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Home Left Sidebar', 'nasa_jsc' ),
		'id'            => 'home_left_1',
		'description'   => esc_html__( 'Add widgets here.', 'nasa_jsc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'nasa_jsc_widgets_init' );

function nasa_jsc_custom_register_widgets() {
    register_widget('jetty_widget_twitter_feed');
}
add_action('widgets_init', 'nasa_jsc_custom_register_widgets');
/**
 * Enqueue scripts and styles.
 */
function nasa_jsc_scripts() {

    wp_enqueue_style( 'nasa_jsc-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'nasa_jsc-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'nasa_jsc-jquery-ui', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.css' );

	wp_enqueue_style( 'nasa_jsc-font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css' );

    wp_enqueue_style( 'nasa_jsc-calendar-blue', get_template_directory_uri() . '/inc/calendar-js/calendar-blue.css' );

	wp_enqueue_style( 'nasa_jsc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'nasa_jsc-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

    wp_enqueue_script( 'nasa_jsc-jquery-cycle2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.js', array('jquery'), '2.1.6', true );

    wp_enqueue_script( 'nasa_jsc-jquery-cycle2-caption2', get_template_directory_uri() . '/inc/jquery-cycle2/jquery.cycle2.caption2.js', array(), '20130708', true);

	wp_enqueue_script( 'nasa_jsc-jquery-ui-js', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'nasa_jsc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'nasa_jsc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'nasa_jsc-calendar-custom', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar.js', array(), '1.1' , true);
    wp_enqueue_script( 'nasa_jsc-calendar-eng-lang', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-en.js', array(), '1.1', true );
    wp_enqueue_script( 'nasa_jsc-calendar-custom-setup', get_stylesheet_directory_uri(). '/inc/calendar-js/calendar-setup.js', array(), '1.1' , true);

    wp_enqueue_script( 'nasa_jsc-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nasa_jsc_scripts' );

// add class to body
add_filter('body_class', 'nasa_jsc_body_class');
function nasa_jsc_body_class($classes) {
        $classes[] = 'externalSite';
        return $classes;
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

// breadcrumb
function nasa_jsc_breadcrumbs($addTexts = true) {
    $home = 'Home';
    $before = '<li class="active">';
    $sep = '';
    $after = '</li>';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<ol class="breadcrumb" id="nasa_jsc_breadcrumbs">';
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
                echo '<li>' . get_category_parents($cat, true, "{$sep}</li><li>");
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
            echo get_category_parents($cat, true, $sep);
            echo '<li><a href="' . get_permalink(
                    $parent
            ) . '">' . $parent->post_title . '</a></li> ';
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
            echo $before . 'Search' . $after;
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

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
            div#masthead {
                margin-top: 18px;
            }
        }
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

/**
 *   Custom Navigation.
 */
require get_template_directory() . '/inc/nasa-jsc-menu.php';

/**
 * Jetty advence search.
 */
require get_template_directory() . '/inc/jetty-advance-search.php';

/**
 * Jetty Twitter Feed.
 */
require get_template_directory() . '/inc/jetty-widget-twitter-feed.php';

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
require get_template_directory() . '/inc/nasa_jsc-custom-customizer.php';

/**
 * Generate Homepage Slider.
 */
require get_template_directory() . '/inc/homepage-image-slider.php';


// customizer latest news
add_action( 'customize_register', 'nasa_jsc_customize' );
function nasa_jsc_customize($wp_customize) {

    class WP_Customize_dropdown_category extends WP_Customize_Control {
        public function render_content() {
            $drop_category = wp_dropdown_categories(
                    array(
                        'show_option_all'    => '',
                        'show_option_none'   => '',
                        'option_none_value'  => '0',
                        'echo' => '0',
                        'selected' => $this->value(),
                        'name' => '_custom-drop-category' . $this->id
                        )
                );
            $drop_category = str_replace( '<select', '<select ' . $this->get_link(), $drop_category );

            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $drop_category
            );
        }
    }

    $wp_customize->add_section('nasa_jsc_new_release_opt',array(
        'title' => __('Category Settings','nasa_jsc'),
        'priority' => 95
    ));

    $wp_customize->add_setting( 'nasa_jsc_new_release_category');
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
            $wp_customize,
            'nasa_jsc_new_release_category',
            array(
                'label' => 'Set first category',
                // 'description'   => __('Select category to display','nasa_jsc'),
                'section' => 'nasa_jsc_new_release_opt',
                'setting' => 'nasa_jsc_new_release_category'
            )
        )
    );
}

function set_header_text_color(){
    $link_color = get_header_textcolor(); 
    $link_color_default = 'ECF2FA';

        if ( $link_color != 'blank' ) :
    ?>
        <style type="text/css">
        .header-section h1, .navbar-title a {
                color: #<?php echo $link_color; ?>;
            }   
        </style>
    <?php else: ?>
        <style type="text/css">
        .header-section h1, .navbar-title a {
                color: #<?php echo $link_color_default; ?>;
            }   
        </style>
    <?php
    endif; ?>
    <?php

}
add_action('wp_head', 'set_header_text_color');