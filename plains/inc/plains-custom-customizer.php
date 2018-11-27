<?php
/*
 * Custom Customizer
 *
*/ 

function plains_custom_customize_register($wp_customize) {

	class Plains_Customize_Control_Sticky_Dropdown extends WP_Customize_Control {

        public $type = 'sticky-post-dropdown';

        public function render_content() {
        	$sticky = get_option( 'sticky_posts' );
        	if(!empty($sticky)):
            $args 	= array(
                'posts_per_page'   => -1,
                'post__in' => $sticky,
                'ignore_sticky_posts' => 1
            );

            $query 	= new WP_Query( $args );
        ?>
           <label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<select <?php $this->link(); ?>>
					<?php 
					while( $query->have_posts() ) {
						$query->the_post();
						echo "<option " . selected( $this->value(), get_the_ID() ) . " value='" . get_the_ID() . "'>" . the_title( '', '', false ) . "</option>";
					}
					?>
				</select>
			</label>
		<?php else : ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<strong style="color:#d31145;">No sticky on posts</strong>
			</label>
		<?php endif; ?>
        <?php }
    }

    class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

    class WP_Customize_Text_Custom_Control extends WP_Customize_Control {
        public $type = 'custom_input_text';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" maxlength="23" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class WP_Customize_Text_lg_Custom_Control extends WP_Customize_Control {
        public $type = 'custom_input_lg_text';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" maxlength="45" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

	/***** Add Panels *****/
	$wp_customize->add_panel('plains_theme_options', array('title' => esc_html__('Plains Theme Options', 'plains'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/
	$wp_customize->add_section('plains_homepage_image_slider', array('title' => __('Homepage Image Slider','plains'), 'priority' => 1, 'panel' => 'plains_theme_options'));
	$wp_customize->add_section('plains_homepage_page_on_slider', array('title' => __('Post on Slider','plains'), 'priority' => 2, 'panel' => 'plains_theme_options'));
    $wp_customize->add_section('plains_area_middle_sections', array('title' => __('Middle Section Area','plains'), 'priority' => 3, 'panel' => 'plains_theme_options'));
	$wp_customize->add_section('plains_homepage_page', array('title' => __('Page to Homepage','plains'), 'priority' => 4, 'panel' => 'plains_theme_options'));
	$wp_customize->add_section('plains_custom_color', array('title' => __('Custom Colors','plains'), 'priority' => 5, 'panel' => 'plains_theme_options'));
	$wp_customize->add_section('plains_footer_info', array('title' => __('Footer Info','plains'), 'priority' => 6, 'panel' => 'plains_theme_options'));
    $wp_customize->add_section('plains_button_settings', array('title' => __('Button Settings','plains'), 'priority' => 7, 'panel' => 'plains_theme_options'));
    


	/***** Add Settings *****/
	for ($i=0; $i < 5; $i++) { 
		$wp_customize->add_setting( 'plains_his['.$i.']' );
	}
	$wp_customize->add_setting( 'plains_setting_sticky_dropdown', array('default' => array()) );
	$wp_customize->add_setting( 'header_button_one_color_custom' , array(
        'default' => '#002A5C',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_setting( 'header_button_two_color_custom' , array(
        'default' => '#D31145',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_setting( 'footer_info_setting' );
    $wp_customize->add_setting( 'footer_info_copyright_setting' );
    $wp_customize->add_setting( 'header_button_one_setting_text' );
    $wp_customize->add_setting( 'header_button_one_setting_link' );
    $wp_customize->add_setting( 'header_button_two_setting_text' );
    $wp_customize->add_setting( 'header_button_two_setting_link' );

    // Settings of middle sections
    $wp_customize->add_setting( 'plains_title_middle_setting_sections' );
    $wp_customize->add_setting( 'plains_content_middle_setting_sections' );
    $wp_customize->add_setting( 'plains_image_middle_setting_sections' );
    $wp_customize->add_setting( 'plains_link_middle_setting_sections' );
    $wp_customize->add_setting( 'plains_text_link_middle_setting_sections' );





	/***** Add Controls *****/
    $wp_customize->add_control( new WP_Customize_Text_lg_Custom_Control(
            $wp_customize, 
            'plains_title_middle_setting_sections', 
            array(
            'label'    => __( 'Title', 'plains' ),
            'section'  => 'plains_area_middle_sections',
            'settings' => 'plains_title_middle_setting_sections'
        ) ) );
    $wp_customize->add_control( new WP_Customize_Textarea_Control(
            $wp_customize, 
            'plains_content_middle_setting_sections', 
            array(
            'label'    => __( 'Content', 'plains' ),
            'section'  => 'plains_area_middle_sections',
            'settings' => 'plains_content_middle_setting_sections'
        ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize, 
            'plains_image_middle_setting_sections', 
            array(
            'label'    => __( 'Image', 'plains' ),
            'section'  => 'plains_area_middle_sections',
            'settings' => 'plains_image_middle_setting_sections'
        ) ) );
    $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize, 
            'plains_link_middle_setting_sections', 
            array(
            'label'    => __( 'Link/url', 'plains' ),
            'section'  => 'plains_area_middle_sections',
            'settings' => 'plains_link_middle_setting_sections',
            'type'     => 'url'
        ) ) );
    $wp_customize->add_control( new WP_Customize_Text_Custom_Control(
            $wp_customize, 
            'plains_text_link_middle_setting_sections', 
            array(
            'label'    => __( 'Text of link/url', 'plains' ),
            'section'  => 'plains_area_middle_sections',
            'settings' => 'plains_text_link_middle_setting_sections'
        ) ) );

	for ($i=0; $i < 5; $i++) { 
		$wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize, 
	        'plains_his['.$i.']', 
	        array(
	        'label'    => __( 'Upload Image', 'plains' ),
	        'section'  => 'plains_homepage_image_slider',
	        'settings' => 'plains_his['.$i.']'
	    ) ) );
	}
	$wp_customize->add_control(
        new Plains_Customize_Control_Sticky_Dropdown(
            $wp_customize,
            'plains_setting_sticky_dropdown',
            array(
                'settings' => 'plains_setting_sticky_dropdown',
                'label'    => __('Sticky / Post Select','plains'),
                'description'   => __('Display Sticky/Post on Slider homepage','plains'),
                'section'  => 'plains_homepage_page_on_slider',
                'type'     => 'sticky-post-dropdown',
            )
        )
    );
	$wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'header_button_one_color_custom',
        array(
            'label'      => __( 'Header Button #1 Colors', 'plains' ),
            'section'    => 'plains_custom_color',
            'settings'   => 'header_button_one_color_custom',
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'header_button_two_color_custom',
        array(
            'label'      => __( 'Header Button #2 Colors', 'plains' ),
            'section'    => 'plains_custom_color',
            'settings'   => 'header_button_two_color_custom',
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'header_button_one_setting_text',
        array(
            'label'      => __( 'Header Button #1 Text', 'plains' ),
            'section'    => 'plains_button_settings',
            'settings'   => 'header_button_one_setting_text',
            'type'       => 'custom_input_text'
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'header_button_one_setting_link',
        array(
            'label'      => __( 'Header Button #1 Link', 'plains' ),
            'section'    => 'plains_button_settings',
            'settings'   => 'header_button_one_setting_link',
            'type'       => 'url'
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'header_button_two_setting_text',
        array(
            'label'      => __( 'Header Button #2 Text', 'plains' ),
            'section'    => 'plains_button_settings',
            'settings'   => 'header_button_two_setting_text',
            'text'       => 'custom_input_text'
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'header_button_two_setting_link',
        array(
            'label'      => __( 'Header Button #2 Link', 'plains' ),
            'section'    => 'plains_button_settings',
            'settings'   => 'header_button_two_setting_link',
            'text'       => 'url'
        ) )
    );
    $wp_customize->add_control( 
    	new WP_Customize_Textarea_Control( 
		$wp_customize, 
		'footer_info_setting', 
		array(
			'label'	=> __( 'Footer Info', 'plains' ),
			'section' => 'plains_footer_info',
			'settings' => 'footer_info_setting',
		) )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'footer_info_copyright_setting',
        array(
            'label'         => __( 'Footer Copyright', 'plains' ),
            'description'   => __('This text to display on footer copyright','plains'),
            'section'       => 'plains_footer_info',
            'settings'      => 'footer_info_copyright_setting',
            'type'          => 'textarea',
        ) )
    );

    // customizer for category in frontpage section
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

    //setting for category display in frontpage
    $wp_customize->add_section('plains_front_category_opt',array(
        'title' => __('Front Category Section','plains'),
        'priority' => 150,
        'panel' => 'plains_theme_options'
    ));

    // Front Category Content Customizer
    for ($i=1; $i < 4; $i++){
        // Title Column
        $wp_customize->add_setting( 'front_category_title_'.$i);
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'front_category_title_'.$i,
                array(
                    'label'         => __( 'Title Column #'.$i, 'plains' ),
                    'description'   => __('Title for first column, default will be category name.','plains'),
                    'section'       => 'plains_front_category_opt',
                    'settings'      => 'front_category_title_'.$i,
                    'type'          => 'text',
                ) 
            )
        );

        // Dropdown category
        $wp_customize->add_setting( 'front_category_dropdown_'.$i);
        $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_'.$i,
                array(
                    'label'         => 'Set category #'.$i,
                    'description'   => __('Select category to display','plains'),
                    'section'       => 'plains_front_category_opt',
                    'setting'       => 'front_category_dropdown_'.$i
                )
            )
        );

        // Link view all
        $wp_customize->add_setting( 'category_view_all_link_'.$i );
        $wp_customize->add_control( 
        new WP_Customize_Control(
                $wp_customize, 
                'category_view_all_link_'.$i, 
                array(
                    'label'         => __('View all link/url #'.$i, 'plains' ),
                    'description'   => __('Replace default view all link on front category section','plains'),
                    'section'       => 'plains_front_category_opt',
                    'settings'      => 'category_view_all_link_'.$i,
                    'type'          => 'url'
                ) 
            ) 
        );
    }
}
add_action('customize_register', 'plains_custom_customize_register');
?>