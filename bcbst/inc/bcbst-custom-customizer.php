<?php 
add_action('customize_register','bcbst_custom_customizer');
function bcbst_custom_customizer ($wp_customize){
     //social media
    $media = array (
        1 => 'facebook',
        2 => 'twitter',
        3 => 'youtube',
    );

    $def_linksocial = array (
        1 => 'https://www.facebook.com/',
        2 => 'https://twitter.com/',
        3 => 'https://youtube.com/'
    );

    class WP_Customize_dropdown_category extends WP_Customize_Control {
        public function render_content() {
            $drop_tag = wp_dropdown_categories(
                    array(
                        'show_option_all'    => '',
                        'show_option_none'   => '-- Select Tag --',
                        'option_none_value'  => '1',
                        'echo' => '0',
                        'selected' => $this->value(),
                        'hide_empty' => 1, 
                        'name' => 'my_tags',
                        'taxonomy'=> 'post_tag'
                    )
                );
            $drop_tag = str_replace( '<select', '<select ' . $this->get_link(), $drop_tag );

            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $drop_tag
            );
        }
    }

/**************************************** Add Panels ****************************************/
	$wp_customize->add_panel(
		'bcbst_panel',
		array(
			'title' => esc_html__('BcBsT Theme Options', 'bcbst'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
		)
	);
/**************************************** Add Section ****************************************/
   	// Homepage Hero category
    $wp_customize->add_section('bcbst_home_button_link',array(
        'title' => __('Homepage Button Link','bcbst'),
        'description'   => __('','bcbst'),
        'priority' => 2,
        'panel' => 'bcbst_panel'
    ));
    // Slider Setting
    $wp_customize->add_section('bcbst_slider_setting_link',array(
        'title' => __('Slider Setting','bcbst'),
        'description'   => __('','bcbst'),
        'priority' => 3,
        'panel' => 'bcbst_panel'
    ));
   	// Footer Section
    $wp_customize->add_section('bcbst_footer',array(
        'title' => __('Footer','bcbst'),
        'description'   => __('','bcbst'),
        'priority' => 4,
        'panel' => 'bcbst_panel'
    ));

/**************************************** Control + Setting ****************************************/

    // ask a question
    $wp_customize->add_setting('ask_a_question_label');
    $wp_customize->add_control('ask_a_question_label',array(
        'label'     => 'Left Button',
        'description' => 'Label for left button (default: ask a question).',
        'section'   => 'bcbst_home_button_link',
        'type'      => 'url',
    ));
    $wp_customize->add_setting('ask_a_question');
    $wp_customize->add_control('ask_a_question',array(
        'description' => 'URL for left button.',
        'section'   => 'bcbst_home_button_link',
        'type'      => 'url',
    ));
    $wp_customize->add_setting( 'tg_left_btn', array(
        'default'   => false,
    ) );
    $wp_customize->add_control('tg_left_btn', array(
        'section'   => 'bcbst_home_button_link',
        'label'     => 'Hide Left Button (check to hide button)',
        'type'      => 'checkbox'
    ) );


    // register for updates
    $wp_customize->add_setting('register_updates_label');
    $wp_customize->add_control('register_updates_label',array(
        'label'     => 'Right Button',
        'description' => 'Label for right button (default: register for updates).',
        'section'   => 'bcbst_home_button_link',
        'type'      => 'url',
    ));   
    $wp_customize->add_setting('register_updates');
    $wp_customize->add_control('register_updates',array(
        'description' => 'URL for right button.',
        'section'   => 'bcbst_home_button_link',
        'type'      => 'url',
    ));
    $wp_customize->add_setting( 'tg_right_btn', array(
        'default'   => false,
    ) );
    $wp_customize->add_control('tg_right_btn', array(
        'section'   => 'bcbst_home_button_link',
        'label'     => 'Hide Right Button (check to hide button)',
        'type'      => 'checkbox'
    ) );

    // select tag (default: 3 most recent post)
    $wp_customize->add_setting('select_tag');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
        $wp_customize,
            'select_tag',
            array(
                'label'    => 'Select Tag',
                'section'  => 'bcbst_slider_setting_link',
                'setting'  => 'select_tag'
            )
        )
    );
    // Number of posts to show (default: 3 post)
    $wp_customize->add_setting('number_post_show', array(
        'default'   => 3,
    ));
    $wp_customize->add_control('number_post_show',array(
        'label'     => 'Number of posts to show',
        'description' => 'default: 3 post',
        'section'   => 'bcbst_slider_setting_link',
        'type'      => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step'  => 1 )
    ));
    // Length of excerpt (default: 35 words)
    $wp_customize->add_setting('length_excerpt', array(
        'default'   => 35,
    ));
    $wp_customize->add_control('length_excerpt',array(
        'label'     => 'Length of excerpt',
        'description' => 'default: 35 words',
        'section'   => 'bcbst_slider_setting_link',
        'type'      => 'number',
        'input_attrs' => array( 'min' => 0, 'step'  => 1 )
    ));      

    // footer contact us
    $wp_customize->add_setting('footer_contact_us');
    $wp_customize->add_control('footer_contact_us',array(
        'label'     => 'Footer Contact Us',
        'description' => 'Insert url for Contact Us link.',
        'section'   => 'bcbst_footer',
        'type'      => 'url',
    ));

    // footer text
    $wp_customize->add_setting('footer_text');
    $wp_customize->add_control('footer_text',array(
        'label'     => 'Footer Text Copyright',
        'description' => 'Insert text for footer copyright.',
        'section'   => 'bcbst_footer',
        'type'      => 'text',
    ));

    // footer social
    for ($m=1; $m <= 3 ; $m++) {
        if ($m == 1) {
            $label = "Media Sosial Link";
        } else { $label = '';}
        $wp_customize->add_setting('footer_media_'.$media[$m], array('default'=>$def_linksocial[$m]));
        $wp_customize->add_control( 'footer_media_'.$media[$m], array(
            'label'         => $label,
            'description'   => 'Insert Url for '.$media[$m],
            'section'       => 'bcbst_footer',
            'type'          => 'url'
        ) );
    }

}