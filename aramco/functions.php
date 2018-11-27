<?php
/**
 * aramco functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aramco
 */

if ( ! function_exists( 'aramco_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aramco_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on aramco, use a find and replace
	 * to change 'aramco' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aramco', get_template_directory() . '/languages' );

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
		'primary-nav' => esc_html__( 'Primary Navigation', 'aramco' ),
		'top-nav' => esc_html__( 'Top Navigation', 'aramco' ),
		'footer-nav' => esc_html__( 'Footer Navigation', 'aramco' ),
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
	add_theme_support( 'custom-background', apply_filters( 'aramco_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'aramco_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aramco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aramco_content_width', 640 );
}
add_action( 'after_setup_theme', 'aramco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aramco_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aramco' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'aramco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
        'name' => __( 'Footer #1', 'aramco' ),
        'id' => 'footer1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer #2', 'aramco' ),
        'id' => 'footer2',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer #3', 'aramco' ),
        'id' => 'footer3',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array(
        'name' => __( 'News Widget Area', 'aramco' ),
        'id' => 'sidebar-1-column',
        'description' => __( 'For Template Sticky Post And 1 column widget', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s card-wrapper">',
        'after_widget' => '</div></aside>',
        'before_title' => '<div class="widget-title-container "><h3 class="widget-title card whiteTheme">',
        'after_title' => '</h3></div><div class="widget-content card whiteTheme">',
    ) );
    register_sidebar( array(
        'name' => __( 'Resources Widget Area', 'aramco' ),
        'id' => 'sidebar-2-column',
        'description' => __( 'For Template Sticky Post And 2 column widget', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s card-wrapper">',
        'after_widget' => '</div></aside>',
        'before_title' => '<div class="widget-title-container "><h3 class="widget-title card whiteTheme">',
        'after_title' => '</h3></div><div class="widget-content card whiteTheme">',
    ) );
    register_sidebar( array(
        'name' => __( 'Contact Widget Area', 'aramco' ),
        'id' => 'sidebar-3-column',
        'description' => __( 'For Template Sticky Post And 3 column widget', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s card-wrapper">',
        'after_widget' => '</div></aside>',
        'before_title' => '<div class="widget-title-container "><h3 class="widget-title card whiteTheme">',
        'after_title' => '</h3></div><div class="widget-content card whiteTheme">',
    ) );

    register_widget('Aramco_Widget_Category');
    register_widget('Aramco_Widget_Resources');
}
add_action( 'widgets_init', 'aramco_widgets_init' );


/**
 * Altering Navigation
 *
 */
add_filter('wp_nav_menu_items','alter_primary_nav', 10, 2);
function alter_primary_nav( $items, $args ) {
   // global $wp; add_query_arg( $wp->query_string, '', home_url( $wp->request ) )
	$home = '';
    if ($args->menu_id == 'primary-nav-mobile') {
        $home =  '<li class="home js-home">' .
            '<a href="'.esc_url(home_url( '/' )).'">Home</a>'.
        '</li>'.
        '<li class="back js-back">Back</li>';
    } elseif ( $args->theme_location == 'primary-nav')  {

        $home =  '<li class="menu-item menu-item-type-custom menu-item-object-custom home li-depth-0">' .
        '<a href="'.esc_url(home_url( '/' )).'">'.
        '<span aria-hidden="true" data-icon="&#xe60a;"></span><span class="screen-reader-txt">Home</span>'.
        '</a>'.
        '</li>';
    }
    return $home.$items;
}

//add_filter('wp_nav_menu_items','alter_top_nav', 10, 2);
function alter_top_nav( $items, $args ) {
    if( $args->theme_location == 'top-nav')  {

        $items .=  '<li class="menu-item menu-item-type-custom menu-item-object-custom socialmedia">'.
        '<div class="socialMediaIcons">
            <div class="socialMediaIconsList">
                <div class="twitter">
                    <a href="https://twitter.com/Saudi_Aramco" target="_blank"><span aria-hidden="true" data-icon="&#58883;"></span><span class="screen-reader-txt">Twitter</span></a>
                </div>
                <div class="linkedin">
                    <a href="http://www.linkedin.com/company/saudi-aramco" target="_blank"><span aria-hidden="true" data-icon="&#58897;"></span><span class="screen-reader-txt">Linked In</span></a>
                </div>
                <div class="youtube">
                    <a href="http://www.youtube.com/user/AramcoVideo" target="_blank"><span aria-hidden="true" data-icon="&#58896;"></span><span class="screen-reader-txt">Youtube</span></a>
                </div>
                <div class="instagram">
                <a href="https://instagram.com/saudi_aramco/" target="_blank"><span aria-hidden="true" class="icon2" data-icon="&#xe600;"></span><span class="screen-reader-txt">Instagram</span></a>
                </div>
            </div>
        </div>'.
        '</div>';
    }
    return $items;
    /*<div class="instagram">
                    <a href="https://instagram.com/saudi_aramco/" target="_blank"><span aria-hidden="true" class="icon2" data-icon="&#xe600;"></span><span class="screen-reader-txt">Instagram</span></a>
                </div>*/
}

/**
 * Enqueue scripts and styles.
 */
function aramco_scripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );

	// wp_enqueue_style( 'grid-style', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.css' );

    wp_enqueue_style( 'aramco-style', get_stylesheet_uri() );

	wp_enqueue_script( 'aramco-salvattore', get_template_directory_uri() . '/js/salvattore.js', array('jquery'), '20160919', true );

	wp_enqueue_script( 'aramco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'aramco-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aramco_scripts' );

function aramco_admin_scripts() {
    global $pagenow;
    // VERTICAL TABS
    wp_register_script('aramco-resources', get_template_directory_uri() . '/js/aramco-widget-resources.js', array('jquery'));
    wp_register_style('aramco-admin', get_template_directory_uri() . '/css/admin.css');
    wp_localize_script('aramco-resources', 'admin_resources', array(
        'remove_text' => __('Remove', 'aramco'),
        'label_text' => __( 'Resource Text', 'aramco' ),
        'label_url' => __( 'Resource URL', 'aramco' ),
    ));


    // only loads our scripts on widgets page and customizer
    if (in_array($pagenow,  array('widgets.php', 'customize.php'))) {
        wp_enqueue_media();
        wp_enqueue_script('aramco-resources');
        wp_enqueue_style('aramco-admin');
    }
}

add_action('admin_enqueue_scripts', 'aramco_admin_scripts');

/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}



// Add breadcumb
// Breadcrumbs
function custom_breadcrumbs() {

    // Settings
    $separator          = '';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '"><span class="breadcrums_homepage">' . $home_title . '</span></a></li>';
        echo '<li class="separator separator-home"> ' . $separator . '</li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            $post_type = get_post_type();
            if ($post_type === 'sheet') {
                echo '<li class="item-current item-archive"><span class="bread-current bread-archive">Fact Sheets</span></li>';
            } else {
                echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title('', false) . '</span></li>';
            }


        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                $post_type_name = $post_type_object->labels->name == 'Sheets' ? 'Fact Sheets' : $post_type_object->labels->name;
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_name  . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                $post_type_name = $post_type_object->labels->name == 'Sheets' ? 'Fact Sheets' : $post_type_object->labels->name;
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $array_val = array_values($category);
                $last_category = end($array_val);

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';

    }

}

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

require_once get_template_directory() . '/inc/aramco_customizer.php';

/**
 * Add custom widget
 */

require_once get_template_directory() . '/widget/most-searched-widget.php';

require_once get_template_directory() . '/widget/popular-pages.php';

require_once get_template_directory() . '/widget/follow-us-widget.php';

require_once get_template_directory() . '/widget/aramco-widget-category.php';

require_once get_template_directory() . '/widget/aramco-widget-resources.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/aramco_menu.php';

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
require get_template_directory() . '/inc/aramco_cpt.php';
require get_template_directory() . '/inc/aramco_widget.php';
//require get_template_directory() . '/inc/search-meter/search-meter.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Modify the read more link on the_excerpt() */

function aramco_excerpt_length($length) {
    return 10;
}
add_filter('excerpt_length', 'aramco_excerpt_length');

/* Add a link  to the end of our excerpt contained in a div for styling purposes and to break to a new line on the page.*/

function aramco_excerpt_more($more) {
    global $post;
    return '<div class="view-full-post"><a href="'. get_permalink($post->ID) . '" class="view-full-post-btn"><span>Read more</span></a></div>';
}
add_filter('excerpt_more', 'aramco_excerpt_more');

function cut_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ...';
    } else {
    $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function get_sticky_post(){
    $sticky_post  = get_option('sticky_posts');
    $excerpt_sticky_post = "";
    $featured_img = "";
    $get_title = "";
    $permalink = "";
    $html = "";
    $bool_fe = false;
    $bool_sticky = false;
    if (!empty($sticky_post)) {
        $bool_sticky = true;
        rsort($sticky_post);
        $sticky_post = array_slice( $sticky_post, 0, 1 );
        $the_query = new WP_Query( array( 'post__in' => $sticky_post, 'ignore_sticky_posts' => 1 ) );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                if(has_post_thumbnail()){
                    $featured_img = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $bool_fe = true;
                }
                $permalink = '<div class="view-full-post" id="on_sticky"><a href="'. get_permalink(get_the_ID()) . '" class="view-full-post-btn"><span>Read more</span></a></div>';
                $get_title = get_the_title();
                $excerpt_sticky_post = cut_content(85);
            }
        }
    }
    if($bool_sticky):
    $html .= '<div class="parsys hero container" id="sticky_post">';
    $html .= '<div class="hero section row">';
    $html .= '<div class="heroBanner col-md-12">';
	if($bool_fe) :
	$html .= '<div class="col-md-6" id="content_excerpt">';
	$html .= __('<h2 class="sticky_title">'.$get_title.'</h2>', 'aramco');
	$html .= __($excerpt_sticky_post,'aramco');
	$html .= __($permalink,'aramco');
	$html .= '</div>';
	$html .= '<div class="col-md-6" id="content_featured_img">';
	$html .= __('<img src='.$featured_img.' class="img-responsive img-thumbnail"/>','aramco');
	$html .= '</div>';
	else:
	$html .= '<div class="col-md-12" id="content_excerpt">';
	$html .= __('<h2 class="sticky_title">'.$get_title.'</h2>', 'aramco');
	$html .= __($excerpt_sticky_post,'aramco');
	$html .= __($permalink,'aramco');
	$html .= '</div>';
	endif;
    $html .= '</div></div></div>';

    return $html;
    endif;
}


