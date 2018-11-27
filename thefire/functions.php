<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

//force redirect to secure page
//if($_SERVER['SERVER_PORT'] != '443') { header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); exit(); }
add_action('init', function () {
    include_once __DIR__ .'/inc/tweetable.php';
});

add_action('admin_init', function() {
	include_once __DIR__ .'/inc/media.php';
});

add_action('wp_enqueue_scripts', 'fire_add_fontawesome');
function fire_add_fontawesome() {
    wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
}

add_shortcode('debate_share', 'fire_debate_share_func');
function fire_debate_share_func($atts) {
    $parsed = shortcode_atts( array (
        'url' => '',
        'title' => '',
    ), $atts);

    $facebook  = http_build_query ( array ( 'u' => $parsed['url'] ));
    $twitter   = http_build_query ( array ( 'url' => $parsed['url'], 'text' => $parsed['title'], 'hashtags' => 'FIREDebates' ));
    $gplus     = http_build_query ( array ( 'url' => $parsed['url'] ));
    $reddit    = http_build_query ( array ( 'url' => $parsed['url'], 'title' => $parsed['title'] ));
    $pinterest = http_build_query ( array ( 'url' => $parsed['url'], 'description' => $parsed['title'] ));
    $linkedin  = http_build_query ( array ( 'url' => $parsed['url'], 'title' => $parsed['title'] ));

    return <<<EOS
<ul class="debate-share">
  <li>Share this debate:</li>
  <li><a target="_blank" href="https://www.facebook.com/share.php?{$facebook}"><i class="fa fa-facebook"></i></a></li>
  <li><a target="_blank" href="https://twitter.com/share?{$twitter}"><i class="fa fa-twitter"></i></a></li>
  <li><a target="_blank" href="https://plus.google.com/share?{$gplus}"><i class="fa fa-google-plus"></i></a></li>
  <li><a target="_blank" href="https://www.reddit.com/submit?{$reddit}"><i class="fa fa-reddit"></i></a></li>
  <li><a target="_blank" href="https://pinterest.com/pin/create/bookmarklet/?{$pinterest}"><i class="fa fa-pinterest"></i></a></li>
  <li><a target="_blank" href="https://linkedin.com/shareArticle?{$linkedin}"><i class="fa fa-linkedin"></i></a></li>
</ul>
EOS;
}

function amazoneDonateButton() {
	return '
<script async src="https://static-na.payments-amazon.com/OffAmazonPayments/us/js/Widgets.js"></script>
<div
    data-ap-widget-type="expressDonationWidget"
    data-ap-widget-theme="ap-dark"
    data-ap-widget-amount-presets="50,100,250,500"
    data-ap-signature="okFHn9QBqj4%2B%2FC1lltVwxG7ggvNuydm67h8PUQlNXKc%3D"
    data-ap-seller-id="A3BMBZ8G70JE8M"
    data-ap-access-key="AKIAIK2CCPC23Q4KTRZA"
    data-ap-lwa-client-id="amzn1.application-oa2-client.4272aba86c4b41eca06f5f08e25e7fff"
    data-ap-return-url="https://www.thefire.org/donate/thank-you"
    data-ap-currency-code="USD"
    data-ap-note=""
    data-ap-shipping-address-required="false"
    data-ap-payment-action="AuthorizeAndCapture">
</div>';
}

add_shortcode('amazon-donate', 'amazoneDonateButton');

add_post_type_support( 'post', 'excerpt');

add_filter( 'coauthors_guest_authors_enabled', '__return_false' );

// http://wordpress.stackexchange.com/questions/20580/disable-update-notification-for-individual-plugins
add_filter('site_transient_update_plugins', 'fire_site_transient_update_plugins');
function fire_site_transient_update_plugins($value) {
    unset($value->response['popup/show_popup.php']);
    unset($value->response['formstack/Plugin.php']);
    unset($value->response['formstack/Widget.php']);
    return $value;
}

$protocol = "http://";
if ( $_SERVER['HTTPS'] == 'on' ) {
	$protocal = "https://";
}
define("CURRENT_PROTOCOL", $protocol);
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}

add_action( 'loop_start', 'jptweak_remove_share' );


class description_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->object_id . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

add_filter('the_content', 'filter_entities');

function filter_entities($content) {
	return html_entity_decode($content, ENT_QUOTES, "UTF-8");
}

$state_abbreviations = array('Alabama' => 'AL', 'Alaska' => 'AK', 'American Samoa' => 'AS', 'Arizona' => 'AZ', 'Arkansas' => 'AR', 'California' => 'CA', 'Colorado' => 'CO', 'Connecticut' => 'CT', 'Delaware' => 'DE', 'District Of Columbia' => 'DC', 'Federated States Of Micronesia' => 'FM', 'Florida' => 'FL', 'Georgia' => 'GA', 'Guam Gu' => 'GU', 'Hawaii' => 'HI', 'Idaho' => 'ID', 'Illinois' => 'IL', 'Indiana' => 'IN', 'Iowa' => 'IA', 'Kansas' => 'KS', 'Kentucky' => 'KY', 'Louisiana' => 'LA', 'Maine' => 'ME', 'Marshall Islands' => 'MH', 'Maryland' => 'MD', 'Massachusetts' => 'MA', 'Michigan' => 'MI', 'Minnesota' => 'MN', 'Mississippi' => 'MS', 'Missouri' => 'MO', 'Montana' => 'MT', 'Nebraska' => 'NE', 'Nevada' => 'NV', 'New Hampshire' => 'NH', 'New Jersey' => 'NJ', 'New Mexico' => 'NM', 'New York' => 'NY', 'North Carolina' => 'NC', 'North Dakota' => 'ND', 'Northern Mariana Islands' => 'MP', 'Ohio' => 'OH', 'Oklahoma' => 'OK', 'Oregon' => 'OR', 'Palau' => 'PW', 'Pennsylvania' => 'PA', 'Puerto Rico' => 'PR', 'Rhode Island' => 'RI', 'South Carolina' => 'SC', 'South Dakota' => 'SD', 'Tennessee' => 'TN', 'Texas' => 'TX', 'Utah' => 'UT', 'Vermont' => 'VT', 'Virgin Islands' => 'VI', 'Virginia' => 'VA', 'Washington' => 'WA', 'West Virginia' => 'WV', 'Wisconsin' => 'WI', 'Wyoming' => 'WY');
$state_abbreviations_reverse = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AS' => 'American Samoa', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District Of Columbia', 'FM' => 'Federated States Of Micronesia', 'FL' => 'Florida', 'GA' => 'Georgia', 'GU' => 'Guam Gu', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MH' => 'Marshall Islands', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'MP' => 'Northern Mariana Islands', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PW' => 'Palau', 'PA' => 'Pennsylvania', 'PR' => 'Puerto Rico', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VI' => 'Virgin Islands', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
$speech_codes = array('Exempt' => 5, 'Not yet rated' => 4, 'Green' => 3, 'Yellow' => 2, 'Red' => 1);
$speech_codes_reverse = array(5 => 'Exempt', 4 => 'Not yet rated', 3 => 'Green', 2 => 'Yellow', 1 => 'Red', 0 => 'Undefined', 'Not yet rated' => 'Undefined');

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */

