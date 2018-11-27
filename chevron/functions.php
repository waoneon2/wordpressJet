<?php
/**
 * chevron functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chevron
 */

if ( ! function_exists( 'chevron_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function chevron_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on chevron, use a find and replace
		 * to change 'chevron' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'chevron', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'gallery' ) );

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
			'menu-1' => esc_html__( 'Primary left', 'chevron' ),
			'menu-2' => esc_html__( 'Primary right', 'chevron' ),
      'menu-3' => esc_html__( 'Footer', 'chevron' ),
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
		add_theme_support( 'custom-background', apply_filters( 'chevron_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'chevron_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chevron_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'chevron_content_width', 640 );
}
add_action( 'after_setup_theme', 'chevron_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chevron_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'chevron' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'chevron' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'chevron_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chevron_scripts() {
	wp_enqueue_style( 'chevron-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'chevron-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.min.css' );

    wp_enqueue_style( 'chevron-style', get_stylesheet_uri() );

    wp_enqueue_style( 'dashicons');

	wp_enqueue_script( 'chevron-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

    wp_enqueue_script( 'chevron-script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'chevron-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'chevron-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'chevron_scripts' );

class chevron_hamburger_walker_nav_menu extends Walker {
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

/**
 * Altering Navigation
 *
 */
add_filter('wp_nav_menu_items','chevron_primary_nav', 10, 2);
function chevron_primary_nav( $items, $args ) {

  if ($args->theme_location == 'menu-1') {
    $locations = get_nav_menu_locations();

    $menu_id4 = "";
    $hamburger_bottom_link = "";
    if(!empty($locations['menu-4']) || isset($locations['menu-4'])){
        $menu_id4 = $locations['menu-4'];
        $hamburger_bottom_link = wp_get_nav_menu_items($menu_id4);
    }

    $menu_left_array = array();
    if(!empty($locations['menu-1']) || isset($locations['menu-1'])){
      $menu_id1 = $locations[ 'menu-1' ] ;
      $menu_left_array =  wp_get_nav_menu_items($menu_id1);
    }

    $menu_right_array = array();
    if(!empty($locations['menu-2']) || isset($locations['menu-2'])){
      $menu_id2 = $locations[ 'menu-2' ] ;
      $menu_right_array =  wp_get_nav_menu_items($menu_id2);
    }

    $left_and_right_not_empty = false;
    if(!empty($menu_left_array) && !empty($menu_right_array)){
        $menu_array = array_merge($menu_left_array,$menu_right_array);
        $left_and_right_not_empty = true;
    }

    $nav = '<li class="dropdown dropdown-large hamburger pull-left">' .
      '<button type="button" class="navbar-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="glyphicon glyphicon-menu-hamburger hidden-xs" aria-hidden="true"></span>
        <span class="icon-text hidden-sm">menu</span>
      </button>
      <div class="dropdown-menu dropdown-menu-large search-container container-xs-heigh theme-text-medium-blue theme-bg-medium-blue">
          <div class="row">
              <div class="close clickable" role="button" tabindex="0">
                 <span class="dashicons dashicons-no-alt"></span>
                  <span class="sr-only">close</span>
              </div>
              <div class="navbar-brand navbar-brand-centered">
                  <a class="hallmark" href="'.esc_url( home_url( '/' ) ).'" title="Chevron"><img alt="Chevron" src="'.printHeaderImage().'" width="45" height="50"></a>
              </div>
          </div>

          <div class="row row-eq-height hamburger-content width-1280 centered">';
          if ($left_and_right_not_empty) {
            foreach ($menu_array as $key => $value) {
              $parentID = $value->ID;
              $parent = ($value->menu_item_parent == 0) ? 1 : 0;
                $nav .= ($parent) ? '<div class="col col-sm-6 col-md-4 col-lg-2 first">' : '';
                  $nav .= ($parent) ? '<ul class="list-unstyled icon-list chevron-right">' : '';
                    if ($parent) {
                      $nav .= '<li class="heading">
                        <a href="'.$value->url.'">
                            <div class="nav-header-3">'.$value->title.'</div>
                        </a>
                      </li>';
                      foreach ($menu_array as $key => $value) {
                        $child = ($value->menu_item_parent == $parentID) ? 1 : 0;
                        if ($child) {
                          $nav .= '<li><a href="'.$value->url.'">'.$value->title.'</a></li>';
                        }
                      }
                    }
                  $nav .= ($parent) ? '</ul>' : '';
                $nav .= ($parent) ? '</div>' : '';
            }
          }
          $nav .= '</div>';


          $nav .= '<div class="search-bar font-gotham bg-offwhite">

              <div class="width-1280 centered">
                  <form action="'.esc_url( home_url( '/' ) ).'" method="get" class="contained">
                    <div class="input-group input-group-lg search-bar-container" id="cludo-search-meganav" role="search">
                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                        <label class="placeholder font-gotham-narrow" for="cludo-search-meganav-input">what can we help you find?</label>
                        <input id="cludo-search-meganav-input" name="s" type="text" class="form-control search-input font-gotham-narrow" placeholder="what can we help you find?">
                        <a href="javascript:void(0)" class="input-group-addon clear-search-link clear-button cludo-search-query-clear cludo-hidden">
                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                          <span class="clear-search">clear</span>
                        </a>
                        <div class="buttons pull-right">
                            <button class="input-group-addon search-button" type="submit" title="search">
                              <span class="dashicons dashicons-arrow-right-alt">
                                <span class="sr-only">search</span>
                              </span>
                            </button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
      </div>'.
    '</li>';
    return $nav.$items;
  }

  if ($args->theme_location == 'menu-2') {
    $search = '<li class="dropdown dropdown-large search pull-right">
        <button type="button" class="navbar-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <span class="glyphicon glyphicon-search hidden-xs" aria-hidden="true"></span>
          <span class="sr-only">toggle</span>
          <span class="sr-only visible-sm">search</span>
          <span class="icon-text hidden-sm">search</span>
        </button>
        <div class="dropdown-menu dropdown-menu-large row search-container">
          <div class="row">
              <div class="close clickable" role="button" tabindex="0">
                <span class="dashicons dashicons-no-alt"></span>
                <span class="sr-only">close</span>
              </div>

              <div class="navbar-brand navbar-brand-centered">
                  <a class="hallmark" href="'.esc_url( home_url( '/' ) ).'" title="Chevron"><img alt="Chevron" src="'.printHeaderImage().'" width="45" height="50"></a>
              </div>
          </div>

          <div class="search-bar font-gotham bg-offwhite">
              <div class="width-1280 centered">
                  <form action="'.esc_url( home_url( '/' ) ).'" method="get" class="contained">
                    <div class="input-group input-group-lg search-bar-container" id="cludo-search-meganav" role="search">
                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                        <label class="placeholder font-gotham-narrow" for="cludo-search-meganav-input">what can we help you find?</label>
                        <input id="cludo-search-meganav-input" name="s" type="text" class="form-control search-input font-gotham-narrow" placeholder="what can we help you find?">
                        <a href="javascript:void(0)" class="input-group-addon clear-search-link clear-button cludo-search-query-clear cludo-hidden">
                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                          <span class="clear-search">clear</span>
                        </a>
                        <div class="buttons pull-right">
                            <button class="input-group-addon search-button" type="submit" title="search">
                              <span class="dashicons dashicons-arrow-right-alt">
                                <span class="sr-only">search</span>
                              </span>
                            </button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
        </div>
    </li>';
    return $items.$search;
  }

  return $items;
}

function printHeaderImage() {
  $headerImage = get_header_image();
  if ( '' == $headerImage ) {
    $headerImage = get_template_directory_uri() . '/img/hallmark.png';
  }
  return $headerImage ;
}

function chevron_get_home_url($url){
	$input = $url;

	$input = trim($input, '/');

	if (!preg_match('#^http(s)?://#', $input)) {
		$input = 'http://' . $input;
	}

	$urlParts = parse_url($input);

	$domain = preg_replace('/^www\./', '', $urlParts['host']);

	return $domain;
}

/**
 * Breadcrumb
 *
 */

function get_breadcrumb() {

	if (is_front_page()) {
		return;
	}
	echo '<div class="breadcrumb">';
	    if (is_single()) {
	   		/*echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
	        echo '<span class="dashicons dashicons-arrow-right-alt2 "></span>';*/
	        the_category(' &nbsp;&bull;&nbsp; ');
	            if (is_single()) {
	                echo ' <span class="dashicons dashicons-arrow-right-alt2 "></span> ';
	                the_title();
	            }
	    }
    echo "</div>";
}

/**
 * More
 *
 */

function excerpt_learnmore($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

function new_excerpt_more() {
       global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"><span>read more <span class="glyphicon glyphicon-menu-right"></span></span></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function chevron_pagination( $echo = true ) {
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
		}

		$pagination .= '</ul>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
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


// Activing CSS Classes
add_filter( 'get_user_option_managenav-menuscolumnshidden', 'chevron_default_menuscolumnshidden', 99, 3 );
function chevron_default_menuscolumnshidden( $result, $option ){
    if($option == "managenav-menuscolumnshidden"){
        if ( in_array( 'css-classes', (array) $result ) ){
            unset( $result[ array_search( 'css-classes', $result ) ] );
        }
    }
    return $result;
}

require get_template_directory() . '/inc/lms.php';

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
 * Walker nav.
 */
require get_template_directory() . '/inc/chevron-walker-nav-menu.php';

/**
 * Customizer.
 */
require get_template_directory() . '/inc/chevron-custom-customizer.php';

/**
 * Widget.
 */
require get_template_directory() . '/widget/chevron-latest-news.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

