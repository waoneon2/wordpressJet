<?php
/**
 * LADWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LADWP
 */

if ( ! function_exists( 'ladwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ladwp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on LADWP, use a find and replace
	 * to change 'ladwp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ladwp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    // Adding post format on this theme.

    add_theme_support( 'post-formats', array( 'image', 'video' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'menu-1' => esc_html__( 'Primary', 'ladwp' ),
        'footer-1' => esc_html__( 'DWP sites', 'ladwp' ),
        'footer-2' => esc_html__( 'Social Media', 'ladwp' ),
		'footer-3' => esc_html__( 'Privacy Notice', 'ladwp' )
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
	add_theme_support( 'custom-background', apply_filters( 'ladwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'ladwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ladwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ladwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'ladwp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ladwp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ladwp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ladwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    // for category page
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Category', 'ladwp' ),
        'id'            => 'sidebar-cat',
        'description'   => esc_html__( 'This sidebar displayed on category page.', 'ladwp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ladwp_widgets_init' );

function ladwp_get_font_url() {
    $fonts_url = '';

    $openSans = _x( 'on', 'Open Sans font: on or off', 'ladwp' );

    if ( 'off' !== $openSans) {
        $font_families = array();

        if ( 'off' !== $openSans )
            $font_families[] = 'Open Sans:300,400,700,300italic,400italic,700italic';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,vietnamese,latin-ext,cyrillic-ext,cyrillic' ),
        );
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function ladwp_scripts() {
    wp_enqueue_style( 'ladwp-fonts' , ladwp_get_font_url(), array(), null );
	wp_enqueue_style( 'ladwp-fontawesome-style', get_template_directory_uri() . '/libs/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style( 'ladwp-bootstrap-style', get_template_directory_uri() . '/libs/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'ladwp-bxslider-style', get_template_directory_uri() . '/libs/bxslider/jquery.bxslider.min.css');
	wp_enqueue_style( 'ladwp-style', get_stylesheet_uri() );


	wp_enqueue_script( 'ladwp-bootstrap-js', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), '20170217', true );
    wp_enqueue_script( 'ladwp-bxslider-js', get_template_directory_uri() . '/libs/bxslider/jquery.bxslider.min.js', array('jquery'), '20170223', true );
	wp_enqueue_script( 'ladwp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'ladwp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'ladwp-custom-js', get_template_directory_uri() . '/js/custom_script.js', array(), '20170217', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ladwp_scripts' );

function ladwp_set_color_border_widget(){
    $get_color_customizer = get_theme_mod('ladwp_border_widget_color');
    if($get_color_customizer != '#0000ff'):
    ?>
<style type="text/css">
    div.news-tile .tile-content {
        border-color: <?php echo $get_color_customizer ?>
    }
    .widget-area section > div,
    .widget-area section > ul,
    .widget-area section > form,
    .widget-area .ladwp-search-form-container {
        border-color: <?php echo $get_color_customizer ?>
    }
</style>
<?php
    endif;
}
add_action('wp_head','ladwp_set_color_border_widget');

function ladwp_set_background_color_widget(){
    $get_background_color = get_theme_mod('ladwp_background_color_widget');
    if($get_background_color != '#f2f2f2') :
?>
    <style type="text/css">
        .widget-area section.widget .ladwp-search-form-container,
        .widget-area section.widget_search .search-form,
        .widget-area section.widget div.tagcloud,
        .widget-area section.widget ul,
        .widget-area section.widget div#calendar_wrap,
        .widget select,
        .widget-area section > div {
            background-color : <?php echo $get_background_color ?> ;
        }
    </style>
<?php
endif;
}
add_action('wp_head', 'ladwp_set_background_color_widget');

function ladwp_set_ln_background_color_widget(){
    $get_ln_background_color = get_theme_mod('ladwp_ln_background_color_widget');
    if($get_ln_background_color != '#f2f2f2') :
?>
    <style type="text/css">
        div.news-tile .tile-content {
            background-color : <?php echo $get_ln_background_color ?> ;
        }
    </style>
<?php
endif;
}
add_action('wp_head', 'ladwp_set_ln_background_color_widget');
//LADWP Breadcrumbs
function ladwp_breadcrumbs($addTexts = true) {
    $home = 'Home';
    $before = '<li class="active">';
    $sep = '';
    $after = '</li>';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<ul class="breadcrumb hidden-xs clearfix" id="ladwp_breadcrumbs">';
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
            $format = $before . ($addTexts ? (__('Archive by category ', 'ladwp') . '"%s"') : '%s') . $after;
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
            $format = $before . ($addTexts ? (__('Search results for "', 'ladwp') . '"%s"') : '%s') . $after;
            echo sprintf($format, get_search_query());
        } elseif (is_tag()) {
            $format = $before . ($addTexts ? (__('Posts tagged "', 'ladwp') . '"%s"') : '%s') . $after;
            echo sprintf($format, single_tag_title('', false));
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            $format = $before . ($addTexts ? (__('Articles posted by ', 'ladwp') . '"%s"') : '%s') . $after;
            echo sprintf($format, $userdata->display_name);
        } elseif (is_404()) {
            echo $before . __('Error 404', 'ladwp') . $after;
        }
        echo '</ul>';
    }
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function ladwp_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'ladwp_custom_excerpt_length', 999 );

// Limit for the excerpt.
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
            div#ladwp_container_header {
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
 * Megamenu
 */
require get_template_directory() . '/inc/ladwp_menu.php';

/**
 * Custom widget
 */
require get_template_directory() . '/inc/class-ladwp-widget-search.php';
require get_template_directory() . '/inc/class-ladwp-widget-twitter-feed.php';

function ladwp_register_widgets() {
    register_widget('LADWP_Widget_Search');
    register_widget('LADWP_Widget_Twitter_Feed');
}

add_action('widgets_init', 'ladwp_register_widgets');