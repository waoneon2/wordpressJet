<?php

function default_content_customizer($name_of_section){
    $content_html = '';
    if($name_of_section == "BUE"){
        $content_html .= '<p>Tesoro is committed to reaching an agreement and continues to bargain in good faith at each location.</p>';
        $content_html .= '<p><a href="#" class="btn-primary">HAVE QUESTIONS?</a></p>';
        $content_html .= '<p><a href="#" class="btn-primary">SPECIFIC LOCATION INFO</a></p>';
        $content_html .= '<p><a href="#" class="btn-primary">LETTERS FROM REFINERY MANAGERS</a></p>';
    }
    if($name_of_section == "RFU"){
        $content_html .= '<p>If you would like to recieve regular updates in your email inbox, click the button bellow.</p>';
        $content_html .= '<p><a href="#" class="btn-primary">SIGN UP NOW</a></p>';
    }

    return $content_html;
}

add_action('customize_register','andeavor_custom_customizer');

function andeavor_custom_customizer ($wp_customize){

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
            $drop_category = str_replace( '<select', '<select style="width:100%;" ' . $this->get_link(), $drop_category );

            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s</label>',
                $this->label,
                $this->description,
                $drop_category
            );
        }
    }

    class WP_Customize_Control_Multiple_Select extends WP_Customize_Control {

            public $type = 'multiple-select';

            public function render_content() {

                if ( empty( $this->choices ) ) return; ?>

                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
                        <?php
                        if(is_array($this->value())){
                            foreach ( $this->choices as $value => $label ) {
                                $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                                echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                            }
                        }
                        ?>
                    </select>
                </label><?php
            }
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

/**************************************** Add Panels ****************************************/
	$wp_customize->add_panel(
		'andeavor_panel',
		array(
			'title'          => esc_html__('Andeavor Theme Options', 'andeavor'),
			'description'    => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			)
		);

/**************************************** Add Sections ****************************************/
    // Logo
    $wp_customize->add_section('add_logos',array(
        'title'         => __('Add Logo','andeavor'),
        'priority'      => 1,
        'panel'         => 'andeavor_panel'
    ));

    // Header
    $wp_customize->add_section('andeavor_header',array(
        'title'         => __('Header Information','andeavor'),
        'priority'      => 2,
        // 'description'   => __('Contents for display on box content homepage'),
        'panel'         => 'andeavor_panel'
    ));
    
    // Template Locations
    $wp_customize->add_section('andeavor_category_locations',array(
        'title'         => __('Template Locations','andeavor'),
        'description'   => __('Selected category will be displayed on Template Locations','andeavor'),
        'priority'      => 4,
        'panel'         => 'andeavor_panel'
    ));

    // Template FAQ
    $wp_customize->add_section('andeavor_category_faq',array(
        'title'         => __('Template FAQ','andeavor'),
        'description'   => __('Selected category will be displayed on Template FAQ','andeavor'),
        'priority'      => 5,
        'panel'         => 'andeavor_panel'
    ));

    // Template Latest Update
    $wp_customize->add_section('andeavor_category_latest_update',array(
        'title'         => __('Template Latest Update','andeavor'),
        'description'   => __('Selected category will be displayed on Template Latest Update','andeavor'),
        'priority'      => 6,
        'panel'         => 'andeavor_panel'
    ));

    // Template Our Approach
    $wp_customize->add_section('andeavor_our_approach',array(
        'title'         => __('Template Our Approach','andeavor'),
        // 'description'   => __('Insert Link on Template Our Approach','andeavor'),
        'priority'      => 7,
        'panel'         => 'andeavor_panel'
    ));

    // Template News of Interest
    $wp_customize->add_section('andeavor_category_news_interest',array(
        'title'         => __('Template News of Interest','andeavor'),
        'description'   => __('Selected category will be displayed on Template News of Interest','andeavor'),
        'priority'      => 8,
        'panel'         => 'andeavor_panel'
    ));

    // Template Register
    $wp_customize->add_section('andeavor_register',array(
        'title'         => __('Template Register','andeavor'),
        'description'   => __('Selected gravity form will be displayed on Template FAQ','andeavor'),
        'priority'      => 9,
        'panel'         => 'andeavor_panel'
    ));

    // Template Images
    $wp_customize->add_section('andeavor_category_img',array(
        'title'         => __('Template Images','andeavor'),
        'description'   => __('Selected category will be displayed on Template Images','andeavor'),
        'priority'      => 10,
        'panel'         => 'andeavor_panel'
    ));

    // Footer
    $wp_customize->add_section('andeavor_footer',array(
        'title'         => __('Footer Setting','andeavor'),
        'description'   => __('','andeavor'),
        'priority'      => 11,
        'panel'         => 'andeavor_panel'
    ));


/************************************ Add Settings & Control **********************************/

    // Logo 
    for ($i=0; $i < 15; $i++) {
        // set logo
        $wp_customize->add_setting( 'andeavor_logo['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'andeavor_logo['.$i.']',
            array(
            'label'    => __( 'Upload Logo', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'andeavor_logo['.$i.']'
        ) ) );

        $wp_customize->add_setting( 'andeavor_logo_title['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'andeavor_logo_title['.$i.']',
            array(
            'label'    => __( 'Title', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'andeavor_logo_title['.$i.']',
            'type'     => 'text',
        ) ) );

        $wp_customize->add_setting( 'andeavor_logo_alt['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Textarea_Control(
            $wp_customize,
            'andeavor_logo_alt['.$i.']',
            array(
            'label'    => __( 'Alt/Description', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'andeavor_logo_alt['.$i.']',
            'type'     => 'textarea',
        ) ) );

        $wp_customize->add_setting('andeavor_link_logos['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'andeavor_link_logos['.$i.']',
            array(
                'label'      => __( 'Link', 'uc' ),
                'section'    => 'add_logos',
                'settings'   => 'andeavor_link_logos['.$i.']',
                'type'       => 'url',
            ) )
        );
    }
    
    // Header
    $wp_customize->add_setting('header_information',array('default'=>'Labor Information'));
    $wp_customize->add_control('header_information',array(
        'label'     => 'Insert Header Information Text',
        'section'   => 'andeavor_header',
        'type'      => 'text',
    ));

    // Template Locations
    $wp_customize->add_setting('category_locations');
    $wp_customize->add_control(
    new WP_Customize_Control_Multiple_Select(
           $wp_customize,
           'category_locations',
           array(
               'label'     => 'Choose category',
               'section'   => 'andeavor_category_locations',
               'setting'   => 'category_locations',
               'type'      => 'multiple-select',
               'choices'   => andeavor_cats()
           )
       )
    );

    // Template FAQ
    $wp_customize->add_setting('category_faq');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'category_faq',
            array(
                'label'     => 'Choose category',
                'section'   => 'andeavor_category_faq',
                'setting'   => 'category_faq'
            )
        )
    );

    // Template Latest Update
    $wp_customize->add_setting('category_latest_update');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'category_latest_update',
            array(
                'label'     => 'Choose category',
                'section'   => 'andeavor_category_latest_update',
                'setting'   => 'category_latest_update'
            )
        )
    );

    // Template Our Approach
    $wp_customize->add_setting('category_our_approach');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'category_our_approach',
            array(
                'label'     => 'Choose category',
                'section'   => 'andeavor_our_approach',
                'setting'   => 'category_our_approach'
            )
        )
    );

    $wp_customize->add_setting('link_our_approach',array('default'=>'https://www.google.co.id'));
    $wp_customize->add_control('link_our_approach',array(
        'label'     => 'Link for Our Approach button',
        'section'   => 'andeavor_our_approach',
        'type'      => 'url',
    ));

    $wp_customize->add_setting('button_text_our_approach',array('default'=>'FRIENDS AND FAMILY FACT SHEET'));
    $wp_customize->add_control('button_text_our_approach',array(
        'label'     => 'Title for Our Approach button',
        'section'   => 'andeavor_our_approach',
        'type'      => 'text',
    ));

    // Template News of Interest
    $wp_customize->add_setting('category_news_interest');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'category_news_interest',
            array(
                'label'     => 'Choose category',
                'section'   => 'andeavor_category_news_interest',
                'setting'   => 'category_news_interest'
            )
        )
    );

    // Template Register
    if(class_exists('RGFormsModel')){
        $forms = RGFormsModel::get_forms( true, 'title' );
        if(!empty($forms)){
            foreach( $forms as $form ):
                $select[$form->id]= $form->title;
            endforeach;

            $wp_customize->add_setting( 'gravity_form');
            $wp_customize->add_control( 'gravity_form', array(
                'label'     => 'Select Form',
                'section'   => 'andeavor_register',
                'type'      => 'select',
                'choices'   => $select,
            ) );
        }
    }
    

    // Template Images
    $wp_customize->add_setting('category_img');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'category_img',
            array(
                'label'     => 'Choose category',
                'section'   => 'andeavor_category_img',
                'setting'   => 'category_img'
            )
        )
    );

    // Footer
    $wp_customize->add_setting('footer_copyright',array('default'=>'Andeavor Corporation.'));
    $wp_customize->add_control('footer_copyright',array(
        'label'     => 'Copyright',
        'section'   => 'andeavor_footer',
        'type'      => 'text',
    ));
}

function andeavor_cats() {
  $cats = array();
  $cats[0] = " - Select Categories - ";
  foreach ( get_categories() as $categories => $category ) {
    $cats[$category->term_id] = $category->name;
  }
  return $cats;
}