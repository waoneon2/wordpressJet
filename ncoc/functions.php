<?php
/**
 * NCOC functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NCOC
 */

if ( ! function_exists( 'ncoc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ncoc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on NCOC, use a find and replace
	 * to change 'ncoc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ncoc', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'ncoc' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'ncoc' ),
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
	add_theme_support( 'custom-background', apply_filters( 'ncoc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ncoc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ncoc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ncoc_content_width', 640 );
}
add_action( 'after_setup_theme', 'ncoc_content_width', 0 );

add_action('init', 'ncoc_add_excerpt_page');
/**
 * Add excerpt support to pages
 */
function ncoc_add_excerpt_page() {
    add_post_type_support( 'page', 'excerpt' );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ncoc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ncoc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ncoc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar on bottom menu', 'ncoc' ),
		'id'            => 'sidebar-bottom-menu',
		'description'   => esc_html__( 'Add widgets here.', 'ncoc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title" id="sidebar-of-bottom-menu">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ncoc_widgets_init' );

// Allow to upload swf file.
function add_upload_mime_types( $mimes ) {
    $mimes['swf'] = 'application/x-shockwave-flash';
    return $mimes;
}
add_filter( 'upload_mimes', 'add_upload_mime_types' );

/**
 * Enqueue scripts and styles.
 */
function ncoc_scripts() {
	wp_enqueue_style( 'bootstrap-css', trailingslashit(get_stylesheet_directory_uri()) . 'libs/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'video-js-css', trailingslashit(get_stylesheet_directory_uri()) . 'libs/css/video-js.css', array() );
	wp_enqueue_style( 'ncoc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap-js', trailingslashit(get_template_directory_uri()) . 'libs/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'cycle2-js', trailingslashit(get_template_directory_uri()) . 'js/jquery.cycle2.js', array(), '2.1.6', true);
	wp_enqueue_script( 'cycle2-caption-js', trailingslashit(get_template_directory_uri()) . 'js/jquery.cycle2.caption2.js', array(), '2.1.6', true);
	wp_enqueue_script( 'masonry-js', trailingslashit(get_template_directory_uri()) . 'js/masonry.pkgd.min.js', array(), '4.1.1', true);
	wp_enqueue_script( 'videoie8-js', trailingslashit(get_template_directory_uri()) . 'libs/js/videojs-ie8.min.js', array(), '4.1.1', false);
	wp_enqueue_script( 'video-js', trailingslashit(get_template_directory_uri()) . 'libs/js/video.js', array(), '4.1.1', true);
	
	wp_enqueue_script( 'custom-ncoc-js', trailingslashit(get_template_directory_uri()) . 'js/custom-script.js', array('jquery'), '1.0', true);
	wp_localize_script( 'custom-ncoc-js', 'jettyAjax', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ), 
		'gif_loading' => get_template_directory_uri() . '/images/loading.gif',
	));
	wp_enqueue_script( 'ncoc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'category-news-event', trailingslashit(get_template_directory_uri()) . 'js/cat_ne.js', array(), '1.0', true);

	wp_enqueue_script( 'ncoc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ncoc_scripts' );

// Breadcrumbs
function ncoc_breadcrumbs() {
	if(!is_home()) {
		echo '<nav class="breadcrumb">';
		echo '<a href="'.home_url('/').'"><b>'.get_bloginfo('name').'</b></a><span class="divider">></span>';
		if (is_category() || is_single()) {
			if(is_category()){
				global $wp_query;
	            $cat_obj = $wp_query->get_queried_object();
	            $thisCat = $cat_obj->term_id;
	            $thisCat = get_category($thisCat);
	            $parentCat = get_category($thisCat->parent);
	            if(!empty($thisCat->parent)){
	            	_e($parentCat->name,'ncoc_breadcrumb');
	            } else {
	            	_e($thisCat->name,'ncoc_breadcrumb');
	            }
			}
			$post_type = get_post_type();
			if($post_type != 'post'){
				$post_type_object 	= get_post_type_object($post_type);
	            $post_type_archive 	= get_post_type_archive_link($post_type);
	            $post_type_name 	= $post_type_object->labels->name;
	            if($post_type == 'attachment'){
	            	if($post_type_name != "Media"){
	            		_e("<span class='divider'>></span> <a href='".$post_type_archive."' title=".$post_type_name.">".$post_type_name."</a>","ncoc_breadcrumb");
	            	}
	            } else {
	            		_e("<a href='".$post_type_archive."' title=".$post_type_name.">".$post_type_name."</a>","ncoc_breadcrumb");
	            }
			}
			
			if (is_single()) {
				$category = get_the_category();
    			if(count($category) > 1){
    				the_category(' <span class="divider">></span> ');
    				echo ' <span class="divider">></span> ';
    			} else {
    				if(!empty($category)){
    					$firstCategory = $category[0]->cat_name;
						$category_id = get_cat_ID( $firstCategory );
		    			$category_link = get_category_link( $category_id );
		    			_e("<a href=".esc_url( $category_link )." title=".$firstCategory.">".$firstCategory."</a>","ncoc_breadcrumb");
		    			// echo ' <span class="divider">></span> ';
    				}
    			}
				_e('<span class="divider">></span> '.get_the_title(),'ncoc_breadcrumb');
			}
		} 
		elseif (is_page()) {
			global $post;

			if(!empty($post->post_parent)){
				$v_p = get_post($post->post_parent);
				$l_v_p = esc_url(get_permalink($post->post_parent));
				_e("<a href=".$l_v_p." title=".$v_p->post_title.">".$v_p->post_title."</a>", "ncoc_breadcrumb");
				_e(' <span class="divider">></span> ' . get_the_title(),'ncoc_breadcrumb');
			} else {
				_e(get_the_title(),'ncoc_breadcrumb');
			}
		}
		elseif (is_tag()){
			global $wp_query;
            $tag_obj = $wp_query->get_queried_object();
            $thisTag = $tag_obj->term_id;
            $thisTag = get_category($thisTag);
            $parentTag = get_category($thisTag->parent);
            if(!empty($thisTag->parent)){
            	_e($parentTag->name,"ncoc_breadcrumb");
            } else {
            	_e($thisTag->name,"ncoc_breadcrumb");
            }
		}
		echo '</nav>';
	}
}

add_action( 'admin_enqueue_scripts', 'ncoc_admin_enqueue_scripts');

function ncoc_admin_enqueue_scripts() {
    wp_enqueue_script('ncoc-publication', get_template_directory_uri() . '/js/publication-admin.js', array('jquery'));
    wp_enqueue_script('ncoc-news-events', get_template_directory_uri() . '/js/news-events-admin.js', array('jquery'));
    wp_enqueue_script('ncoc-swf-file', get_template_directory_uri() . '/js/swf-file-upload-admin.js', array('jquery'));
    wp_enqueue_script('ncoc-upload-img-rotator', get_template_directory_uri() . '/js/ncoc_add_upload_img_admin.js', array('jquery'));
	wp_enqueue_script('ncoc-second-featured-image-admin', get_template_directory_uri() . '/js/second-featured-image-admin.js', array('jquery'));
}

function get_cond_for_attachment($post_id) {
  $type = get_post_mime_type($post_id);
  switch ($type) {
    case 'image/jpeg':
    case 'image/png':
    case 'image/gif':
      return "img"; break;
    case 'video/mpeg':
    case 'video/mp4': 
    case 'video/quicktime':
      return "video"; break;
    case 'text/csv':
    case 'text/plain': 
    case 'text/xml':
      return "txt"; break;
    default:
      return "other_file";
  }
}

function ncoc_get_file_publication_path() {
    global $post;
    $file_path = get_post_meta($post->ID, '_ncoc_publication_file', true);
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

function ncoc_remote_filesize($url) {
    static $regex = '/^Content-Length: *+\K\d++$/im';
    if (!$fp = @fopen($url, 'rb')) {
        return false;
    }
    if (
        isset($http_response_header) &&
        preg_match($regex, implode("\n", $http_response_header), $matches)
    ) {
        return (int)$matches[0];
    }
    return strlen(stream_get_contents($fp));
}

function FileSizeConverts($bytes){
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

function set_header_img(){
	global $post;
	if( is_object($post) && metadata_exists( 'post', $post->ID, '_listing_image_id' ) ) {
		$cover_image_id = (int) get_post_meta( $post->ID, '_listing_image_id', true );
		if(!empty($cover_image_id)){
			$attachment_url = wp_get_attachment_url($cover_image_id);
	?>
		<style type="text/css">
			div#col-header-news-img-color {
				background-image: url(<?php echo $attachment_url; ?>);
			}
		</style>
	<?php
		}
	}
}
add_action('wp_head', 'set_header_img');

function icl_post_languages(){
	if(function_exists("icl_get_languages")){
		$languages = icl_get_languages('skip_missing=1');
		if(1 < count($languages)){
		$langs = array();
		    foreach($languages as $l){
		      if(!$l['active']) {
		      	$langs[] = '<a href="'.$l['url'].'" title="'.$l['translated_name'].'">'.$l['translated_name'].'</a>';
		      } else {
		      	$langs[] = '<a class="active_lang" href="'.$l['url'].'" title="'.$l['translated_name'].'">'.$l['translated_name'].'</a>';
		      }
		      	
		    }
		    echo join('&nbsp;&nbsp;| &nbsp;', $langs);
		 }
	} else {
		_e("Please activated/install wpml plugins.","ncoc");
	}
}

class Footer_menu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = empty($item->classes) ? array () : (array) $item->classes;
        $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        !empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
        $output .= "";
        $attributes  = '';
        !empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        !empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        !empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        if(isset($args->before) && isset($args->link_before) && isset($args->link_after) && isset($args->after)){
        	$item_output = $args->before
	        . "<a $attributes>"
	        . $args->link_before
	        . $title
	        . '</a><span class="sep"> | </span>'
	        . $args->link_after
	        . $args->after;
	        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }    
    }
}

function tinymce_add_the_table_button( $buttons ) {
   array_push( $buttons, 'separator', 'table' );
   return $buttons;
}
add_filter( 'mce_buttons', 'tinymce_add_the_table_button' );

function tinymce_add_the_table_plugin( $plugins ) {
    $plugins['table'] = get_template_directory_uri() . '/js/plugin.min.js';

    return $plugins;
}
add_filter( 'mce_external_plugins', 'tinymce_add_the_table_plugin' );

// Create category
$cat_name = ['News and Events','Publications','Contacts'];
$taxonomy = 'category';
for($i = 0;$i < count($cat_name);$i++){
	$cat[$i]  = get_term_by('name', $cat_name[$i] , $taxonomy);
	if(!$cat[$i]){
		wp_insert_term($cat_name[$i], $taxonomy);
	}
}

function get_cat_url($name_category){
	if(empty($name_category)){
		return false;
	} else {
		$cat_id = get_cat_ID($name_category);
		$cat_link = get_category_link( $cat_id );
		return esc_url($cat_link);
	}
}

function jetty_get_the_excerpt($post_id) {
  global $post;  
  if(has_excerpt( $post_id )){
	 $output = get_the_excerpt($post_id);
  	 return $output; 
  } else {
	  return false;
  }
}

add_action("wp_ajax_cat_ne_year", "cat_ne_year");
add_action("wp_ajax_nopriv_cat_ne_year", "cat_ne_year");

function cat_ne_year(){
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "cat_ne_year_nonce")) {
      exit("No access");
   	}
	$year = (int) $_REQUEST["year_id"];
	$ne_args = array(
		'category_name' => 'news-and-events',
		'post_type' => array('post'),
		'post_status' => array('publish'),
		'posts_per_page' => -1,
		'orderby' => 'date',
		'year' => $year
	);
	$ne_query = new WP_Query( $ne_args );
	$content_post_ne_ajax = array();
	$content_post_ne_ajax['status'] = 'success';
	$io = 0;
	if($ne_query->have_posts()){
		while( $ne_query->have_posts() ) {
			$ne_query->the_post();
			$default_permalink = esc_url( get_permalink() );
			$url_file = esc_url(jetty_get_the_excerpt(get_the_ID()));
			$link_validation = parse_url($url_file);
			if(count($link_validation) >= 3){
				$default_permalink = $url_file;
			}
			$content_post_ne_ajax['content'][$io] = array(
					'link' 	=> $default_permalink,
					'date' 	=> get_the_time('j F'),
					'title' => get_the_title(),
					'id' 	=> get_the_ID()
			);
			$io++;
		}
	}
	wp_reset_postdata();
	echo json_encode($content_post_ne_ajax);
	die();
}

function get_children_pages_by_page_id( $page_id = '' ){
	$pageID = $page_id;
	if(!empty($pageID)){
		$args  = array(
					'child_of'		=> $pageID,
					'parent'		=> $pageID,
					'sort_order' 	=> 'ASC',
					'sort_column' 	=> 'menu_order',
					'post_type' 	=> 'page',
					'post_status' 	=> 'publish'
				);
		$content_children = get_pages( $args );
		return $content_children;
	} else {
		return false;
	}
	
}

function sitemap_shortcode($atts) {
	return wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'menu-sitemap' ) );
}
add_shortcode( 'ncoc_sitemap', 'sitemap_shortcode' );

require get_template_directory() . '/inc/ncoc_widget_media_center.php';
require get_template_directory() . '/inc/ncoc_widget_latest_news.php';
require get_template_directory() . '/inc/ncoc-add-custom-upload-img.php';
require get_template_directory() . '/inc/ncoc-add-second-featured-image.php';
require get_template_directory() . '/inc/ncoc_category_extra_field.php';
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