if( function_exists( 'add_image_size' ) ) {
    add_image_size( 'ar_220x124', 220, 124 );
}

add_action( 'init', 'aramco_divider' );

function aramco_divider() {
    register_taxonomy(
        'divider',
        'post',
        array(
            'label' => __( 'Divider' ),
            'rewrite' => array( 'slug' => 'divider' ),
            'hierarchical' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_ui' => false,
        )
    );
    wp_insert_term( 'Divider 1/4', 'divider', $args = array('slug'=>'1of4') );
}

// Add Category to attachment
function aramco_add_categories_to_attachments() {
      register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'aramco_add_categories_to_attachments' );


function aramco_sm_array_value(&$array, $key) {
    return (is_array($array) && array_key_exists($key, $array)) ? $array[$key] : null;
}
function aramco_list_popular_searches($before = '', $after = '', $count = 5) {

    global $wpdb, $wp_rewrite;
    $count = intval($count);
    $escaped_filter_regex = aramco_get_escaped_filter_regex();
    $filter_term = ($escaped_filter_regex == "" ? "" : "AND NOT `terms` REGEXP '{$escaped_filter_regex}'");

    $results = $wpdb->get_results(
        "SELECT `terms`, SUM(`count`) AS countsum, max(`count`) AS countmax
        FROM `{$wpdb->prefix}searchmeter`
        WHERE DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) <= `date`
        AND terms <> ''
        AND 0 < `last_hits`
        {$filter_term}
        GROUP BY `terms`
        ORDER BY countsum DESC, `terms` ASC
        LIMIT $count");

    $countmax = $wpdb->get_results(
        "SELECT max(`count`) AS countmax
        FROM `{$wpdb->prefix}searchmeter`
        WHERE DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) <= `date`
        AND 0 < `last_hits`
        {$filter_term}
        LIMIT $count");

    if (count($results)) {
        echo "$before\n<ul>\n";
        $home_url_slash = get_option('home') . '/';

        $size = '';
        /*$small = $countmax[0]->countmax * 0.3;
        $medium = $countmax[0]->countmax * 0.6;*/
        foreach ($results as $result) {
            /*if ($result->countsum <= $small) {
                $size = 'textHighlightSmall';
            } else if ($result->countsum <= $medium) {
                $size = 'textHighlightMedium';
            } else {
                $size = 'textHighlightLarge';
            }*/
            echo '<li class="'.$size.'"><a href="'. $home_url_slash . aramco_get_relative_search_url($result->terms) . '">'. htmlspecialchars($result->terms) .'</a></li>'."\n";
        }
        echo "</ul>\n$after\n";
    }
}

