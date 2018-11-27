<?php

function asc_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'asc'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General', 'asc'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => esc_html__('Layout', 'asc'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_ticker', array('title' => esc_html__('News Ticker', 'asc'), 'priority' => 4, 'panel' => 'mh_theme_options'));

    $wp_customize->add_section('mh_set_max_width_layout', array('title' => esc_html__('Set Max Width of Layout', 'asc'), 'priority' => 5, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_logo_image', array('title' => esc_html__('Logo Image', 'asc'), 'priority' => 6, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_set_header_background_image', array('title' => esc_html__('Header Background Image', 'asc'), 'priority' => 6, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('asc_options[excerpt_length]', array('default' => 25, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_integer'));
    $wp_customize->add_setting('asc_options[excerpt_more]', array('default' => esc_html__('Read More', 'asc'), 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_text'));
	$wp_customize->add_setting('asc_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_text'));

    $wp_customize->add_setting('asc_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[tags]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[featured_image_placeholder]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
	$wp_customize->add_setting('asc_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
    $wp_customize->add_setting('asc_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
	$wp_customize->add_setting('asc_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
	$wp_customize->add_setting('asc_options[archives]', array('default' => 'layout1', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_select'));
	$wp_customize->add_setting('asc_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('asc_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_checkbox'));
    $wp_customize->add_setting('asc_options[post_meta_author]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_checkbox'));
    $wp_customize->add_setting('asc_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_checkbox'));

    $wp_customize->add_setting('asc_options[show_ticker]', array('default' => 1, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_checkbox'));
    $wp_customize->add_setting('asc_options[ticker_title]', array('default' => esc_html__('Hot Topics', 'asc'), 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_text'));
    $wp_customize->add_setting('asc_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_integer'));
    $wp_customize->add_setting('asc_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_text'));
    $wp_customize->add_setting('asc_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_text'));
    $wp_customize->add_setting('asc_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_integer'));
    $wp_customize->add_setting('asc_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_checkbox'));

	$wp_customize->add_setting('asc_options[color_1]', array('default' => '#005a8c', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('asc_options[color_2]', array('default' => '#ccdee8', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('asc_options[color_3]', array('default' => '#1f1e1e', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('asc_options[color_4]', array('default' => '#333333', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('asc_options[color_5]', array('default' => '#464646', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('asc_options[color_6]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    $wp_customize->add_setting('asc_options[max_width_layout]', array('default' => 1180, 'type' => 'option', 'sanitize_callback' => 'asc_sanitize_integer'));
    $wp_customize->add_setting('img_back_opt', array('default' => 0));
    $wp_customize->add_setting('img_back');
    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'asc'), 'section' => 'mh_general', 'settings' => 'asc_options[excerpt_length]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'asc'), 'section' => 'mh_general', 'settings' => 'asc_options[excerpt_more]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'asc'), 'section' => 'mh_general', 'settings' => 'asc_options[copyright]', 'priority' => 4, 'type' => 'text'));

    $wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[breadcrumbs]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
	$wp_customize->add_control('tags', array('label' => esc_html__('Tags on Posts', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[tags]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[featured_image]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
    $wp_customize->add_control('featured_image_placeholder', array('label' => esc_html__('Placeholder image for posts with no featured image', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[featured_image_placeholder]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[social_sharing]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[post_nav]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[author_box]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
    $wp_customize->add_control('related_content', array('label' => esc_html__('Related Articles', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[related_content]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'asc'), 'disable' => esc_html__('Disable', 'asc'))));
	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[sidebar]', 'priority' => 8, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'asc'), 'left' => esc_html__('Left Sidebar', 'asc'))));
	$wp_customize->add_control('archives', array('label' => esc_html__('Archives', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[archives]', 'priority' => 9, 'type' => 'select', 'choices' => array('layout1' => sprintf(esc_html__('Layout %d', 'asc'), 1), 'layout2' => sprintf(esc_html__('Layout %d', 'asc'), 2), 'layout3' => sprintf(esc_html__('Layout %d', 'asc'), 3), 'layout4' => sprintf(esc_html__('Layout %d', 'asc'), 4))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => esc_html__('Hide Post Meta Data', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[post_meta_header]', 'priority' => 10)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Hide Date', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[post_meta_date]', 'priority' => 11, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Hide Author', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[post_meta_author]', 'priority' => 12, 'type' => 'checkbox'));
	$wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Hide Categories', 'asc'), 'section' => 'mh_layout', 'settings' => 'asc_options[post_meta_cat]', 'priority' => 13, 'type' => 'checkbox'));

	$wp_customize->add_control('show_ticker', array('label' => esc_html__('Enable Ticker', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[show_ticker]', 'priority' => 1, 'type' => 'checkbox'));
    $wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_title]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_posts]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('ticker_cats', array('label'=> esc_html__('Custom Categories (use ID - e.g. 3,5,9):', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_cats]', 'priority' => 4, 'type' => 'text'));
    $wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_tags]', 'priority' => 5, 'type' => 'text'));
    $wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_offset]', 'priority' => 6, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'asc'), 'section' => 'mh_ticker', 'settings' => 'asc_options[ticker_sticky]', 'priority' => 7, 'type' => 'checkbox'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'asc'), 1), 'section' => 'colors', 'settings' => 'asc_options[color_1]', 'priority' => 52)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'asc'), 2), 'section' => 'colors', 'settings' => 'asc_options[color_2]', 'priority' => 53)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_3', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'asc'), 3), 'section' => 'colors', 'settings' => 'asc_options[color_3]', 'priority' => 54)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_4', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'asc'), 4), 'section' => 'colors', 'settings' => 'asc_options[color_4]', 'priority' => 55)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_5', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'asc'), 5), 'section' => 'colors', 'settings' => 'asc_options[color_5]', 'priority' => 56)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_6', array('label' => esc_html__('Text Color (Navigation/Footer)', 'asc'), 'section' => 'colors', 'settings' => 'asc_options[color_6]', 'priority' => 57)));

    $wp_customize->add_control('max_width_layout', array('label' => esc_html__('Set Max Width of Layout', 'asc'), 'section' => 'mh_set_max_width_layout', 'settings' => 'asc_options[max_width_layout]', 'priority' => 1, 'type' => 'text'));

    $wp_customize->add_setting( 'asc_options[logo_image]' );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,'logo_image',array(
                'label' => 'Logo Image',
                'section' => 'title_tagline',
                'settings' => 'asc_options[logo_image]',
                'priority' => 99,
                'description'  => esc_html__('Upload logo image', 'asc'),
            )
        )
    );

    $wp_customize->add_setting( 'asc_options[align]' );
    $wp_customize->add_control('align', array('label' => esc_html__('Align', 'asc'), 'section' => 'title_tagline', 'settings' => 'asc_options[align]', 'priority' => 100, 'type' => 'select', 'choices' => array(
            'left' => esc_html__('Left', 'asc'),
            'center' => esc_html__('Center', 'asc'),
            'right' => esc_html__('Right', 'asc')
        )
    ));

    $wp_customize->add_control(
        'background_image_opt',
        array (
            'label' => esc_html__('Background Image Option', 'asc'),
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
                'label'      => __( 'Upload background image', 'asc' ),
                'section'    => 'mh_set_header_background_image',
                'settings'   => 'img_back',
                'priority'   => 1
            )
        )
    );

}
add_action('customize_register', 'asc_customize_register');

/***** Data Sanitization *****/

function asc_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function asc_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function asc_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function asc_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'asc'),
        'disable' => esc_html__('Disable', 'asc'),
        'right' => esc_html__('Right Sidebar', 'asc'),
        'left' => esc_html__('Left Sidebar', 'asc'),
        'layout1' => sprintf(esc_html__('Layout %d', 'asc'), 1),
        'layout2' => sprintf(esc_html__('Layout %d', 'asc'), 2),
        'layout3' => sprintf(esc_html__('Layout %d', 'asc'), 3),
        'layout4' => sprintf(esc_html__('Layout %d', 'asc'), 4)
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('asc_theme_options')) {
	function asc_theme_options() {
		$theme_options = wp_parse_args(
			get_option('asc_options', array()),
			asc_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('asc_default_options')) {
	function asc_default_options() {
		$default_options = array(
			'excerpt_length' => 25,
			'excerpt_more' => esc_html__('Read More', 'asc'),
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
			'ticker_title' => esc_html__('Hot Topics', 'asc'),
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

function asc_customizer_css() {
	wp_enqueue_style('asc-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'asc_customizer_css');

/***** CSS Output *****/

function asc_custom_css() {
	$asc_options = asc_theme_options();
	if ($asc_options['color_1'] != '#005a8c' || $asc_options['color_2'] != '#ccdee8' || $asc_options['color_3'] != '#1f1e1e' || $asc_options['color_4'] != '#333333' || $asc_options['color_5'] != '#464646' || $asc_options['color_6'] != '#ffffff' || $asc_options['max_width_layout'] != 1180 ) : ?>
	<style type="text/css">
    	<?php if ($asc_options['color_1'] != '#005a8c') { ?>
    		.social-nav a:hover, .logo-title, .entry-content a, a:hover, .entry-meta .entry-meta-author, .entry-meta a, .comment-info, blockquote, .pagination a:hover .pagelink { color: <?php echo $asc_options['color_1']; ?>; }
			.main-nav li:hover, .slicknav_menu, .ticker-title, .breadcrumb a, .breadcrumb .bc-text, .button span, .widget-title span, input[type=submit], table th, .comment-section-title .comment-count, #cancel-comment-reply-link:hover, .pagination .current, .pagination .pagelink { background: <?php echo $asc_options['color_1']; ?>; }
			blockquote, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover { border-color: <?php echo $asc_options['color_1']; ?>; }
    	<?php } ?>
    	<?php if ($asc_options['color_2'] != '#ccdee8') { ?>
			.widget-title, .pagination a.page-numbers:hover, .dots:hover, .pagination a:hover .pagelink, .comment-section-title { background: <?php echo $asc_options['color_2']; ?>; }
			.commentlist .depth-1, .commentlist .bypostauthor .avatar { border-color: <?php echo $asc_options['color_2']; ?>; }
    	<?php } ?>
    	<?php if ($asc_options['color_3'] != '#1f1e1e') { ?>
			.main-nav, .main-nav ul li:hover > ul, .asc-footer { background: <?php echo $asc_options['color_3']; ?>; }
    	<?php } ?>
    	<?php if ($asc_options['color_4'] != '#333333') { ?>
			.header-top, .header-nav ul li:hover > ul, .footer-ad-wrap, .footer-1, .footer-2, .footer-3, .footer-bottom { background: <?php echo $asc_options['color_4']; ?>; }
			.social-nav a { color: <?php echo $asc_options['color_4']; ?>; }
    	<?php } ?>
    	<?php if ($asc_options['color_5'] != '#464646') { ?>
			.footer-widgets .widget-title { background: <?php echo $asc_options['color_5']; ?>; }
    	<?php } ?>
    	<?php if ($asc_options['color_6'] != '#ffffff') { ?>
			.header-nav li a, .main-nav li a, .footer-nav li a, .social-nav .fa-asc-social, .asc-footer, .asc-footer a, .footer-widgets .widget-title { color: <?php echo $asc_options['color_6']; ?>; }
    	<?php } ?>
        <?php if ($asc_options['max_width_layout'] != 1180) { ?>
            div#asc-wrapper {
                max-width: <?php echo $asc_options['max_width_layout'].'px !important'; ?>;
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
            .asc-header {
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
            <?php if ($asc_options['max_width_layout'] != 1180) { ?>
            .new-wrapper-full-img-back {
                max-width: <?php echo $asc_options['max_width_layout'].'px !important'; ?>;
            }
            <?php } ?>

        </style>
    <?php
    endif;

}
add_action('wp_head', 'asc_custom_css');

?>
