<?php
add_action('customize_register','aramco_custom_customizer');

function aramco_custom_customizer ($wp_customize){




	/***** Add Panels *****/
	$wp_customize->add_panel(
		'aramco_panel',
		array(
			'title' => esc_html__('Aramco Theme Options', 'aramco'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			)
		);

	/********************** Add Sections ************************/
    // header customizer
    $wp_customize->add_section('aramco_footer',array(
        'title' => __('Footer','aramco'),
        'description'   => __('','aramco'),
        'priority' => 99,
        'panel' => 'aramco_panel'
    ));
   	
    /***************** Add Settings & Control *********************/
    $wp_customize->add_setting('footer_copyright',array('default' => 'Copyright Aramco Services Company'));
        $wp_customize->add_control( 'footer_copyright', array(
            'label' => 'Copyright',
            'description' => '',
            'section'  => 'aramco_footer',
            'type'     => 'text'
        ) );

    $wp_customize->add_setting('footer_link',array('default' => ''));
        $wp_customize->add_control( 'footer_link', array(
            'label' => 'Link Copyright',
            'description' => 'Set the title',
            'section'  => 'aramco_footer',
            'type'     => 'text'
        ) );
    $wp_customize->add_setting('footer_link_url',array('default' => '#'));
        $wp_customize->add_control( 'footer_link_url', array(
            'label' => '',
            'description' => 'Set the Url',
            'section'  => 'aramco_footer',
            'type'     => 'text'
        ) );

}