if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Adds support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
//comment from
function firecomps_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */

	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', firecomps_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
			'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );
	register_nav_menu( 'secondary', __( 'Footer Menu', 'firecomps' ) );
	register_nav_menu( 'third', __( 'Sidebar Menu', 'firecomps' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 390, 390, true);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'firecomps_setup' );



//function wpa82763_custom_type_in_categories( $query ) {
//    if ( $query->is_main_query()
//    && ( $query->is_category() || $query->is_tag() ) ) {
//        $query->set( 'post_type', array( 'fire_cases', 'post') );
//    }
//}
//add_action( 'pre_get_posts', 'wpa82763_custom_type_in_categories' );



function firecomps_post_types() {
    $delete_caps = array(
        'delete_posts',
        'delete_others_posts',
        'delete_published_posts',
        'delete_private_posts',
        'delete_pages',
        'delete_others_pages',
        'delete_published_pages',
        'delete_private_pages',
    );
    $delete_roles = array('editor', 'author', 'contributor', 'subscriber');
    foreach ($delete_roles as $delete_role) {
        $role = get_role($delete_role);
        foreach ($delete_caps as $delete_cap) {
            $role->remove_cap($delete_cap);
        }
    }

	register_post_type( 'video', array(
			'labels' => array('name' => __( 'Videos' ), 'singular_name' => __( 'Video' )),
			'public' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'post-formats'),
	) );

	register_post_type('fire_cases', // Register Custom Post Type
			array(
					'labels' => array(
							'name' => __('Cases', 'thefire'), // Rename these to suit
							'singular_name' => __('Case', 'thefire'),
							'add_new' => __('Add New Case', 'thefire'),
							'add_new_item' => __('Add New Case', 'thefire'),
							'edit' => __('Edit', 'thefire'),
							'edit_item' => __('Edit Case', 'thefire'),
							'new_item' => __('New Case', 'thefire'),
							'view' => __('View Case', 'thefire'),
							'view_item' => __('View Case', 'thefire'),
							'search_items' => __('Search Cases', 'thefire'),
							'not_found' => __('No Cases found', 'thefire'),
							'not_found_in_trash' => __('No Cases found in Trash', 'thefire')
					),
					'public' => true,
					'publicly_queryable' => true,
					'show_ui' => true,
					'query_var' => true,
					'rewrite' => array(
							'slug' => 'cases'
					),
					'capability_type' => 'post',
					'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
					'has_archive' => true,
					'supports' => array(
							'title',
							'author',
							'editor',
							'excerpt',
							'thumbnail',
							'custom-fields',
					),
					'can_export' => true, // Allows export in Tools > Export
					'taxonomies' => array(
							'post_tag',
							'category'
					) // Add Category and Post Tags support
			));

	//register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
	//register_taxonomy_for_object_type('post_tag', 'html5-blank');
	register_post_type('fire_schools', // Register Custom Post Type
			array(
					'labels' => array(
							'name' => __('Schools', 'thefire'), // Rename these to suit
							'singular_name' => __('School', 'thefire'),
							'add_new' => __('Add New School', 'thefire'),
							'add_new_item' => __('Add New School', 'thefire'),
							'edit' => __('Edit', 'thefire'),
							'edit_item' => __('Edit School', 'thefire'),
							'new_item' => __('New School', 'thefire'),
							'view' => __('View School', 'thefire'),
							'view_item' => __('View School', 'thefire'),
							'search_items' => __('Search Schools', 'thefire'),
							'not_found' => __('No Schools found', 'thefire'),
							'not_found_in_trash' => __('No Schools found in Trash', 'thefire'),
							'supports' => array('title', 'custom-fields', 'page-attributes'),
					),
					'public' => true,
					'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
					'has_archive' => true,
					'yarpp_support' => true,
					'supports' => array(
							'title',
							'editor',
							'excerpt',
							'thumbnail',
							'custom-fields'
					),
					'rewrite' => array(
							'slug' => 'schools'
					),
					'can_export' => true, // Allows export in Tools > Export
					'taxonomies' => array(
							'post_tag',
							'category'
					) // Add Category and Post Tags support
			));

	register_post_type('fire_speech-codes', // Register Custom Post Type
			array(
					'labels' => array(
							'name' => __('Statements', 'thefire'), // Rename these to suit
							'singular_name' => __('Statement', 'thefire'),
							'add_new' => __('Add New Statement', 'thefire'),
							'add_new_item' => __('Add New Statement', 'thefire'),
							'edit' => __('Edit', 'thefire'),
							'edit_item' => __('Edit Statement', 'thefire'),
							'new_item' => __('New Statement', 'thefire'),
							'view' => __('View Statement', 'thefire'),
							'view_item' => __('View Statement', 'thefire'),
							'search_items' => __('Search Statements', 'thefire'),
							'not_found' => __('No Statements found', 'thefire'),
							'not_found_in_trash' => __('No Statements found in Trash', 'thefire')
					),
					'public' => true,
					'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
					'has_archive' => true,
					'supports' => array(
							'title',
							'excerpt',
							'thumbnail',
							'custom-fields',
					),
					'can_export' => true, // Allows export in Tools > Export
					'taxonomies' => array(
							'post_tag',
							'category'
					) // Add Category and Post Tags support
			));
}
add_action('init','firecomps_post_types');

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function firecomps_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$font_families[] = 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic';

		$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function firecomps_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'firecomps-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

	wp_enqueue_script( 'comm100-script', '//hosted.comm100.com/AdminPluginService/js/subscribe.js', array(), '2013-10-08');
	wp_enqueue_script( 'google-maps-v3', '//maps.google.com/maps/api/js?sensor=false', array(), '2013-10-14' );
	wp_enqueue_script( 'jquery-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array( 'jquery' ), '2013-10-14' );
	wp_enqueue_script( 'raphael', get_template_directory_uri() . '/js/raphael.js', array( 'jquery' ), '2013-10-15' );
	wp_enqueue_script( 'jquery-usmap', get_template_directory_uri() . '/js/jquery.usmap.js', array( 'jquery' ), '2013-10-15' );
	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '2013-10-15' );


	// Add Open Sans and Bitter fonts, used in the main stylesheet.
	//wp_enqueue_style( 'firecomps-fonts', firecomps_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'firecomps-style', get_stylesheet_uri(), array(), '2013-07-18' );
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/grid.css', array(), '2013-11-11' );
	wp_enqueue_style( 'ginacss', get_template_directory_uri() . '/css/GinaCSS.css', array(), '2014-07-30' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'firecomps-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'firecomps-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'firecomps_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}




add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
			'name'          => __( 'Main Widget Area', 'twentythirteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
	) );

	register_sidebar( array(
			'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
	/**
	 * Displays navigation to next/previous set of posts when applicable.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @return void
	 */
	function twentythirteen_paging_nav($type = '', $off = '', $nav = '') {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return;
		if($type == 'schools') { ?>
			<nav class="navigation paging-navigation" role="navigation">
				<!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
				<div class="nav-links">
					<?php if ( get_next_posts_link() ) : ?>
						<div class="nav-previous"><?php next_posts_link( __( '&or; More schools', 'twentythirteen' ) ); ?></div>
					<?php endif; ?>
					<?php if ( get_previous_posts_link() ) : ?>
						<div class="nav-next"><?php previous_posts_link( __( 'Go back &gt;&gt;', 'twentythirteen' ) ); ?></div>
					<?php endif; ?>
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->

		<?php 	} else { ?>

			<nav class="navigation paging-navigation" role="navigation">
				<!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
				<div class="nav-links">
					<?php if ( get_next_posts_link() ) : ?>
						<div class="nav-previous"><?php next_posts_link( __( '&darr; Older posts ', 'twentythirteen' ) ); ?></div>
					<?php endif; ?>
					<?php if ( get_previous_posts_link() ) : ?>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &gt;&gt;', 'twentythirteen' ) ); ?></div>
					<?php endif; ?>
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->

		<?php	} ?>

		<?php if( $off == '') { ?>
			<?php if( $nav == 'auto') { ?>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#content .posts-list').infinitescroll({
							navSelector  	: "#content .navigation",
							nextSelector 	: ".nav-previous a",
							itemSelector 	: ".item",
							loading			: {
								img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
								msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
								finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
							}
						});
					});

				</script>
			<?php } else { ?>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#content .posts-list').infinitescroll({
							navSelector  	: "#content .navigation",
							nextSelector 	: ".nav-previous a",
							itemSelector 	: ".item",
							behavior		: "twitter",
							loading			: {
								img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
								msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
								finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
							}
						});
					});

				</script>
			<?php } ?>
		<?php } ?>

	<?php
	}
