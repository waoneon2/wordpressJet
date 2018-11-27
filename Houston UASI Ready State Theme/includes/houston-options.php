<?php

function houston_uasi_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'houston-uasi'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General', 'houston-uasi'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => esc_html__('Layout', 'houston-uasi'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_ticker', array('title' => esc_html__('News Ticker', 'houston-uasi'), 'priority' => 4, 'panel' => 'mh_theme_options'));

    $wp_customize->add_section('mh_set_max_width_layout', array('title' => esc_html__('Set Max Width of Layout', 'houston-uasi'), 'priority' => 5, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_logo_image', array('title' => esc_html__('Logo Image', 'houston-uasi'), 'priority' => 6, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_set_header_background_image', array('title' => esc_html__('Header Background Image', 'houston-uasi'), 'priority' => 6, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('houston_uasi_options[excerpt_length]', array('default' => 25, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_integer'));
    $wp_customize->add_setting('houston_uasi_options[excerpt_more]', array('default' => esc_html__('Read More', 'houston-uasi'), 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_text'));
	$wp_customize->add_setting('houston_uasi_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_text'));

    $wp_customize->add_setting('houston_uasi_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[tags]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[featured_image_placeholder]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
	$wp_customize->add_setting('houston_uasi_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
    $wp_customize->add_setting('houston_uasi_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
	$wp_customize->add_setting('houston_uasi_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
	$wp_customize->add_setting('houston_uasi_options[archives]', array('default' => 'layout1', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_select'));
	$wp_customize->add_setting('houston_uasi_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('houston_uasi_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_checkbox'));
    $wp_customize->add_setting('houston_uasi_options[post_meta_author]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_checkbox'));
    $wp_customize->add_setting('houston_uasi_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_checkbox'));

    $wp_customize->add_setting('houston_uasi_options[show_ticker]', array('default' => 1, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_checkbox'));
    $wp_customize->add_setting('houston_uasi_options[ticker_title]', array('default' => esc_html__('Hot Topics', 'houston-uasi'), 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_text'));
    $wp_customize->add_setting('houston_uasi_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_integer'));
    $wp_customize->add_setting('houston_uasi_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_text'));
    $wp_customize->add_setting('houston_uasi_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_text'));
    $wp_customize->add_setting('houston_uasi_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_integer'));
    $wp_customize->add_setting('houston_uasi_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_checkbox'));

	$wp_customize->add_setting('houston_uasi_options[color_1]', array('default' => '#005a8c', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('houston_uasi_options[color_2]', array('default' => '#ccdee8', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('houston_uasi_options[color_3]', array('default' => '#1f1e1e', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('houston_uasi_options[color_4]', array('default' => '#333333', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('houston_uasi_options[color_5]', array('default' => '#464646', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('houston_uasi_options[color_6]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    $wp_customize->add_setting('houston_uasi_options[max_width_layout]', array('default' => 1180, 'type' => 'option', 'sanitize_callback' => 'houston_uasi_sanitize_integer'));
    $wp_customize->add_setting('img_back_opt', array('default' => 0));
    $wp_customize->add_setting('img_back');
    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'houston-uasi'), 'section' => 'mh_general', 'settings' => 'houston_uasi_options[excerpt_length]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'houston-uasi'), 'section' => 'mh_general', 'settings' => 'houston_uasi_options[excerpt_more]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'houston-uasi'), 'section' => 'mh_general', 'settings' => 'houston_uasi_options[copyright]', 'priority' => 4, 'type' => 'text'));

    $wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[breadcrumbs]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
	$wp_customize->add_control('tags', array('label' => esc_html__('Tags on Posts', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[tags]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[featured_image]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
    $wp_customize->add_control('featured_image_placeholder', array('label' => esc_html__('Placeholder image for posts with no featured image', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[featured_image_placeholder]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[social_sharing]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[post_nav]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[author_box]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
    $wp_customize->add_control('related_content', array('label' => esc_html__('Related Articles', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[related_content]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'houston-uasi'), 'disable' => esc_html__('Disable', 'houston-uasi'))));
	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[sidebar]', 'priority' => 8, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'houston-uasi'), 'left' => esc_html__('Left Sidebar', 'houston-uasi'))));
	$wp_customize->add_control('archives', array('label' => esc_html__('Archives', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[archives]', 'priority' => 9, 'type' => 'select', 'choices' => array('layout1' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 1), 'layout2' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 2), 'layout3' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 3), 'layout4' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 4))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => esc_html__('Hide Post Meta Data', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[post_meta_header]', 'priority' => 10)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Hide Date', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[post_meta_date]', 'priority' => 11, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Hide Author', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[post_meta_author]', 'priority' => 12, 'type' => 'checkbox'));
	$wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Hide Categories', 'houston-uasi'), 'section' => 'mh_layout', 'settings' => 'houston_uasi_options[post_meta_cat]', 'priority' => 13, 'type' => 'checkbox'));

	$wp_customize->add_control('show_ticker', array('label' => esc_html__('Enable Ticker', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[show_ticker]', 'priority' => 1, 'type' => 'checkbox'));
    $wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_title]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_posts]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('ticker_cats', array('label'=> esc_html__('Custom Categories (use ID - e.g. 3,5,9):', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_cats]', 'priority' => 4, 'type' => 'text'));
    $wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_tags]', 'priority' => 5, 'type' => 'text'));
    $wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_offset]', 'priority' => 6, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'houston-uasi'), 'section' => 'mh_ticker', 'settings' => 'houston_uasi_options[ticker_sticky]', 'priority' => 7, 'type' => 'checkbox'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'houston-uasi'), 1), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_1]', 'priority' => 52)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'houston-uasi'), 2), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_2]', 'priority' => 53)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_3', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'houston-uasi'), 3), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_3]', 'priority' => 54)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_4', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'houston-uasi'), 4), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_4]', 'priority' => 55)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_5', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'houston-uasi'), 5), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_5]', 'priority' => 56)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_6', array('label' => esc_html__('Text Color (Navigation/Footer)', 'houston-uasi'), 'section' => 'colors', 'settings' => 'houston_uasi_options[color_6]', 'priority' => 57)));

    $wp_customize->add_control('max_width_layout', array('label' => esc_html__('Set Max Width of Layout', 'houston-uasi'), 'section' => 'mh_set_max_width_layout', 'settings' => 'houston_uasi_options[max_width_layout]', 'priority' => 1, 'type' => 'text'));

    $wp_customize->add_setting( 'houston_uasi_options[logo_image]' );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,'logo_image',array(
                'label' => 'Logo Image',
                'section' => 'title_tagline',
                'settings' => 'houston_uasi_options[logo_image]',
                'priority' => 99,
                'description'  => esc_html__('Upload logo image', 'houston-uasi'),
            )
        )
    );

    $wp_customize->add_setting( 'houston_uasi_options[align]' );
    $wp_customize->add_control('align', array('label' => esc_html__('Align', 'houston-uasi'), 'section' => 'title_tagline', 'settings' => 'houston_uasi_options[align]', 'priority' => 100, 'type' => 'select', 'choices' => array(
            'left' => esc_html__('Left', 'houston-uasi'),
            'center' => esc_html__('Center', 'houston-uasi'),
            'right' => esc_html__('Right', 'houston-uasi')
        )
    ));

    $wp_customize->add_control(
        'background_image_opt',
        array (
            'label' => esc_html__('Background Image Option', 'houston-uasi'),
            'section' => 'mh_set_header_background_image', 
            'settings' => 'img_back_opt', 
            'priority' => 2,
            'type' => 'select',
            'choices' => array (
                '0' => 'Default',
                '1' => 'Full Width'
                )
            )
        );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
               $wp_customize,
               'header_background_image',
            array(
                'label'      => __( 'Upload background image', 'houston-uasi' ),
                'section'    => 'mh_set_header_background_image',
                'settings'   => 'img_back',
                'priority'   => 1
            )
        )
    );

}
add_action('customize_register', 'houston_uasi_customize_register');

/***** Data Sanitization *****/

function houston_uasi_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function houston_uasi_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function houston_uasi_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function houston_uasi_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'houston-uasi'),
        'disable' => esc_html__('Disable', 'houston-uasi'),
        'right' => esc_html__('Right Sidebar', 'houston-uasi'),
        'left' => esc_html__('Left Sidebar', 'houston-uasi'),
        'layout1' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 1),
        'layout2' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 2),
        'layout3' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 3),
        'layout4' => sprintf(esc_html__('Layout %d', 'houston-uasi'), 4)
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('houston_uasi_theme_options')) {
	function houston_uasi_theme_options() {
		$theme_options = wp_parse_args(
			get_option('houston_uasi_options', array()),
			houston_uasi_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('houston_uasi_default_options')) {
	function houston_uasi_default_options() {
		$default_options = array(
			'excerpt_length' => 25,
			'excerpt_more' => esc_html__('Read More', 'houston-uasi'),
			'copyright' => '',
			'breadcrumbs' => 'enable',
			'tags' => 'enable',
			'featured_image' => 'enable',
            'featured_image_placeholder' => 'enable',
			'social_sharing' => 'enable',
			'post_nav' => 'enable',
			'author_box' => 'enable',
			'related_content' => 'enable',
			'sidebar' => 'right',
			'archives' => 'layout1',
			'post_meta_date' => 0,
			'post_meta_author' => 0,
			'post_meta_cat' => 0,
			'show_ticker' => 1,
			'ticker_title' => esc_html__('Hot Topics', 'houston-uasi'),
			'ticker_posts' => 5,
			'ticker_cats' => '',
			'ticker_tags' => '',
			'ticker_offset' => '',
			'ticker_sticky' => 0,
			'color_1' => '#005a8c',
			'color_2' => '#ccdee8',
			'color_3' => '#1f1e1e',
			'color_4' => '#333333',
			'color_5' => '#464646',
			'color_6' => '#ffffff',
            'max_width_layout' => 1180
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function houston_uasi_customizer_css() {
	wp_enqueue_style('houston-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'houston_uasi_customizer_css');

/***** CSS Output *****/

function houston_uasi_custom_css() {
	$houston_uasi_options = houston_uasi_theme_options();
	if ($houston_uasi_options['color_1'] != '#005a8c' || $houston_uasi_options['color_2'] != '#ccdee8' || $houston_uasi_options['color_3'] != '#1f1e1e' || $houston_uasi_options['color_4'] != '#333333' || $houston_uasi_options['color_5'] != '#464646' || $houston_uasi_options['color_6'] != '#ffffff' || $houston_uasi_options['max_width_layout'] != 1180 ) : ?>
	<style type="text/css">
    	<?php if ($houston_uasi_options['color_1'] != '#005a8c') { ?>
    		.social-nav a:hover, .logo-title, .entry-content a, a:hover, .entry-meta .entry-meta-author, .entry-meta a, .comment-info, blockquote, .pagination a:hover .pagelink { color: <?php echo $houston_uasi_options['color_1']; ?>; }
			.main-nav li:hover, .slicknav_menu, .ticker-title, .breadcrumb a, .breadcrumb .bc-text, .button span, .widget-title span, input[type=submit], table th, .comment-section-title .comment-count, #cancel-comment-reply-link:hover, .pagination .current, .pagination .pagelink { background: <?php echo $houston_uasi_options['color_1']; ?>; }
			blockquote, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover { border-color: <?php echo $houston_uasi_options['color_1']; ?>; }
    	<?php } ?>
    	<?php if ($houston_uasi_options['color_2'] != '#ccdee8') { ?>
			.widget-title, .pagination a.page-numbers:hover, .dots:hover, .pagination a:hover .pagelink, .comment-section-title { background: <?php echo $houston_uasi_options['color_2']; ?>; }
			.commentlist .depth-1, .commentlist .bypostauthor .avatar { border-color: <?php echo $houston_uasi_options['color_2']; ?>; }
    	<?php } ?>
    	<?php if ($houston_uasi_options['color_3'] != '#1f1e1e') { ?>
			.main-nav, .main-nav ul li:hover > ul, .houston-footer { background: <?php echo $houston_uasi_options['color_3']; ?>; }
    	<?php } ?>
    	<?php if ($houston_uasi_options['color_4'] != '#333333') { ?>
			.header-top, .header-nav ul li:hover > ul, .footer-ad-wrap, .footer-1, .footer-2, .footer-3, .footer-bottom { background: <?php echo $houston_uasi_options['color_4']; ?>; }
			.social-nav a { color: <?php echo $houston_uasi_options['color_4']; ?>; }
    	<?php } ?>
    	<?php if ($houston_uasi_options['color_5'] != '#464646') { ?>
			.footer-widgets .widget-title { background: <?php echo $houston_uasi_options['color_5']; ?>; }
    	<?php } ?>
    	<?php if ($houston_uasi_options['color_6'] != '#ffffff') { ?>
			.header-nav li a, .main-nav li a, .footer-nav li a, .social-nav .fa-houston-social, .houston-footer, .houston-footer a, .footer-widgets .widget-title { color: <?php echo $houston_uasi_options['color_6']; ?>; }
    	<?php } ?>
        <?php if ($houston_uasi_options['max_width_layout'] != 1180) { ?>
            div#houston-wrapper {
                max-width: <?php echo $houston_uasi_options['max_width_layout'].'px !important'; ?>;
            }
        <?php } ?>

	</style>
    <?php
	endif;

    if ((get_theme_mod('img_back'))):?>
        <style type="text/css">
            @media only screen and (min-width: 980px) {
                .header-wrap {
                    background-image: url("<?php echo esc_url(get_theme_mod('img_back')); ?>");
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                }
            }

        </style>
    <?php 
    endif;

    if (get_theme_mod('img_back_opt') == 1) : ?>
        <style type="text/css">
            .new-wrapper-full-img-back {
                width: 90%;
                max-width: 1180px;
                margin: 0 auto;
                padding:0 20px;
                background: #fff;
                -moz-transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -o-transition: all 0.5s;
                transition: all 0.5s;
            }
            .new-wrapper-full-img-back.no-back {background:none;}
            .houston-header {
                margin-bottom: 0;
            }
            @media only screen and (max-width: 980px) {
                .new-wrapper-full-img-back { max-width: 777px;}
                .new-wrapper-full-img-back.no-back {background:#fff; padding: 20px 20px;}
                .header-wrap { padding: 0; }
            }
            @media only screen and (max-width: 580px) {
                .new-wrapper-full-img-back { max-width: 85%; }
            }
            @media only screen and (max-width: 420px) {
                .new-wrapper-full-img-back { min-width: 160px; }
            }
            <?php if ($houston_uasi_options['max_width_layout'] != 1180) { ?>
            .new-wrapper-full-img-back {
                max-width: <?php echo $houston_uasi_options['max_width_layout'].'px !important'; ?>;
            }
            <?php } ?>

        </style>
    <?php
    endif;

}
add_action('wp_head', 'houston_uasi_custom_css');

?>
