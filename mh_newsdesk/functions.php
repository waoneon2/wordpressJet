<?php

/***** Fetch Options *****/

$mh_newsdesk_options = get_option('mh_newsdesk_options');

/***** Custom Hooks *****/

function mh_newsdesk_before_page_content() {
    do_action('mh_newsdesk_before_page_content');
}

function mh_newsdesk_before_post_content() {
    do_action('mh_newsdesk_before_post_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_newsdesk_theme_setup')) {
	function mh_newsdesk_theme_setup() {
		load_theme_textdomain('mh-newsdesk', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
		add_post_type_support('page', 'excerpt');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array('search-form'));
		add_theme_support('custom-background', array('default-color' => 'efefef'));
		add_theme_support('post-thumbnails');
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '1f1e1e', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_newsdesk_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_newsdesk_custom_menus')) {
	function mh_newsdesk_custom_menus() {
		register_nav_menus(array(
			'header_nav' => esc_html__('Header Navigation', 'mh-newsdesk'),
			'social_nav' => esc_html__('Social Icons', 'mh-newsdesk'),
			'main_nav' => esc_html__('Main Navigation', 'mh-newsdesk'),
			'footer_nav' => esc_html__('Footer Navigation', 'mh-newsdesk')
		));
	}
}
add_action('after_setup_theme', 'mh_newsdesk_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_newsdesk_image_sizes')) {
	function mh_newsdesk_image_sizes() {
		add_image_size('content-single', 777, 437, true);
		add_image_size('content-grid', 180, 101, true);
		add_image_size('content-list', 260, 146, true);
		add_image_size('cp-thumb-xl', 373, 210, true);
		add_image_size('cp-thumb-small', 120, 67, true);
	}
}
add_action('after_setup_theme', 'mh_newsdesk_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_newsdesk_content_width')) {
	function mh_newsdesk_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('template-full.php')) {
				$content_width = 1180;
			} else {
				$content_width = 777;
			}
		}
	}
}
add_action('template_redirect', 'mh_newsdesk_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_newsdesk_scripts')) {
	function mh_newsdesk_scripts() {
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '1.4.0');
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_newsdesk_scripts');

if (!function_exists('mh_newsdesk_admin_scripts')) {
	function mh_newsdesk_admin_scripts($hook) {
		if ('appearance_page_newsdesk' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_newsdesk_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_newsdesk_widgets_init')) {
	function mh_newsdesk_widgets_init() {
		register_sidebar(array('name' => __('Global Sidebar', 'mh-newsdesk'), 'id' => 'sidebar', 'description' => __('Sidebar used globally throughout your site.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 1 - Large Column (Top)', 'mh-newsdesk'), 'id' => 'home-1', 'description' => __('Large column on Homepage.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 2 - First Column', 'mh-newsdesk'), 'id' => 'home-2', 'description' => __('First column on Homepage.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 3 - Second Column', 'mh-newsdesk'), 'id' => 'home-3', 'description' => __('Second column on Homepage.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 4 - Large Column (Bottom)', 'mh-newsdesk'), 'id' => 'home-4', 'description' => __('Large column on Homepage.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 5 - Sidebar', 'mh-newsdesk'), 'id' => 'home-5', 'description' => __('Sidebar on Homepage.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Header Advertisement', 'mh-newsdesk'), 'id' => 'header-ad', 'description' => __('728*90 advertisement spot in the header.', 'mh-newsdesk'), 'before_widget' => '<aside id="%1$s" class="mh-col mh-2-3 %2$s"><div class="header-ad">', 'after_widget' => '</div></aside>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Top)', 'mh-newsdesk'), 'id' => 'post-ad-1', 'description' => __('728*90 advertisement spot above your post text.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Bottom)', 'mh-newsdesk'), 'id' => 'post-ad-2', 'description' => __('728*90 advertisement spot underneath your post text.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer Advertisement', 'mh-newsdesk'), 'id' => 'footer-ad', 'description' => __('728*90 advertisement spot in the footer.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="footer-ad-wrap %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer 1 - First Column', 'mh-newsdesk'), 'id' => 'footer-1', 'description' => __('First column widget area in the footer.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 2 - Second Column', 'mh-newsdesk'), 'id' => 'footer-2', 'description' => __('Second column widget area in the footer.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 3 - Third Column', 'mh-newsdesk'), 'id' => 'footer-3', 'description' => __('Third column widget area in the footer.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Contact', 'mh-newsdesk'), 'id' => 'contact', 'description' => __('Sidebar on contact template.', 'mh-newsdesk'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
	}
}
add_action('widgets_init', 'mh_newsdesk_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-options.php');
require_once('includes/mh-breadcrumb.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

?>