endif;

if ( ! function_exists( 'ww_paging_nav_view_all' ) ) :
    /**
     * Displays navigation to next/previous set of posts when applicable in addition to a view all link
     *
     */
    function ww_paging_nav_view_all($type = '', $off = '', $nav = '') {
        global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 )
            return;
        if($type == 'schools') { ?>
            <nav class="navigation paging-navigation" role="navigation">
                <!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
                <div class="nav-links">
                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><?php next_posts_link( __( '&or; More schools', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                    <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><?php previous_posts_link( __( 'Go back &gt;&gt;', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                </div><!-- .nav-links -->
            </nav><!-- .navigation -->

        <?php 	} else { ?>

            <nav class="navigation paging-navigation" role="navigation">
                <!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
                <div class="nav-links">
                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><?php next_posts_link( __( '&darr; Older posts ', 'twentythirteen' ) ); ?></div>
                        <?php if(is_archive() && !wp_is_mobile()): ?>
                            <?php
                                if(is_category()){
                                    $archive_cat_id = get_query_var('cat');

                                    $view_all_query_string = "?cat=" . $archive_cat_id . "&amp;limit=all";
                                }
                                else{
                                    $view_all_query_string = "?limit=all";
                                }

                            ?>
                            <div class="nav-next"><a class="view-all-posts" href="<?php echo $view_all_query_string; ?>">View all</a></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts &gt;&gt;', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                </div><!-- .nav-links -->
            </nav><!-- .navigation -->

        <?php	} ?>

        <?php if( $off == '') { ?>
            <?php if( $nav == 'auto') { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list').infinitescroll({
                            navSelector  	: "#content .navigation",
                            nextSelector 	: ".nav-previous a",
                            itemSelector 	: ".item",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } else { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list').infinitescroll({
                            navSelector  	: "#content .navigation",
                            nextSelector 	: ".nav-previous a",
                            itemSelector 	: ".item",
                            behavior		: "twitter",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } ?>
        <?php } ?>

    <?php
    }
endif;

if ( ! function_exists( 'ww_paging_nav_view_all_author' ) ) :
    /**
     * Displays navigation to next/previous set of posts when applicable in addition to a view all link
     *
     */
    function ww_paging_nav_view_all_author($type = '', $off = '', $nav = '') {
        global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 )
            return;
        if($type == 'schools') { ?>
            <nav class="navigation paging-navigation" role="navigation">
                <!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
                <div class="nav-links">
                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><?php next_posts_link( __( '&or; More schools', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                    <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><?php previous_posts_link( __( 'Go back &gt;&gt;', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                </div><!-- .nav-links -->
            </nav><!-- .navigation -->

        <?php 	} else { ?>

            <nav class="navigation paging-navigation" role="navigation">
                <!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
                <div class="nav-links">
                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><?php next_posts_link( __( '&darr; Older posts ', 'twentythirteen' ) ); ?></div>
                        <?php if(is_archive() && !wp_is_mobile()): ?>
                            <?php
                                $view_all_query_string = "?limit=all";
                            ?>
                            <div class="nav-next"><a class="view-all-posts" href="<?php echo $view_all_query_string; ?>">View all</a></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts &gt;&gt;', 'twentythirteen' ) ); ?></div>
                    <?php endif; ?>
                </div><!-- .nav-links -->
            </nav><!-- .navigation -->

        <?php	} ?>

        <?php if( $off == '') { ?>
            <?php if( $nav == 'auto') { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list').infinitescroll({
                            navSelector  	: "#content .navigation",
                            nextSelector 	: ".nav-previous a",
                            itemSelector 	: ".item",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } else { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list').infinitescroll({
                            navSelector  	: "#content .navigation",
                            nextSelector 	: ".nav-previous a",
                            itemSelector 	: ".item",
                            behavior		: "twitter",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } ?>
        <?php } ?>

    <?php
    }
endif;

if ( ! function_exists( 'ww_paging_nav' ) ) :
	/**
	 * Displays navigation to next/previous set of posts when applicable.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @return void
	 */
	function ww_paging_nav($type = '', $off = '', $nav = '') {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return; ?>

		<nav class="navigation-ww paging-navigation" role="navigation">
			<!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
			<div class="nav-links">
				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous-ww"><?php next_posts_link( __( '&darr; Older posts', 'twentythirteen' ) ); ?></div>
				<?php endif; ?>
				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next-ww"><?php previous_posts_link( __( 'Newer posts &gt;&gt;', 'twentythirteen' ) ); ?></div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->

		<?php if( $off == '') { ?>
			<?php if( $nav == 'auto') { ?>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#content .posts-list-ww').infinitescroll({
							navSelector  	: "#content .navigation-ww",
							nextSelector 	: ".nav-previous-ww a",
							itemSelector 	: ".item-one",
							loading			: {
								img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
								msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
								finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
							}
						});
					});

				</script>
			<?php } else { ?>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#content .posts-list-ww').infinitescroll({
							navSelector  	: "#content .navigation-ww",
							nextSelector 	: ".nav-previous-ww a",
							itemSelector 	: ".item-one",
							behavior		: "twitter",
							loading			: {
								img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
								msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
								finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
							}
						});
					});

				</script>
			<?php } ?>
		<?php } ?>

	<?php
	}



endif;