function aramco_constrain_widget_search_count($number) {
    return max(1, min((int)$number, 100));
}

function aramco_get_escaped_filter_regex() {
// Return a regular expression, escaped to go into a DB query, that will match any terms to be filtered out
    global $sm_escaped_filter_regex, $wpdb;
    if ( ! isset($sm_escaped_filter_regex)) {
        $options = get_option('tguy_search_meter');
        $filter_words = aramco_sm_array_value($options, 'sm_filter_words');
        if ($filter_words == '') {
            $sm_escaped_filter_regex = '';
        } else {
            $filter_regex = str_replace(' ', '|', preg_quote($filter_words));
            $wpdb->escape_by_ref($filter_regex);
            $sm_escaped_filter_regex = $filter_regex;
        }
    }
    return $sm_escaped_filter_regex;
}
$sm_escaped_filter_regex = null;

function aramco_get_relative_search_url($term) {
// Return the URL for a search term, relative to the home directory.
    global $wp_rewrite;
    $relative_url = null;
    if ($wp_rewrite->using_permalinks()) {
        $structure = $wp_rewrite->get_search_permastruct();
        if (strpos($structure, '%search%') !== false) {
            $relative_url = str_replace('%search%', rawurlencode($term), $structure);
        }
    }
    if ( ! $relative_url) {
        $relative_url =  '?s=' . urlencode($term);
    }
    return $relative_url;
}

