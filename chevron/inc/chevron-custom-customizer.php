<?php
add_action('customize_register','chevron_custom_customizer');

function chevron_custom_customizer ($wp_customize){

    class WP_Customize_dropdown_category extends WP_Customize_Control {
        public function render_content() {
            $drop_category = wp_dropdown_categories(
                    array(
                        'show_option_all'    => '',
                        'show_option_none'   => '',
                        'option_none_value'  => '0',
                        'echo' => '0',
                        'selected' => $this->value(),
                        'name' => '_custom-drop-category' . $this->id
                        )
                );
            $drop_category = str_replace( '<select', '<select ' . $this->get_link(), $drop_category );

            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $drop_category
            );
        }
    }

/**************************************** Add Panels ****************************************/
	$wp_customize->add_panel(
		'chevron_panel',
		array(
			'title' => esc_html__('Chevron Theme Options', 'chevron'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			)
		);

/**************************************** Add Sections ****************************************/

    // Footer
    $wp_customize->add_section('chevron_homepage',array(
        'title' => __('Homepage Content','chevron'),
        'priority' => 1,
        'description' => __('Select category for displaying post on the Homepage'),
        'panel' => 'chevron_panel'
    ));
    $wp_customize->add_section('chevron_footer',array(
        'title'         => __('Footer Setting','chevron'),
        'description'   => __('','chevron'),
        'priority'      => 8,
        'panel'         => 'chevron_panel'
    ));


/************************************ Add Settings & Control **********************************/
    $wp_customize->add_setting('front_category_dropdown_3',array('default'=>'Chevron Corporation.'));
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_3',
            array(
                'label' => 'Choose category',
                'section' => 'chevron_homepage',
                'setting' => 'front_category_dropdown_3'
            )
        )
    );

    $wp_customize->add_setting('footer_copyright',array('default'=>'Chevron Corporation.'));
    $wp_customize->add_control('footer_copyright',array(
        'label'     => 'Copyright',
        'section'   => 'chevron_footer',
        'type'      => 'text',
    ));
}