if ( ! function_exists( 'ww_paging_nav_author_articles' ) ) :
    /**
     * Author Article Pagination
     */
    function ww_paging_nav_author_articles($type = '', $off = '', $nav = '') {
        global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 )
            return; ?>

        <nav class="navigation-ww paging-navigation" role="navigation">
            <!--<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>-->
            <?php if ( get_next_posts_link() ) : ?>
                <?php if(is_archive() && !wp_is_mobile()): ?>
                    <?php
                    $view_all_query_string = "?article-limit=all";
                    ?>
                    <div class="nav-next"><a class="view-all-posts" href="<?php echo $view_all_query_string; ?>">View all</a></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="nav-links">
                <?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-previous-ww"><?php next_posts_link( __( '&darr; Older posts', 'twentythirteen' ) ); ?></div>
                <?php endif; ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->

        <?php if( $off == '') { ?>
            <?php if( $nav == 'auto') { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list-ww').infinitescroll({
                            navSelector  	: "#content .navigation-ww",
                            nextSelector 	: ".nav-previous-ww a",
                            itemSelector 	: ".item-one",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } else { ?>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
                <script type="text/javascript">

                    jQuery(document).ready(function() {
                        jQuery('#content .posts-list-ww').infinitescroll({
                            navSelector  	: "#content .navigation-ww",
                            nextSelector 	: ".nav-previous-ww a",
                            itemSelector 	: ".item-one",
                            behavior		: "twitter",
                            loading			: {
                                img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                                msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
                                finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                            }
                        });
                    });

                </script>
            <?php } ?>
        <?php } ?>

    <?php
    }



endif;



if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
	/**
	 * Displays navigation to next/previous post when applicable.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @return void
	 */
	function twentythirteen_post_nav() {
		global $post;

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
			<div class="nav-links">

				<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
				<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own twentythirteen_entry_meta() to override in a child theme.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @return void
	 */
	function twentythirteen_entry_meta() {
		if ( is_sticky() && is_home() && ! is_paged() )
			echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

		if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
			twentythirteen_entry_date();

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links">' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
		if ( $tag_list ) {
			echo '<span class="tags-links">' . $tag_list . '</span>';
		}

		// Post author
		if ( 'post' == get_post_type() ) {
			printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
					get_the_author()
			);
		}
	}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
	/**
	 * Prints HTML with date information for current post.
	 *
	 * Create your own twentythirteen_entry_date() to override in a child theme.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 * @return string The HTML-formatted post date.
	 */
	function twentythirteen_entry_date( $echo = true ) {
		if ( has_post_format( array( 'chat', 'status' ) ) )
			$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
		else
			$format_prefix = '%2$s';

		$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
				esc_url( get_permalink() ),
				esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);

		if ( $echo )
			echo $date;

		return $date;
	}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Twenty Thirteen 1.0
	 *
	 * @return void
	 */
	function twentythirteen_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
				'post_parent'    => $post->post_parent,
				'fields'         => 'ids',
				'numberposts'    => -1,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => 'ASC',
				'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
				esc_url( $next_attachment_url ),
				the_title_attribute( array( 'echo' => false ) ),
				wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

function firecomps_xhtml_searchform($format) {
	return 'xhtml';
}
add_filter('search_form_format', 'firecomps_xhtml_searchform');

function firecomps_get_the_categories($categories) {
	$result = array();
	foreach ($categories as $category) {
		if ($category->name == 'Featured') continue;
		$result[] = $category;
	}
	return $result;
}
add_filter('get_the_categories', 'firecomps_get_the_categories');


if (!function_exists('firecomps_home_banner')):
	function firecomps_home_banner() {
		$args = array(
			'post_type' => array( 'post', 'page' ),
			'post_status' => 'publish',
			'posts_per_page' => 100,
			'orderby' => 'date',
			'order' => 'DESC',
			'meta_query' => array(
				array(
					'key' => 'include_on_homepage',
					'value' => '1',
					'compare' => '=='
				)
			)
		);
		$query_banner = new WP_Query($args);

		$sliderArray = array();

		while ($query_banner->have_posts()){
			$query_banner->the_post();

			if(get_field('slider_order') == "") {
				$sliderArray[] = array(
					"order" => (get_field('slider_order') == "" ? 8 : get_field('slider_order')),
					"image" => get_field('banner_home_image'),
					"title" => get_the_title(),
					"permalink" => get_the_permalink(),
					"type" => get_post_type(),
					"date" => date("Ymd", strtotime(get_the_date()))
				);
			}
		}

		$args = array(
			'post_type' => array( 'post', 'page' ),
			'post_status' => 'publish',
			'posts_per_page' => 100,
			'order'     => 'ASC',
			'meta_key' => 'slider_order',
			'orderby'   => 'meta_value_num date',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'include_on_homepage',
					'value' => '1',
					'compare' => '=='
				),
				array(
					'key' => 'slider_order',
					'value' => '0',
					'compare' => '>'
				)

			)
		);
		$query_banner = new WP_Query($args);

		$i = 0;
		while ($query_banner->have_posts()){
			$query_banner->the_post();

			if(get_field('slider_order') > 0) {
				$array = array(
					(get_field('slider_order')-1) => array(
						"order" => get_field('slider_order'),
						"image" => get_field('banner_home_image'),
						"title" => get_the_title(),
						"permalink" => get_the_permalink(),
						"type" => get_post_type(),
						"counter" => $i++,
						"date" => date("Ymd", strtotime(get_the_date()))
					)
				);

				array_splice($sliderArray, (get_field('slider_order')-1), 0, $array);
			}
		}

		//echo "<pre>";
		//print_r($sliderArray);
		//echo "</pre>";

		$count = 0;
		foreach ($sliderArray as $slide) {
			if($count < 7) {
				?>
				<li class="item" data-thumb="<?php echo $slide['image']; ?>" >
					<h1><a href="<?php echo $slide['permalink']; ?>"><?php echo $slide['title']; ?></a></h1>
					<figure><a href="<?php echo $slide['permalink']; ?>"><img src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>" /></a></figure>
				</li>
				<?php
			}
			$count++;
		}

		/*
		while ($query_banner->have_posts()): $query_banner->the_post();
			$categories = get_the_category(get_the_ID());
			$category_name = '';
			if ($categories) foreach ($categories as $category) $category_name = $category->name;
			?>
			<li class="item" data-thumb="<?php echo the_field('banner_home_image');?>" >
				<h1><a href="<?php the_permalink(); ?>">
						<?php // removed - if ($category_name): echo sprintf(__('<span>%s of the Month:</span>', 'firecomps'), $category_name); endif; ?>
						<?php the_title(); ?>
					</a></h1>
				<?php
				$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
				if ( $categories_list ):
					?>
					<!-- removed - <p class="categories-links"><?php //echo $categories_list; ?></p> -->
				<?php endif; ?>
				<figure><a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('banner_home_image') ;?>" alt="<?php the_title(); ?>" /></a></figure>
			</li>
		<?php
		endwhile;
		*/
	}
endif;

if (!function_exists('firecomps_home_featured')):
	function firecomps_home_featured() {
		?>
		<section class="featured-content-home clearfix">
			<header><?php echo __('Featured Content', 'firecomps'); ?></header>
			<footer><a href="/featured-stories">Read More Featured Articles</a></footer>
		</section>
	<?php
	}
endif;

