<?php

/***** Fetch Options *****/

$houston_uasi_options = get_option('houston_uasi_options');

/***** Custom Hooks *****/

function houston_uasi_before_page_content() {
    do_action('houston_uasi_before_page_content');
}

function houston_uasi_before_post_content() {
    do_action('houston_uasi_before_post_content');
}

/***** Theme Setup *****/

if (!function_exists('houston_uasi_theme_setup')) {
	function houston_uasi_theme_setup() {
		load_theme_textdomain('houston-uasi', get_template_directory() . '/languages');
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
add_action('after_setup_theme', 'houston_uasi_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('houston_uasi_custom_menus')) {
	function houston_uasi_custom_menus() {
		register_nav_menus(array(
			'header_nav' => esc_html__('Header Navigation', 'houston-uasi'),
			'social_nav' => esc_html__('Social Icons', 'houston-uasi'),
			'main_nav' => esc_html__('Main Navigation', 'houston-uasi'),
			'footer_nav' => esc_html__('Footer Navigation', 'houston-uasi')
		));
	}
}
add_action('after_setup_theme', 'houston_uasi_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('houston_uasi_image_sizes')) {
	function houston_uasi_image_sizes() {
		add_image_size('content-single', 777, 437, true);
		add_image_size('content-grid', 180, 101, true);
		add_image_size('content-list', 260, 146, true);
		add_image_size('cp-thumb-xl', 373, 210, true);
		add_image_size('cp-thumb-small', 120, 67, true);
	}
}
add_action('after_setup_theme', 'houston_uasi_image_sizes');

/***** Set Content Width *****/

if (!function_exists('houston_uasi_content_width')) {
	function houston_uasi_content_width() {
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
add_action('template_redirect', 'houston_uasi_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('houston_uasi_scripts')) {
	function houston_uasi_scripts() {
		wp_enqueue_style('houston-style', get_stylesheet_uri(), false, '1.4.0');
		wp_enqueue_style('houston-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('houston-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'houston_uasi_scripts');

if (!function_exists('houston_uasi_admin_scripts')) {
	function houston_uasi_admin_scripts($hook) {
		if ('appearance_page_newsdesk' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('houston-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'houston_uasi_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('houston_uasi_widgets_init')) {
	function houston_uasi_widgets_init() {
		register_sidebar(array('name' => __('Global Sidebar', 'houston-uasi'), 'id' => 'sidebar', 'description' => __('Sidebar used globally throughout your site.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 1 - Large Column (Top)', 'houston-uasi'), 'id' => 'home-1', 'description' => __('Large column on Homepage.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 2 - First Column', 'houston-uasi'), 'id' => 'home-2', 'description' => __('First column on Homepage.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 3 - Second Column', 'houston-uasi'), 'id' => 'home-3', 'description' => __('Second column on Homepage.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 4 - Large Column (Bottom)', 'houston-uasi'), 'id' => 'home-4', 'description' => __('Large column on Homepage.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 5 - Sidebar', 'houston-uasi'), 'id' => 'home-5', 'description' => __('Sidebar on Homepage.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Header Advertisement', 'houston-uasi'), 'id' => 'header-ad', 'description' => __('728*90 advertisement spot in the header.', 'houston-uasi'), 'before_widget' => '<aside id="%1$s" class="houston-col houston-2-3 %2$s"><div class="header-ad">', 'after_widget' => '</div></aside>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Top)', 'houston-uasi'), 'id' => 'post-ad-1', 'description' => __('728*90 advertisement spot above your post text.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Post Advertisement (Bottom)', 'houston-uasi'), 'id' => 'post-ad-2', 'description' => __('728*90 advertisement spot underneath your post text.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget post-ad post-ad-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer Advertisement', 'houston-uasi'), 'id' => 'footer-ad', 'description' => __('728*90 advertisement spot in the footer.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="footer-ad-wrap %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Footer 1 - First Column', 'houston-uasi'), 'id' => 'footer-1', 'description' => __('First column widget area in the footer.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 2 - Second Column', 'houston-uasi'), 'id' => 'footer-2', 'description' => __('Second column widget area in the footer.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Footer 3 - Third Column', 'houston-uasi'), 'id' => 'footer-3', 'description' => __('Third column widget area in the footer.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5 class="widget-title">', 'after_title' => '</h5>'));
		register_sidebar(array('name' => __('Contact', 'houston-uasi'), 'id' => 'contact', 'description' => __('Sidebar on contact template.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget clearfix %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));

		// column layout widget area
		register_sidebar(array('name' => __('Column Layout Widget - First Area', 'houston-uasi'), 'id' => 'col-lay-1', 'description' => __('Widget area for 1st column, change setting on Customizer > Column Widget Settings', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Column Layout Widget - Second Area', 'houston-uasi'), 'id' => 'col-lay-2', 'description' => __('Widget area for 2nd column, change setting on Customizer > Column Widget Settings', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Column Layout Widget - Third Area', 'houston-uasi'), 'id' => 'col-lay-3', 'description' => __('Widget area for 3rd column, change setting on Customizer > Column Widget Settings', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));

		// widget for template 5 column layout
		register_sidebar(array('name' => __('Template 5.1 - Large Column (Top)', 'houston-uasi'), 'id' => 'template-51', 'description' => __('Large Column (Top) on 5 Column layout.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Template 5.2 - First Column', 'houston-uasi'), 'id' => 'template-52', 'description' => __('First Column on 5 Column layout.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Template 5.3 - Second Column', 'houston-uasi'), 'id' => 'template-53', 'description' => __('Second Column on 5 Column layout.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Template 5.4 - Large Column (Bottom)', 'houston-uasi'), 'id' => 'template-54', 'description' => __('Large Column (Bottom) on 5 Column layout.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Template 5.5 - Sidebar', 'houston-uasi'), 'id' => 'template-55', 'description' => __('Sidebar on 5 Column layout.', 'houston-uasi'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
	}
}
add_action('widgets_init', 'houston_uasi_widgets_init');

/***** Include Several Functions *****/

require_once('includes/houston-options.php');
require_once('includes/houston-breadcrumb.php');
require_once('includes/houston-custom-functions.php');
require_once('includes/houston-widgets.php');
require_once('includes/houston-google-webfonts.php');
require_once('includes/houston-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

/**
 * Customizer to add Google Analytic Code
 */

if(!function_exists('houston_uasi_custom_customizer')):
	function houston_uasi_custom_customizer($wp_customize){
		$wp_customize->add_section('add_ga_id',array(
        'title' => __('Google Analytic','houston-uasi'),
        'priority' => 30
    ));

    $wp_customize->add_setting('houston_uasi_field_ga_analytic_id');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'houston_uasi_field_ga_analytic_id',
        array(
            'label'      	=> __( 'Google Analytic Field', 'houston-uasi' ),
            'description' 	=> __('This is to adding Google Analytic code to theme.<br /> Example: <b>UA-84821720-1</b>','houston-uasi'),
            'section'   	=> 'add_ga_id',
            'settings'   	=> 'houston_uasi_field_ga_analytic_id',
            'type'       	=> 'text',
        ) )
    );


		// column template
		$wp_customize->add_panel('add_column_template_id',array(
		    'title' => __('Column Widget Settings','houston-uasi'),
		    'priority' => 30,
		    'capability' => 'edit_theme_options', 'theme_supports' => ''
		));
		// TRI COLUMN LAYOUT
		$wp_customize->add_section('mh_tri_col', array('title' => esc_html__('3 Column Layout', 'houston-uasi'), 'priority' => 1, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('huasi_column_layout_3[tri_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_1',
		    array(
		        'label'       => __( 'First Column', 'houston-uasi' ),
		        'description' => __('Default setting is page content','houston-uasi'),
		        'section'     => 'mh_tri_col',
		        'settings'    => 'huasi_column_layout_3[tri_col_1]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'houston-uasi'),
		          'page_content' => esc_html__('page content', 'houston-uasi'),
		        )
		    ) )
		);
		$wp_customize->add_setting('huasi_column_layout_3[tri_col_2]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_2',
		    array(
		        'label'      	=> __( 'Second Column', 'houston-uasi' ),
		        'description' => __('Default setting is widget area','houston-uasi'),
		        'section'   	=> 'mh_tri_col',
		        'settings'   	=> 'huasi_column_layout_3[tri_col_2]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'houston-uasi'),
		          'page_content' => esc_html__('page content', 'houston-uasi'),
		        )
		    ) )
		);
		$wp_customize->add_setting('huasi_column_layout_3[tri_col_3]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'tri_col_3',
		    array(
		        'label'       => __( 'Third columns', 'houston-uasi' ),
		        'description' => __('Default setting is global widget','houston-uasi'),
		        'section'     => 'mh_tri_col',
		        'settings'    => 'huasi_column_layout_3[tri_col_3]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'houston-uasi'),
		          'global_widget' => esc_html__('global widget', 'houston-uasi'),
		        )
		    ) )
		);

		// TWO COLUMN LAYOUT
		$wp_customize->add_section('mh_two_col', array('title' => esc_html__('2 Column Layout', 'houston-uasi'), 'priority' => 2, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('huasi_column_layout_2[two_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'two_col_1',
		    array(
		        'label'       => __( 'Page Content Position', 'houston-uasi' ),
		        'description' => __('Default setting page content above widget area','houston-uasi'),
		        'section'     => 'mh_two_col',
		        'settings'    => 'huasi_column_layout_2[two_col_1]',
		        'type'        => 'select',
		        'choices' => array(
							'above' => esc_html__('above widget area', 'houston-uasi'),
							'below' => esc_html__('below widget area', 'houston-uasi'),
		        )
		    ) )
		);
		$wp_customize->add_setting('huasi_column_layout_2[two_col_3]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'two_col_3',
		    array(
		        'label'       => __( 'Second Column', 'houston-uasi' ),
		        'description' => __('Default setting is global widget','houston-uasi'),
		        'section'     => 'mh_two_col',
		        'settings'    => 'huasi_column_layout_2[two_col_3]',
		        'type'        => 'select',
		        'choices' => array(
		          'widget_area' => esc_html__('widget area', 'houston-uasi'),
		          'global_widget' => esc_html__('global widget', 'houston-uasi'),
		        )
		    ) )
		);


		// ONE COLUMN LAYOUT
		$wp_customize->add_section('mh_one_col', array('title' => esc_html__('Single Column Layout', 'houston-uasi'), 'priority' => 2, 'panel' => 'add_column_template_id'));
		$wp_customize->add_setting('huasi_column_layout_1[one_col_1]');
		$wp_customize->add_control(
		    new WP_Customize_Control(
		    $wp_customize,
		    'one_col_1',
		    array(
		        'label'       => __( 'Page Content Position', 'houston-uasi' ),
		        'description' => __('Default setting page content above widget area','houston-uasi'),
		        'section'     => 'mh_one_col',
		        'settings'    => 'huasi_column_layout_1[one_col_1]',
		        'type'        => 'select',
		        'choices' => array(
		          'above' => esc_html__('above widget area', 'houston-uasi'),
		          'below' => esc_html__('below widget area', 'houston-uasi'),
		        )
		    ) )
		);
	}
	add_action( 'customize_register', 'houston_uasi_custom_customizer' );
endif;

if(!function_exists('houston_uasi_add_js_ga_analytic')):
function houston_uasi_add_js_ga_analytic() {
    $ga_id = get_theme_mod( 'houston_uasi_field_ga_analytic_id' );

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
add_action( 'wp_head', 'houston_uasi_add_js_ga_analytic' );
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

?>
