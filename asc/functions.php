<?php

/***** Fetch Options *****/

$asc_options = get_option('asc_options');

/***** Custom Hooks *****/

function asc_before_page_content() {
    do_action('asc_before_page_content');
}

function asc_before_post_content() {
    do_action('asc_before_post_content');
}

/***** Theme Setup *****/

if (!function_exists('asc_theme_setup')) {
	function asc_theme_setup() {
		load_theme_textdomain('asc', get_template_directory() . '/languages');
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
add_action('after_setup_theme', 'asc_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('asc_custom_menus')) {
	function asc_custom_menus() {
		register_nav_menus(array(
			'header_nav' => esc_html__('Header Navigation', 'asc'),
			'social_nav' => esc_html__('Social Icons', 'asc'),
			'main_nav' => esc_html__('Main Navigation', 'asc'),
			'footer_nav' => esc_html__('Footer Navigation', 'asc')
		));
	}
}
add_action('after_setup_theme', 'asc_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('asc_image_sizes')) {
	function asc_image_sizes() {
		add_image_size('content-single', 777, 437, true);
		add_image_size('content-grid', 180, 101, true);
		add_image_size('content-list', 260, 146, true);
		add_image_size('cp-thumb-xl', 373, 210, true);
		add_image_size('cp-thumb-small', 120, 67, true);
	}
}
add_action('after_setup_theme', 'asc_image_sizes');

/***** Set Content Width *****/

if (!function_exists('asc_content_width')) {
	function asc_content_width() {
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
add_action('template_redirect', 'asc_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('asc_scripts')) {
	function asc_scripts() {
		wp_enqueue_style('asc-style', get_stylesheet_uri(), false, '1.4.0');
		wp_enqueue_style('asc-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('asc-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'asc_scripts');

if (!function_exists('asc_admin_scripts')) {
	function asc_admin_scripts($hook) {
		if ('appearance_page_newsdesk' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('asc-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'asc_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('asc_widgets_init')) {
	function asc_widgets_init() {
		register_sidebar(array('name' => __('Global Sidebar', 'asc'), 'id' => 'sidebar', 'description' => __('Sidebar used globally throughout your site.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 1 - Large Column (Top)', 'asc'), 'id' => 'home-1', 'description' => __('Large column on Homepage.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 2 - First Column', 'asc'), 'id' => 'home-2', 'description' => __('First column on Homepage.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 3 - Second Column', 'asc'), 'id' => 'home-3', 'description' => __('Second column on Homepage.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 4 - Large Column (Bottom)', 'asc'), 'id' => 'home-4', 'description' => __('Large column on Homepage.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 5 - Sidebar', 'asc'), 'id' => 'home-5', 'description' => __('Sidebar on Homepage.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Header Advertisement', 'asc'), 'id' => 'header-ad', 'description' => __('728*90 advertisement spot in the header.', 'asc'), 'before_widget' => '<aside id="%1$s" class="asc-col asc-2-3 %2$s"><div class="header-ad">', 'after_widget' => '</div></aside>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Top)', 'asc'), 'id' => 'post-ad-1', 'description' => __('728*90 advertisement spot above your post text.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Bottom)', 'asc'), 'id' => 'post-ad-2', 'description' => __('728*90 advertisement spot underneath your post text.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer Advertisement', 'asc'), 'id' => 'footer-ad', 'description' => __('728*90 advertisement spot in the footer.', 'asc'), 'before_widget' => '<div id="%1$s" class="footer-ad-wrap %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer 1 - First Column', 'asc'), 'id' => 'footer-1', 'description' => __('First column widget area in the footer.', 'asc'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 2 - Second Column', 'asc'), 'id' => 'footer-2', 'description' => __('Second column widget area in the footer.', 'asc'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 3 - Third Column', 'asc'), 'id' => 'footer-3', 'description' => __('Third column widget area in the footer.', 'asc'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Contact', 'asc'), 'id' => 'contact', 'description' => __('Sidebar on contact template.', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));

		// column layout widget area
		register_sidebar(array('name' => __('Column Layout Widget - First Area', 'asc'), 'id' => 'col-lay-1', 'description' => __('Widget area for 1st column, change setting on Customizer > Column Widget Settings', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Column Layout Widget - Second Area', 'asc'), 'id' => 'col-lay-2', 'description' => __('Widget area for 2nd column, change setting on Customizer > Column Widget Settings', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Column Layout Widget - Third Area', 'asc'), 'id' => 'col-lay-3', 'description' => __('Widget area for 3rd column, change setting on Customizer > Column Widget Settings', 'asc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
	}
}
add_action('widgets_init', 'asc_widgets_init');

/***** Include Several Functions *****/

require_once('includes/asc-options.php');
require_once('includes/asc-breadcrumb.php');
require_once('includes/asc-custom-functions.php');
require_once('includes/asc-widgets.php');
require_once('includes/asc-google-webfonts.php');
require_once('includes/asc-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

/**
 * Customizer to add Google Analytic Code
 */

if(!function_exists('asc_custom_customizer')):
	function asc_custom_customizer($wp_customize){
		$wp_customize->add_section('add_ga_id',array(
        'title' => __('Google Analytic','asc'),
        'priority' => 30
    ));

    $wp_customize->add_setting('asc_field_ga_analytic_id');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'asc_field_ga_analytic_id',
        array(
            'label'      	=> __( 'Google Analytic Field', 'asc' ),
            'description' 	=> __('This is to adding Google Analytic code to theme.<br /> Example: <b>UA-84821720-1</b>','asc'),
            'section'   	=> 'add_ga_id',
            'settings'   	=> 'asc_field_ga_analytic_id',
            'type'       	=> 'text',
        ) )
    );


		// column template
		$wp_customize->add_panel('add_column_template_id',array(
		    'title' => __('Column Widget Settings','asc'),
		    'priority' => 30,
		    'capability' => 'edit_theme_options', 'theme_supports' => ''
		));
		// TRI COLUMN LAYOUT
		$wp_customize->add_section('mh_tri_col', array('title' => esc_html__('3 Column Layout', 'asc'), 'priority' => 1, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('asc_column_layout_3[tri_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_1',
		    array(
		        'label'       => __( 'First Column', 'asc' ),
		        'description' => __('Default setting is page content','asc'),
		        'section'     => 'mh_tri_col',
		        'settings'    => 'asc_column_layout_3[tri_col_1]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'asc'),
		          'page_content' => esc_html__('page content', 'asc'),
		        )
		    ) )
		);
		$wp_customize->add_setting('asc_column_layout_3[tri_col_2]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_2',
		    array(
		        'label'      	=> __( 'Second Column', 'asc' ),
		        'description' => __('Default setting is widget area','asc'),
		        'section'   	=> 'mh_tri_col',
		        'settings'   	=> 'asc_column_layout_3[tri_col_2]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'asc'),
		          'page_content' => esc_html__('page content', 'asc'),
		        )
		    ) )
		);
		$wp_customize->add_setting('asc_column_layout_3[tri_col_3]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_3',
		    array(
		        'label'       => __( 'Third columns', 'asc' ),
		        'description' => __('Default setting is global widget','asc'),
		        'section'     => 'mh_tri_col',
		        'settings'    => 'asc_column_layout_3[tri_col_3]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'asc'),
		          'global_widget' => esc_html__('global widget', 'asc'),
		        )
		    ) )
		);

		// TWO COLUMN LAYOUT
		$wp_customize->add_section('mh_two_col', array('title' => esc_html__('2 Column Layout', 'asc'), 'priority' => 2, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('asc_column_layout_2[two_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'two_col_1',
		    array(
		        'label'       => __( 'Page Content Position', 'asc' ),
		        'description' => __('Default setting page content above widget area','asc'),
		        'section'     => 'mh_two_col',
		        'settings'    => 'asc_column_layout_2[two_col_1]',
		        'type'        => 'select',
		        'choices' => array(
							'above' => esc_html__('above widget area', 'asc'),
							'below' => esc_html__('below widget area', 'asc'),
		        )
		    ) )
		);
		$wp_customize->add_setting('asc_column_layout_2[two_col_3]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'two_col_3',
		    array(
		        'label'       => __( 'Second Column', 'asc' ),
		        'description' => __('Default setting is global widget','asc'),
		        'section'     => 'mh_two_col',
		        'settings'    => 'asc_column_layout_2[two_col_3]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'asc'),
		          'global_widget' => esc_html__('global widget', 'asc'),
		        )
		    ) )
		);


		// ONE COLUMN LAYOUT
		$wp_customize->add_section('mh_one_col', array('title' => esc_html__('Single Column Layout', 'asc'), 'priority' => 2, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('asc_column_layout_1[one_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'one_col_1',
		    array(
		        'label'       => __( 'Page Content Position', 'asc' ),
		        'description' => __('Default setting page content above widget area','asc'),
		        'section'     => 'mh_one_col',
		        'settings'    => 'asc_column_layout_1[one_col_1]',
		        'type'        => 'select',
		        'choices' => array(
		          'above' => esc_html__('above widget area', 'asc'),
		          'below' => esc_html__('below widget area', 'asc'),
		        )
		    ) )
		);
	}
	add_action( 'customize_register', 'asc_custom_customizer' );
endif;

if(!function_exists('asc_add_js_ga_analytic')):
function asc_add_js_ga_analytic() {
    $ga_id = get_theme_mod( 'asc_field_ga_analytic_id' );

    if ( $ga_id != '' ) :
    ?>

       	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  <?php echo "ga('create', '".$ga_id."', 'auto');"."\n" ?>
		  ga('send', 'pageview');

		</script>
    <?php
    endif;
}
add_action( 'wp_head', 'asc_add_js_ga_analytic' );
endif;

function set_style_body(){
	if(is_admin_bar_showing()):
?>
	<style type="text/css">
		body {
			margin-top: 18px;
		}
		@media screen and (max-width: 782px){
			body {
				margin-top: 4px;
			}
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'set_style_body' );

function asc_get_full_content_rss()
{
	remove_shortcode('gravityform');
	remove_shortcode('gravityforms');
	$text = apply_filters('the_content', get_the_content());
	add_shortcode( 'gravityform', array( 'RGForms', 'parse_shortcode' ) );
	add_shortcode( 'gravityforms', array( 'RGForms', 'parse_shortcode' ) );
	return preg_replace('/(\[gravityforms? .*\])/', '', $text);
}
add_filter('the_excerpt_rss', 'asc_get_full_content_rss');
?>