if (!function_exists('firecomps_home_recent')):
	function firecomps_home_recent() {
		$args = array(
				'cat' => '8',
				'post_type' => array( 'post', 'fire_cases'),
				'post_status' => 'publish',
				'posts_per_page' => 2,
				'orderby' => 'date',
				'order' => 'DESC',
		);
		$query_recent = new WP_Query($args);
		if ($query_recent->have_posts()):
			?>
			<section class="wrapper grid recent-home clearfix">
				<header>
					<div class="grid-content">
						<?php echo __('Recent', 'firecomps'); ?>
						<span><?php echo __('Cases, press releases, and commentary', 'firecomps'); ?></span>
					</div>
				</header>
				<?php $i = 0; while ($query_recent->have_posts()): $query_recent->the_post(); ?>
					<?php if ($i % 2 == 0): ?>
						<div class="item grid-thumb">
							<?php $source_type2 = trim( get_post_meta( get_the_ID(), "390_home_img", true) );
							if( !empty( $source_type2 ) ) : // Checks if has image.   ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('390_home_img') ;?>" alt="<?php the_title(); ?>" /></a>
							<?php  else : ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo @CURRENT_PROTOCOL; ?>placehold.it/390x390" alt="<?php the_title(); ?>" /></a>
							<?php endif; ?>
							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<!--<span class="categories-links"><?php echo $categories_list; ?></span>-->
							<?php endif; ?>
						</div>
						<div class="item grid-topic grid-topic-right">
							<div class="grid-content">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
								<span class="arrow"></span>
							</div>
						</div>
					<?php else: ?>
						<?php $source_type2 = trim( get_post_meta( get_the_ID(), "390_home_img", true) ); ?>
						<div class="item grid-topic grid-topic-left">
							<div class="grid-content">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="item grid-thumb">

							<?php     if( !empty( $source_type2 ) ) : // Checks if has image.   ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('390_home_img') ?>" alt="<?php the_title(); ?>" /></a>
							<?php  else : ?>
								<a href="<?php the_permalink(); ?>"><img src="/wp-content/themes/thefire/images/390x390.jpg" alt="<?php the_title(); ?>" /></a>
							<?php endif; ?>
							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<!--<span class="categories-links"><?php echo $categories_list; ?></span>-->
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php $i++; endwhile; ?>
				<footer>
					<div class="grid-content">
						<a href="<?php echo get_category_link(8); ?>"><?php echo __('View More', 'firecomps'); ?></a>
					</div>
				</footer>
			</section>
		<?php
		endif;
	}
endif;
if (!function_exists('firecomps_home_defend')):
	function firecomps_home_defend() {
		$args = array(

				'post_type' => 'fire_cases',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_query' => array(
						array(
								'key' => 'add_to_homepage_featured',
								'value' => '1',
								'compare' => '==' ))
		);
		$query_defend = new WP_Query($args);
		if ($query_defend->have_posts()):
			?>
			<section class="wrapper grid defend-home clearfix">
				<header>
					<?php echo __('FIRE Defends Students', 'firecomps'); ?>
					<span><?php echo __('Follow current cases and recent victories for free speech rights.', 'firecomps'); ?></span>
					<a href="javascript:void(0);">Submit a Case</a>
				</header>
				<?php $i = 0; while ($query_defend->have_posts()): $query_defend->the_post(); ?>
					<?php if ($i % 2 == 0): ?><div class="item grid-long-2x1"><?php endif; ?>
					<div>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<figure><a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('cases_featured_banner'); ?>" alt="<?php the_title(); ?>" /></a></figure>
					</div>
					<?php if ($i % 2 == 1): ?></div><?php endif; ?>
					<?php $i++; endwhile; ?>
				<footer><a href="<?php echo get_category_link(530); ?>"><?php echo __('View More', 'firecomps'); ?></a></footer>
			</section>
		<?php
		endif;
	}
endif;
// New If


if (!function_exists('get_schools_item')):
	function get_schools_item() {
		$connected2 = new WP_Query( array(
				'connected_type' => 'post_schools',
				'connected_items' => get_queried_object(),
		) );
		// Display connected pages
		if ( $connected2->have_posts() ) :
			while ( $connected2->have_posts() ) : $connected2->the_post(); ?>
				<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
			<?php endwhile;
			endif;
	}
endif;




if (!function_exists('firecomps_home_video')):
	function firecomps_home_video() {

		/*
		$args = array(
			'post_type' => 'video',
			'post_status' => 'publish',
			'posts_per_page' => 2,
			'orderby' => 'date',
			'order' => 'DESC',
		);
		*/

		?>

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.fancybox-media')
						.attr('rel', 'media-gallery')
						.fancybox({
							openEffect : 'none',
							closeEffect : 'none',
							prevEffect : 'none',
							nextEffect : 'none',

							arrows : false,
							helpers : {
								media : {},
								buttons : {}
							}
						});
			});
		</script>

		<section class="wrapper grid video-home clearfix">
			<header>
				<div class="grid-content">
					<?php echo __('Video', 'firecomps'); ?>
					<span><?php echo __("Watch FIRE's latest videos about protecting rights on campus", 'firecomps'); ?></span>
				</div>
			</header>
			<?php
			$args = array(
					'cat' => '832',
					'post_type' => array( 'post', 'fire_cases'),
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
			);

			// New If
			$query_video = new WP_Query($args);
			if ($query_video->have_posts()):

				$i = 0; while ($query_video->have_posts()): $query_video->the_post(); $thumbnail = get_post_custom_values('video_thumbnail', get_the_ID()); ?>
				<?php if ($thumbnail): ?>
					<div class="item grid-long-1x1">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0] ;?>" alt="<?php the_title(); ?>" /></a></figure>
					</div>
				<?php elseif ($i % 2 == 0): ?>
					<div class="item grid-topic grid-topic-left">
						<div class="grid-content">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<a href="<?php the_permalink(); ?>" class="more">Watch Video</a>
							<span class="arrow"></span>
						</div>
					</div>
					<div class="item grid-thumb">
						<?php
						$array = array();
						preg_match( '/src="([^"]*)"/i', get_the_content(), $array ) ;
						?>
						<a class="play fancybox-media" href="<?php echo $array[1]; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play.png" /></a>
						<img src="<?php echo the_field('390_home_img'); ?>" />
						<?php
						$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
						if ( $categories_list ):
							?>
							<span class="categories-links"><?php echo $categories_list; ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php $i++; endwhile; endif;?>


			<?php
			$args = array(
					'cat' => '832',
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
			);

			// New If
			$query_video = new WP_Query($args);
			if ($query_video->have_posts()):

				while ($query_video->have_posts()): $query_video->the_post(); $thumbnail = get_post_custom_values('video_thumbnail', get_the_ID()); ?>
					<div class="item grid-thumb">
						<?php
						$array = array();
						preg_match( '/src="([^"]*)"/i', get_the_content(), $array ) ;
						?>
						<a class="play fancybox-media" href="<?php echo $array[1]; ?>" rel="media-gallery"><img src="<?php bloginfo('template_directory'); ?>/images/play.png" scale="0"></a>
						<img src="<?php echo get_field('390_home_img'); ?>" />
					</div>
					<div class="item grid-topic grid-topic-right">
						<div class="grid-content">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<a href="<?php the_permalink(); ?>" class="more">Watch Video</a>
							<span class="arrow"></span>
						</div>
					</div>
				<?php endwhile; endif; wp_reset_postdata(); ?>

			<footer>
				<div class="grid-content">
					<a href="http://www.youtube.com/thefireorg"><?php echo __('View More', 'firecomps'); ?></a>
				</div>
			</footer>
		</section>
	<?php

	}
endif;

if (!function_exists('firecomps_get_top_posts')):
	function firecomps_get_top_posts($cat_id) {
		$cat_name = get_the_category_by_ID($cat_id);
		$args = array(
				'cat' => $cat_id,
				'post_type' => 'fire_cases',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'meta_query' => array(
						array(
								'key' => 'top_cases',
								'value' => '1',
								'compare' => '==' )),
				'orderby' => 'comment_count date',
				'order' => 'DESC',
		);
		$query_popular = new WP_Query($args);
		if ($query_popular->have_posts()):
			?>
			<section class="wrapper grid popular-posts clearfix">
				<header>
					<div class="grid-content">
						<?php echo sprintf(__('Top %s', 'firecomps'), $cat_name); ?>
						<span><?php echo sprintf(__('Today\'s top %s from around the country', 'firecomps'), strtolower($cat_name)); ?></span>
						<a href="<?php if($cat_name == "Cases"){ echo "/top-cases"; } else { echo get_category_link($cat_id); } ?>" class="more"><?php echo sprintf(__('More %s', 'firecomps'), $cat_name); ?></a>
					</div>
				</header>
				<?php $i = 0; while ($query_popular->have_posts()): $query_popular->the_post(); ?>
					<?php if ($i == 0): ?>
						<div class="item grid-thumb">

							<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('390_home_img') ?>" alt="<?php the_title(); ?>" /></a>

							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<span class="categories-links"><?php echo $categories_list; ?></span>
							<?php endif; ?>
							<div class="item-text">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
							</div>
						</div>
						<div class="item grid-topic grid-topic-right">
							<div class="grid-content">
								<?php the_excerpt(); ?>
								<span class="arrow"></span>
							</div>
						</div>
					<?php else: ?>
						<div class="item grid-thumb">
							<?php $source_type = trim( get_post_meta( get_the_ID(), "390_home_img", true) );
							if( !empty( $source_type ) ) : // Checks if has image.   ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('390_home_img') ?>" alt="<?php the_title(); ?>" /></a>
							<?php  else : ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo @CURRENT_PROTOCOL; ?>placehold.it/390x390" alt="<?php the_title(); ?>" /></a>
							<?php endif; ?>
							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<span class="categories-links"><?php echo $categories_list; ?></span>
							<?php endif; ?>
							<div class="item-text">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
							</div>
						</div>
					<?php endif; ?>
					<?php $i++; endwhile; ?>
			</section>
		<?php
		endif;
	}
endif;



if (!function_exists('firecomps_get_top_posts_cases')):
	function firecomps_get_top_posts_cases() {

		$args = array(

				'post_type' => 'fire_cases',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'meta_query' => array(
						array(
								'key' => 'top_cases',
								'value' => '1',
								'compare' => '==' )),
				'orderby' => 'comment_count date',
				'order' => 'DESC',
		);
		$query_popular = new WP_Query($args);
		if ($query_popular->have_posts()):
			?>
			<section class="wrapper grid popular-posts clearfix">
				<header>
					<?php echo 'Top Cases' ?>
					<span><?php echo 'Today\'s top cases from around the country' ?></span>
					<a href="/top-cases/" class="more"><?php echo 'More Cases'; ?></a>
				</header>
				<?php $i = 0; while ($query_popular->have_posts()): $query_popular->the_post(); ?>
					<?php if ($i == 0): ?>
						<div class="item grid-thumb">
							<?php if (has_post_thumbnail()): ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php endif; ?>
							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<span class="categories-links"><?php echo $categories_list; ?></span>
							<?php endif; ?>
							<div class="item-text">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
							</div>
						</div>
						<div class="item grid-topic grid-topic-right">
							<?php the_excerpt(); ?>
							<span class="arrow"></span>
						</div>
					<?php else: ?>
						<div class="item grid-thumb">
							<?php if (has_post_thumbnail()): ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php endif; ?>
							<?php
							$categories_list = get_the_category_list( __( ', ', 'firecomps' ) );
							if ( $categories_list ):
								?>
								<span class="categories-links"><?php echo $categories_list; ?></span>
							<?php endif; ?>
							<div class="item-text">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<a href="<?php the_permalink(); ?>" class="more">Read More</a>
							</div>
						</div>
					<?php endif; ?>
					<?php $i++; endwhile; ?>
			</section>
		<?php
		endif;
	}
endif;



if (!function_exists('firecomps_walk_category')):
	function firecomps_walk_category($cat_id) {
		$cat_name = get_the_category_by_ID($cat_id);
		$args = array(
				'type' => 'post',
				'orderby' => 'id',
				'order' => 'asc',
				'hide_empty' => false,
				'parent' => $cat_id,
				'hierarchical' => false,
		);
		$categories = get_categories($args);
		$i = 0; foreach ($categories as $category): $category_classname = 'category-posts-' . ($i % 2 == 0 ? 'light' : 'dark');
			?>
			<section id="category-<?php echo $category->cat_ID; ?>" class="category-posts <?php echo $category_classname; ?>">
				<div class="wrapper clearfix">
					<header><?php echo $category->cat_name; ?></header>
					<?php
					$args = array(
							'cat' => $category->cat_ID,
							'post_type' => 'fire_cases',
							'post_status' => 'publish',
							'posts_per_page' => 4,
							'orderby' => 'date',
							'order' => 'DESC',

					);
					$query_category_posts = new WP_Query($args);
					if ($query_category_posts->have_posts()):
						?>
						<ul class="clearfix">
							<?php $j = 0; while ($query_category_posts->have_posts()): $query_category_posts->the_post(); ?>
								<li>
									<div class="item <?php echo ($j % 2 == 0 ? 'item-odd' : 'item-even'); ?>">
										<div class="thumbnail">


											<?php $source_type2 = trim( get_post_meta( get_the_ID(), "390_home_img", true) ); ?>
											<?php $source_type = trim( get_post_meta( get_the_ID(), "147_small_icons", true) );
											if( !empty( $source_type ) ) : // Checks if has image.   ?>
												<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('147_small_icons') ?>" alt="<?php the_title(); ?>" /></a>
											<?php  elseif( !empty( $source_type2 ) ) : // Checks if has image.   ?>
												<a href="<?php the_permalink(); ?>"><img src="<?php echo the_field('390_home_img') ?>" alt="<?php the_title(); ?>" /></a>
											<?php  else : ?>


												<a href="<?php the_permalink(); ?>"><img src="<?php echo @CURRENT_PROTOCOL; ?>placehold.it/147x147" alt="<?php the_title(); ?>" /></a>



											<?php endif; ?>






										</div>
										<div class="text">
											<span class="datetime"><?php echo get_the_date(); ?></span>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
									</div>
								</li>
								<?php $j++; endwhile; ?>
						</ul>
					<?php endif; ?>
					<footer><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo sprintf(__('See More %s', 'thefire'), $cat_name); ?></a></footer>
				</div>
			</section>
			<?php
			$i++; endforeach;
	}