// Keep track of how many times this search has been saved.
// The save function may be called many times; normally we only save the first time.
$tguy_sm_save_count = 0;

function aramco_sm_save_search($posts) {

    global $wpdb, $wp_query, $tguy_sm_save_count;

    $record_duplicates = apply_filters('search_meter_record_duplicates', false);

    if (is_search()
    && !is_paged() // not the second or subsequent page of a previously-counted search
    //&& !tguy_is_admin_interface() // not using the administration console
    && (0 === $tguy_sm_save_count || $record_duplicates)
    && (aramco_sm_array_value($_SERVER, 'HTTP_REFERER')) // proper referrer (otherwise could be search engine, cache...)
    ) {
        $options = get_option('tguy_search_meter');

        // Break out if we're supposed to ignore admin searches
        if (aramco_sm_array_value($options, 'sm_ignore_admin_search') && current_user_can("manage_options")) {
            return $posts; // EARLY EXIT
        }

        // Get all details of this search
        // search string is the raw query
        $search_string = $wp_query->query_vars['s'];
        if (get_magic_quotes_gpc()) {
            $search_string = stripslashes($search_string);
        }
        // search terms is the words in the query
        $search_terms = $search_string;
        $search_terms = preg_replace('/[," ]+/', ' ', $search_terms);
        $search_terms = trim($search_terms);
        $hit_count = $wp_query->found_posts; // Thanks to Will for this line
        // Other useful details of the search
        $details = '';
        if (aramco_sm_array_value($options, 'sm_details_verbose')) {
            if ($record_duplicates) {
                $details .= "Search Meter save count: $tguy_sm_save_count\n";
            }
            foreach (array('REQUEST_URI','REQUEST_METHOD','QUERY_STRING','REMOTE_ADDR','HTTP_USER_AGENT','HTTP_REFERER')
                     as $header) {
                $details .= $header . ': ' . aramco_sm_array_value($_SERVER, $header) . "\n";
            }
        }

        // Save the individual search to the DB
        $success = $wpdb->query($wpdb->prepare("
            INSERT INTO `{$wpdb->prefix}searchmeter_recent` (`terms`,`datetime`,`hits`,`details`)
            VALUES (%s, NOW(), %d, %s)",
            $search_string,
            $hit_count,
            $details
        ));

        if ($success) {

            $rowcount = $wpdb->get_var(
                "SELECT count(`datetime`) as rowcount
                FROM `{$wpdb->prefix}searchmeter_recent`");

            $history_size = apply_filters('search_meter_history_size', 500);

            if ($history_size + 100 < $rowcount)
            {
                // find time of ($history_size)th entry; delete everything before that
                $dateZero = $wpdb->get_var($wpdb->prepare(
                    "SELECT `datetime`
                    FROM `{$wpdb->prefix}searchmeter_recent`
                    ORDER BY `datetime` DESC LIMIT %d, 1", $history_size));

                $query = "DELETE FROM `{$wpdb->prefix}searchmeter_recent` WHERE `datetime` < '$dateZero'";
                $success = $wpdb->query($query);
            }
        }

        $suppress = $wpdb->suppress_errors();
        $success = $wpdb->query($wpdb->prepare("
            INSERT INTO `{$wpdb->prefix}searchmeter` (`terms`,`date`,`count`,`last_hits`)
            VALUES (%s, CURDATE(), 1, %d)",
            $search_terms,
            $hit_count
        ));
        $wpdb->suppress_errors($suppress);
        if (!$success) {
            $success = $wpdb->query($wpdb->prepare("
                UPDATE `{$wpdb->prefix}searchmeter` SET
                    `count` = `count` + 1,
                    `last_hits` = %d
                WHERE `terms` = %s AND `date` = CURDATE()",
                $hit_count,
                $search_terms
            ));
        }
        ++$tguy_sm_save_count;
    }
    return $posts;
}
add_filter('the_posts', 'aramco_sm_save_search', 20); // run after other plugins


//////// Initialisation


function aramco_sm_init() {
    aramco_sm_create_summary_table();
    aramco_sm_create_recent_table();
}
add_action( 'init', 'aramco_sm_init' );

function aramco_sm_create_summary_table() {
// Create the table if not already there.
    global $wpdb;
    $table_name = $wpdb->prefix . "searchmeter";
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta("
            CREATE TABLE `{$table_name}` (
                `terms` VARCHAR(50) NOT NULL,
                `date` DATE NOT NULL,
                `count` INT(11) NOT NULL,
                `last_hits` INT(11) NOT NULL,
                PRIMARY KEY (`terms`,`date`)
            )
            CHARACTER SET utf8 COLLATE utf8_general_ci;
            ");
    }
}

function aramco_sm_create_recent_table() {
// Create the table if not already there.
    global $wpdb;
    $table_name = $wpdb->prefix . "searchmeter_recent";
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta("
            CREATE TABLE `{$table_name}` (
                `terms` VARCHAR(50) NOT NULL,
                `datetime` DATETIME NOT NULL,
                `hits` INT(11) NOT NULL,
                `details` TEXT NOT NULL,
                KEY `datetimeindex` (`datetime`)
            )
            CHARACTER SET utf8 COLLATE utf8_general_ci;
            ");
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

//* Wrap first word of widget title into a span tag
add_filter ( 'widget_title', 'aramco_add_span_widgets' );
function aramco_add_span_widgets( $old_title ) {

  //$title = substr_replace($old_title, '...', 24, -1);
  $len = strlen($old_title);
  if (!$len) {
    $title = 'title here';
  } else {
    $title = $old_title;
    // if ($len > 25) {
    //   $title = substr_replace(strip_tags($old_title), '...'.strlen(htmlspecialchars_decode('“') ), 25, $len);
    // }
  }

  return $title;
}


// search header icon
function new_nav_menu_items($items, $args) {
    $text = (get_theme_mod('footer_link')) ? get_theme_mod('footer_link') : '';
    $url = (get_theme_mod('footer_link_url')) ? get_theme_mod('footer_link_url') : '#';
    if( $args->theme_location == 'footer-nav' && is_page_template( 'page-three-column.php' ) ){
        $aramcoser = '<li class="float-right"><a href="'.esc_url($url).'">'.$text.'</a></li>';
        $items = $items.$aramcoser ;
    }

    return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );
