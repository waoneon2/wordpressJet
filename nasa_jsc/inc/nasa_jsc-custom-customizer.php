<?php
/*
 * Custom Customizer
 *
*/ 

function nasa_jsc_custom_customize_register($wp_customize) {

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
                <input type="text" maxlength="45" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class WP_Customize_Text_Short_Custom_Control extends WP_Customize_Control {
        public $type = 'custom_input_text_short';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" maxlength="25" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class Date_Picker_Custom_Control extends WP_Customize_Control
	{
	    
	    public function enqueue()
	    {
	        wp_enqueue_style( 'nas_jsc_customizer_datepicker_style', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.min.css' );
	        wp_enqueue_style( 'nas_jsc_customizer_datepicker_theme_style', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.theme.min.css' );
	        wp_enqueue_script( 'nas_jsc_customizer_datepicker_script', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.min.js', array('jquery'), '20171215', true  );
	        wp_enqueue_script( 'nas_jsc_customizer_date_picker', get_template_directory_uri() . '/js/date_picker_script.js', array('jquery'), '20171215', true );

	    }
	
	    public function render_content()
	    {
	        ?>
	            <label>
	              <span class="customize-date-picker-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	          	<input type="text" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="nasa_jsc_datepicker"  <?php $this->link(); ?> />
	            </label>
	        <?php
	    }
	}

	/***** Add Panels *****/
	$wp_customize->add_panel('nasa_jsc_theme_options', array('title' => esc_html__('Nasa JSC Theme Options', 'nasa_jsc'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/
	$wp_customize->add_section('nasa_jsc_homepage_image_slider', array('title' => __('Homepage Image Slider','nasa_jsc'), 'priority' => 1, 'panel' => 'nasa_jsc_theme_options'));
	$wp_customize->add_section('nasa_jsc_status', array('title' => __('Nasa JSC Status','nasa_jsc'), 'priority' => 2, 'panel' => 'nasa_jsc_theme_options'));
	$wp_customize->add_section('nasa_jsc_social', array('title' => __('Social','nasa_jsc'), 'priority' => 3, 'panel' => 'nasa_jsc_theme_options'));
	$wp_customize->add_section('nasa_jsc_footer_info', array('title' => __('Footer Info','nasa_jsc'), 'priority' => 4, 'panel' => 'nasa_jsc_theme_options'));
	

	/***** Add Settings *****/
	for ($i=0; $i < 5; $i++) { 
		$wp_customize->add_setting( 'nasa_jsc_his['.$i.']' );
        $wp_customize->add_setting( 'nasa_jsc_his_title['.$i.']' );
	}
	$wp_customize->add_setting('nasa_jsc_status_setting_options', array(
        'default'        => 'enable',
    ));
	$wp_customize->add_setting( 'nasa_jsc_status_setting_text' );
	$wp_customize->add_setting( 'footer_info_setting' );
	$wp_customize->add_setting( 'nasa_jsc_social_setting['."facebook".']' );
	$wp_customize->add_setting( 'nasa_jsc_social_setting['."twitter".']' );

	/***** Add Controls *****/
	for ($i=0; $i < 5; $i++) { 
		$wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize, 
	        'nasa_jsc_his['.$i.']', 
	        array(
	        'label'    => __( 'Upload Image', 'nasa_jsc' ),
	        'section'  => 'nasa_jsc_homepage_image_slider',
	        'settings' => 'nasa_jsc_his['.$i.']'
	    ) ) );

        $wp_customize->add_control( new WP_Customize_Text_Custom_Control(
            $wp_customize, 
            'nasa_jsc_his_title['.$i.']', 
            array(
            'label'    => __( 'Title Overlay', 'nasa_jsc' ),
            'section'  => 'nasa_jsc_homepage_image_slider',
            'settings' => 'nasa_jsc_his_title['.$i.']'
        ) ) );
	}
	$wp_customize->add_control( new WP_Customize_Control(
	        $wp_customize, 
	        'nasa_jsc_status_setting_options', 
	        array(
	        'label'    => __( 'Nasa JSC Status Options', 'nasa_jsc' ),
	        'section'  => 'nasa_jsc_status',
	        'settings' => 'nasa_jsc_status_setting_options',
	        'type'    => 'select',
	        'choices'    => array(
	            'enable' => 'Enable',
	            'disable' => 'Disable',
	        ),
	        'priority' => 4
	    ) ) );
	$wp_customize->add_control( new WP_Customize_Text_Short_Custom_Control(
            $wp_customize, 
            'nasa_jsc_status_setting_text', 
            array(
            'label'    => __( 'Nasa JSC Status Text', 'nasa_jsc' ),
            'section'  => 'nasa_jsc_status',
            'settings' => 'nasa_jsc_status_setting_text'
        ) ) );
	$wp_customize->add_control( new WP_Customize_Textarea_Control( 
			$wp_customize, 
			'footer_info_setting', 
			array(
				'label'	=> __( 'Footer Info', 'nasa_jsc' ),
				'section' => 'nasa_jsc_footer_info',
				'settings' => 'footer_info_setting',
		) )
    );
    $wp_customize->add_control( new WP_Customize_Control(
	        $wp_customize, 
	        'nasa_jsc_social_setting['."facebook".']', 
	        array(
	        'label'    => __( 'Facebook Profile URL', 'nasa_jsc' ),
	        'section'  => 'nasa_jsc_social',
	        'settings' => 'nasa_jsc_social_setting['."facebook".']',
	        'type'	=> 'url',
		) ) );
    $wp_customize->add_control( new WP_Customize_Control(
	        $wp_customize, 
	        'nasa_jsc_social_setting['."twitter".']', 
	        array(
	        'label'    => __( 'Twitter Profile URL', 'nasa_jsc' ),
	        'section'  => 'nasa_jsc_social',
	        'settings' => 'nasa_jsc_social_setting['."twitter".']',
	        'type'	=> 'url',
		) ) );
}
add_action('customize_register', 'nasa_jsc_custom_customize_register');
?>