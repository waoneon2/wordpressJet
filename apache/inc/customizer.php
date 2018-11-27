<?php
/**
 * Corporate Theme Customizer
 *
 * @package Corporate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jetty_corporate_theme_customize_register( $wp_customize ) {
    /**
	 * Add Theme colors customizer
	 */
    $wp_customize->add_setting( 'corporate_theme_header_background_color', array(
        'default' => '#ffffff',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'corporate_theme_header_background_color',
            array(
                'label'    => 'Header Background Color',
                'section'  => 'colors',
                'settings' => 'corporate_theme_header_background_color',
            )
        )
    );
    $wp_customize->add_setting( 'corporate_theme_mobile_nav_header_color', array(
    	'default' => '#13509f',
    ) );
    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
    		'corporate_theme_mobile_nav_header_color',
    		array(
    			'label'    => 'Mobile Nav Header Color',
    			'section'  => 'colors',
    			'settings' => 'corporate_theme_mobile_nav_header_color',
    		)
    	)
    );
    $wp_customize->add_setting( 'corporate_theme_body_title_color', array(
        'default' => '#13509f',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'corporate_theme_body_title_color',
            array(
                'label'    => 'Body Title Colors',
                'section'  => 'colors',
                'settings' => 'corporate_theme_body_title_color',
            )
        )
    );
    $wp_customize->add_setting( 'corporate_theme_body_link_color', array(
        'default' => '#13509f',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'corporate_theme_body_link_color',
            array(
                'label'    => 'Body Link Colors',
                'section'  => 'colors',
                'settings' => 'corporate_theme_body_link_color',
            )
        )
    );
    $wp_customize->add_setting( 'corporate_theme_footer_background_color', array(
        'default' => '#13509f',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'corporate_theme_footer_background_color',
            array(
                'label'    => 'Footer Background Color',
                'section'  => 'colors',
                'settings' => 'corporate_theme_footer_background_color',
            )
        )
    );

	/**
	 * Add Theme layout customizer
	 */
	require_once( 'theme-layout-settings.php' );
	$wp_customize->add_section( 'corporate_theme_layout_section', array (
		'title'    => 'Corporate Theme Layout',
	) );
	$wp_customize->add_setting( 'corporate_theme_layout', array (
		'default'  => LAYOUT_DEFAULT,
	) );
	$wp_customize->add_control( 'corporate_theme_layout', array(
        'section'  => 'corporate_theme_layout_section',
        'settings' => 'corporate_theme_layout',
        'label'    => 'Select Layout:',
        'type'     => 'select',
        'choices'  => array(
            LAYOUT_BLOG      => 'Blog',
            LAYOUT_DASHBOARD => 'Widget Dashboard',
        ),
    ) );

    /**
	 * Add Footer credits customizer
	 */
    $wp_customize->add_section( 'corporate_theme_footer_credits_section', array(
    	'title'    => 'Footer Credits',
    ) );
    $wp_customize->add_setting( 'corporate_theme_footer_credits', array(
    	'default'  => 'Another awesome Jetty site',
    ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'corporate_theme_footer_credits', array(
		'label'    => 'Footer Credits',
		'section'  => 'corporate_theme_footer_credits_section',
		'settings' => 'corporate_theme_footer_credits',
		'type'     => 'textarea',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'jetty_corporate_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jetty_corporate_theme_customize_preview_js() {
	wp_enqueue_script( 'jetty_corporate_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'jetty_corporate_theme_customize_preview_js' );