endif;






if (!function_exists('firecomps_walk_category_cases')):
	function firecomps_walk_category_cases() {
		$cat_name = get_the_category_by_ID(530);
		$args = array(
				'cat' => 3,
				'post_type' => 'fire_cases',
				'orderby' => 'id',
				'order' => 'asc',
				'hide_empty' => false,
				'parent' => 530,
				'hierarchical' => false,
		);
		$categories = get_categories($args);
		$i = 0; foreach ($categories as $category): $category_classname = 'category-posts-' . ($i % 2 == 0 ? 'light' : 'dark');
			?>
			<section id="category-<?php echo $category->cat_ID; ?>" class="category-posts <?php echo $category_classname; ?>">
				<div class="wrapper clearfix">
					<header><?php echo $category->cat_name . ' ' . $cat_name; ?></header>
					<?php
					$args = array(
							'cat' => $category->cat_ID,
							'post_type' => 'fire_cases',
							'post_status' => 'publish',
							'posts_per_page' => 4,
							'orderby' => 'date',
							'order' => 'DESC',
					);
					$query_category_posts = new WP_Query($args);
					if ($query_category_posts->have_posts()):
						?>
						<ul class="clearfix">
							<?php $j = 0; while ($query_category_posts->have_posts()): $query_category_posts->the_post(); ?>
								<li>
									<div class="item <?php echo ($j % 2 == 0 ? 'item-odd' : 'item-even'); ?>">
										<div class="thumbnail">
											<?php if ( has_post_thumbnail() ) : ?>
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
											<?php endif; ?>
										</div>
										<div class="text">
											<span class="datetime"><?php echo get_the_date(); ?></span>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
									</div>
								</li>
								<?php $j++; endwhile; ?>
						</ul>
					<?php endif; ?>
					<footer><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo sprintf(__('See More %s', 'firecomps'), $cat_name); ?></a></footer>
				</div>
			</section>
			<?php
			$i++; endforeach;
	}
endif;

// Show posts of 'post', 'page' and 'movie' post types on home page

if (!function_exists('firecomps_get_sidebar_navigator')):
	function firecomps_get_sidebar_navigator($post_id) {
		global $wpdb;
		if (!is_page()) return;
		$post = get_post($post_id);
		$parent = array_reverse(get_post_ancestors($post_id));
		$first_parent = get_page($parent[0]);
		$parent_id = $first_parent->ID;
		if ($parent_id == 0) {
			$parent_id = $post_id;
		}
		$parent = get_post($parent_id);
		$parent_url = get_permalink($parent_id);
		$parent_name = $parent->post_title;

		$args = array(
				'post_parent' => $parent_id,
				'post_type' => 'page',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'menu_order ID',
				'order' => 'ASC',
				'meta_key' => 'sidebar_navigator',
				'meta_value' => '1',
				'meta_compare' => '=='
		);
		$query_sidebar_navigator = new WP_Query($args);

		if (!$query_sidebar_navigator->have_posts()) return;
		?>
	<aside id="parent-page-<?php echo $parent_id; ?>" class="widget widget_navigator">
		<h3><a href="<?php echo $parent_url; ?>"><?php echo $parent_name; ?></a></h3>
		<ul>
			<?php
			$i = 0; while ($query_sidebar_navigator->have_posts()): $query_sidebar_navigator->the_post();
				?>
				<li<?php if($i == 0) echo ' class="first"';?>><a href="<?php the_permalink(); ?>"<?php if (get_the_ID() == $post_id) echo ' class="current"'; ?>><?php the_title();?></a></li>
				<?php
				if(count(get_post_ancestors($post_id)) > 1) {
					$array = get_post_ancestors($post_id);
					$selector = $array[0];
				} else {
					$selector = $post_id;
				}

				$child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE (post_parent = ".$selector.") AND post_type = 'page' AND post_status = 'publish' ORDER BY menu_order", 'OBJECT');

				if ( $child_pages ) :
					foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild );
						$child_meta = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = ".$pageChild->ID." AND meta_key = 'sidebar_navigator'", ARRAY_A);

						if($child_meta['meta_value'] == 1 && get_the_ID() == $selector) {?>
							<li class="sub"><a href="<?php echo get_permalink($pageChild->ID); ?>"<?php if ($pageChild->ID == $post_id) echo ' class="current"'; ?>><?php echo $pageChild->post_title; ?></a></li><?php
						}
					endforeach;
				endif;


				$i++; endwhile;
			?></ul></aside><?php }
endif;

// filter user description for auto break
add_filter('the_author_description', 'lb_to_auth_desc');

function lb_to_auth_desc($content) {
	return nl2br($content);
}

function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
	return str_replace('<p', '<p class="excerpt"', $excerpt);
}
add_filter( 'posts_where', 'like_title', 10, 2 );
function like_title( $where, &$wp_query )
{
	global $wpdb;
	if ( $school_name = $wp_query->get( 'school_name' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $school_name ) ) . '%\'';
	}
	return $where;
}

add_filter('single_template', create_function(
				'$the_template',
				'foreach( (array) get_the_category() as $cat ) {
					if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
					return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
				return $the_template;' )
);



if (!function_exists('firecomps_get_school_data')):
	function firecomps_get_school_data($school_name, $school_state, $speech_code, $institution_type, $statement) {
		if ($school_name == '' && $school_state == '' && $speech_code == '' && $institution_type == '' && $statement == '') {
			return null;
		}
		global $speech_codes_reverse;
		$meta_query = array();
		$meta_query['relation'] = 'AND';

		if ($school_state != '') {
			$meta_query[] = array(
					'key' => 'state',
					'value' => $school_state,
					'compare' => '='
			);
		}
		if ($speech_code != '' && $speech_code != 'Not Yet Rated') {
			$meta_query[] = array(
					'key' => 'school_speech_code_rating',
					'value' => $speech_code,
					'compare' => '='
			);
		}
		if ($speech_code == 'Not Yet Rated') {
			$meta_query[] = array(
					'key' => 'school_speech_code_rating',
					'value' => '0',
					'compare' => '='
			);
		}

		if ($institution_type != '') {
			$meta_query[] = array(
					'key' => 'institution_type',
					'value' => $institution_type,
					'compare' => '='
			);
		}

		$args = array(
				'school_name' => $school_name,
				'post_type' => 'fire_schools',
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
				'meta_query' => $meta_query
		);
		$query_school = new WP_Query($args);
		$data = array();

		while ($query_school->have_posts()) {
			$query_school->the_post();
			$data[] = array(
					'name' => "<a href=\"" . get_permalink() . "\">" . get_the_title() . "</a>",
					'the_url' => "<a href=\"" . get_permalink() . "\">Read More </a>",
					'location' => get_field('city') . ', ' . get_field('state'),
					'website' => get_field('website_url'),
					'type' => get_field('institution_type'),
					'federal_circuit' => get_field('federal_circuit'),
					'speech_code' => $speech_codes_reverse[get_field('school_speech_code_rating')]
			);
			// $custom = get_post_custom(get_the_ID());
			// foreach ($custom as $k => $v) if (in_array($k, array('location', 'website', 'type', 'federal_circuit'))) $data[$k] = $v[0];
		}
		// if ($query_school->have_posts()): $query_school->the_post();
		// endif;
		if (count($data) == 0) {
			return null;
		} else {
			return $data;
		}
	}
endif;

if (!function_exists('firecomps_ajax')):
	function firecomps_ajax() {
		global $state_abbreviations;
		$supported_actions = array('get_schools', 'get_states', 'get_states_short');
		$action = isset($_GET['_action']) ? trim($_GET['_action']) : 'get_schools';
		if (!in_array($action, $supported_actions)) $action = 'get_schools';

		$data = array(); $args = array();
		switch($action) {
			case 'get_schools':
				$args = array(
						'post_type' => 'fire_schools',
						'post_status' => 'publish',
						'posts_per_page' => -1
				);
				break;
			case 'get_states':
			case 'get_states_short':
				$args = array(
						'post_type' => 'fire_schools',
						'post_status' => 'publish',
						'posts_per_page' => -1
				);
				break;
		}
		if ($args) {
			$query_school = new WP_Query($args);
			while ($query_school->have_posts()) {
				$query_school->the_post();
				switch($action) {
					case 'get_states_short': {
						$state = ucwords(strtolower(get_field('state')));
						if ($state) {
							if (array_key_exists($state, $state_abbreviations)) {
								$state_abbreviation = $state_abbreviations[$state];
								if (!in_array($state_abbreviation, $data)) {
									$data[] = $state_abbreviation;
								}
							}
						}
						break;
					}
					case 'get_states': {
						$state = ucwords(strtolower(get_field('state')));
						if ($state) {
							if (!in_array($state, $data)) {
								$data[] = $state;
							}
						}
						break;
					}
				}
			}
			sort($data);
		}
		die(json_encode($data));
	}
endif;

/**
 * Add new media size for school logos
 */

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'school-logo', 200, 200 );
	add_image_size( 'featured-video-thumb', 390, 390 );
}

/**
 * SSL redirect for donate page
 */
function fire_ssl_redirect() {
	$secure_pages = array( 110910,15 );
	$secure_query = new WP_Query();
	$all_wp_pages = $secure_query->query(array('post_type' => 'page'));
	//Get all child pages of the donate page
	//$donate_child_pages = get_page_children( 110910, $all_wp_pages );
    $donate_child_pages = get_pages(array(
        'child_of' => 110910 //Donate parent page
    ));

	//Add donate child pages to $secure_pages array
	foreach ( $donate_child_pages as $donate_child ) {
		array_push( $secure_pages, $donate_child->ID );
	}

	if(!is_404()){
		if ( ( !is_page( $secure_pages ) && is_ssl() ) ) {
			if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
				wp_redirect(preg_replace('|^https://|', 'http://', $_SERVER['REQUEST_URI']), 302 );
				exit;
			} else {
				wp_redirect('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 302 );
				exit;
			}
		}
	}
}
// add_action( 'template_redirect', 'fire_ssl_redirect' );

function no_redirect_guess_404_permalink( $header ){
	global $wp_query;

	if( is_404() )
		unset( $wp_query->query_vars['name'] );

	return $header;
}

//add_filter( 'status_header', 'no_redirect_guess_404_permalink' );


/**
 * Redirect broken attachment links to 404
 */

function fire_404_broken_links() {
	global $wp_query;

	if(is_attachment()){
		//$attachment_path = get_attached_file( get_the_ID() );
		$attachment_path = wp_get_attachment_url( get_the_ID() );

		$handle = curl_init( $attachment_path );
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		//If the file doesn't exist on the server show 404
		if($httpCode == 404) {
			$wp_query->set_404();
			status_header( 404 );
			get_template_part( 404 );
			exit();
		}

		curl_close($handle);

		//If the file doesn't exist on the server show 404
		/*if(!file_exists($attachment_path)){
			$wp_query->set_404();
			status_header( 404 );
			get_template_part( 404 );
			exit();
		}*/
	}

}

add_action('template_redirect', 'fire_404_broken_links');


//add shortcodes for video

function add_iframe_function($atts) {

	return '<div class="video"><iframe src="' . $atts['src'] . '"></iframe></div>';

}

function register_shortcodes() {
	add_shortcode('iframe', 'add_iframe_function');
}

add_action('init', 'register_shortcodes');


// Only load Posts with the Torch Category

add_action('pre_get_posts', 'torch_feed_cat');
function torch_feed_cat( $query ) {
	if( is_feed() ) $query->set('category_name', 'torch');
}

// Redirect one search result

add_action('template_redirect', 'redirect_single_post');
function redirect_single_post() {
    if (is_search()) {
        global $wp_query;
        if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
            exit;
        }
    }
}

function improved_trim_excerpt($text) {
    global $post;
    if ( !empty($text) ) {
            $text = apply_filters('the_content', $text);
            $text = str_replace('\]\]\>', ']]&gt;', $text);
            $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
            $text = strip_tags($text, '<a><img><p>');
            $excerpt_length = 100;
            $words = explode(' ', $text, $excerpt_length + 1);
            if (count($words)> $excerpt_length) {
                    array_pop($words);
                    array_push($words, '[...]');
                    $text = implode(' ', $words);
            }
    }
    return $text;
}

function ww_my_excerpt() {

	/**
	 * Filter the displayed post excerpt.
	 *
	 * @since 0.71
	 *
	 * @see get_the_excerpt()
	 *
	 * @param string $post_excerpt The post excerpt.
	 */
	echo improved_trim_excerpt( get_the_content() );
}


// Creating option page

add_action('admin_menu', 'register_school_downloads');

function register_school_downloads() {
	add_submenu_page( 'edit.php?post_type=fire_schools', 'School Downloads', 'School Downloads', 'manage_options', 'school-downloads', 'school_downloads_callback' );
}

function school_downloads_callback() { ?>

	<div class="wrap"><div id="icon-tools" class="icon32"></div>
		<h2>School Downloads</h2>
		<p>Download school reports CSV.  Fields include: ID, School Title, State, Rating, Federal Circuit, Institution Type.</p>
	</div>

	<form action="<?php echo get_template_directory_uri() . '/schools.php'?>" method="post">
		 <table class="form-table">
	        <tr>
	            <td>
	               <label style="padding-right: 10px;">Discard Drafts</label>
	               <input type="checkbox" name="discard_drafts" value="Discard Drafts" />
	            </td>
	        </tr>
	         <tr>
	            <td>
	               <label style="padding-right: 10px;">Exclude Fire-Only Cases</label>
	               <input type="checkbox" name="exclude_category" value="Exclude Fire-Only Cases" />
	            </td>
	        </tr>
	        <tr>
	            <td>
	               <input type="submit" class="button primary-button" value="Download" />
	            </td>
	        </tr>
	    </table>
	</form>
<?php } ?>