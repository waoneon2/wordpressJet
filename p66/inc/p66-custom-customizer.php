<?php
add_action('customize_register','p66_custom_customizer');

function p66_custom_customizer ($wp_customize){


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

    class WP_Customize_refinery_category extends WP_Customize_Control {
        public function render_content() {

                $drop_page = wp_dropdown_pages(
                    array(
                        'selected' => $this->value(),
                        'name' => $this->id,
                        'id' => $this->id,
                        'class' => 'refinery-select-page',
                        'meta_key' => '_wp_page_template',
                        'meta_value' => 'template-refinery-category.php',
                        'post_type' => 'page',
                        'echo' => '0',
                    )
                );
            $drop_page = str_replace( '<select', '<select ' . $this->get_link(), $drop_page );

            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $drop_page
            );
        }
    }

/***** Add Panels *****/
	$wp_customize->add_panel(
		'p66_panel',
		array(
			'title' => esc_html__('P66 Theme Options', 'p66'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			)
		);


/**************************************** Add Sections ****************************************/

    // header customizer
/*    $wp_customize->add_section('p66_header_link',array(
        'title' => __('Header Link','p66'),
        'description'   => __('You have to choose page for contact and career','p66'),
        'priority' => 0,
        'panel' => 'p66_panel'
    ));*/

   	// Homepage Hero category
    $wp_customize->add_section('p66__homepage_hero',array(
        'title' => __('Homepage Hero Slider','p66'),
        'description'   => __('You have to set category for all type of hero. For use the hero just create new post and select the category hero type which you have been set','p66'),
        'priority' => 1,
        'panel' => 'p66_panel'
    ));

    // Homepage Feature category
    $wp_customize->add_section('p66_homepage_feature',array(
        'title' => __('Homepage Feature Stories','p66'),
        'description'   => __('Selected category will be displayed as Feature Stories','p66'),
        'priority' => 2,
        'panel' => 'p66_panel'
    ));
    // Homepage Promo
    $wp_customize->add_section('p66_homepage_promo',array(
        'title' => __('Homepage Promo Full Width Section','p66'),
        'description'   => __('Select the page to display in promo section','p66'),
        'priority' => 3,
        'panel' => 'p66_panel'
    ));
    // Homepage New release
    $wp_customize->add_section('p66_homepage_news_release',array(
        'title' => __('Homepage News Release','p66'),
        'description'   => __('Selected category will be displayed as news release','p66'),
        'priority' => 4,
        'panel' => 'p66_panel'
    ));
    // SDS Footer
    $wp_customize->add_section('p66_sds_footer',array(
        'title' => __('SDS Footer','p66'),
        'description'   => __('This textarea will appear in the end of the SDS Page.','p66'),
        'priority' => 13,
        'panel' => 'p66_panel'
    ));
    // Contact Us
    $wp_customize->add_section('p66_contact_us',array(
        'title' => __('Contact Us','p66'),
        'description'   => __('You have to set your contact info','p66'),
        'priority' => 5,
        'panel' => 'p66_panel'
    ));
    // Contact External Links
    $wp_customize->add_section('p66_contact_external_links',array(
        'title' => __('Contact External Links','p66'),
        'description'   => __('External Links','p66'),
        'priority' => 6,
        'panel' => 'p66_panel'
    ));
    //Businesses Services
    $wp_customize->add_section('p66_businesses_services',array(
        'title' => __('Businesses Services','p66'),
        'description'   => __('Select the page to display in Businesses Services section','p66'),
        'priority' => 7,
        'panel' => 'p66_panel'
    ));
    //Businesses Services
    $wp_customize->add_section('p66_refinery_archive',array(
        'title' => __('Refinery Archive Page','p66'),
        'description'   => __('Select which page to display all refinery page. If nothing show up, you must create page and set the page tempalate to "Refinary Archive"','p66'),
        'priority' => 12,
        'panel' => 'p66_panel'
    ));
    // Sustainability Video
    $wp_customize->add_section('p66_sustainability_video',array(
        'title' => __('Sustainability Video','p66'),
        'description'   => __('Select the Image, Link and Description to display in Sustainability Page','p66'),
        'priority' => 8,
        'panel' => 'p66_panel'
    ));
    // Sustainability Promo
    $wp_customize->add_section('p66_sustainability_promo',array(
        'title' => __('Sustainability Promo','p66'),
        'description'   => __('Select the Image, and Description to display in Sustainability Page','p66'),
        'priority' => 9,
        'panel' => 'p66_panel'
    ));
    // Sustainability CEO
    $wp_customize->add_section('p66_sustainability_ceo',array(
        'title' => __('Sustainability CEO','p66'),
        'description'   => __('Select the Image, and Description to display in Sustainability Page','p66'),
        'priority' => 10,
        'panel' => 'p66_panel'
    ));

    // footer customizer
    $wp_customize->add_section('p66_footer',array(
        'title' => __('Footer Setting','p66'),
        'description'   => __('','p66'),
        'priority' => 99,
        'panel' => 'p66_panel'
    ));



/**************************************** Add Settings & Control ****************************************/

   //header link

/*    $wp_customize->add_setting('header_contact');
        $wp_customize->add_control( 'header_contact', array(
            'label'    => __( 'Contact', 'textdomain' ),
            'description' => 'Select page',
            'section'  => 'p66_header_link',
            'type'     => 'dropdown-pages'
        ) );
    $wp_customize->add_setting('header_careers');
        $wp_customize->add_control( 'header_careers', array(
            'label'    => __( 'Careers', 'textdomain' ),
            'description' => 'Select page',
            'section'  => 'p66_header_link',
            'type'     => 'dropdown-pages'
        ) );*/

   // Homepage hero category
	$hero_class = array (
		1 => 'Fully Shaded',
		2 => 'Fully Shaded Red',
		3 => 'Left Dark Gradient',
		4 => 'Left White Gradient'
		);
	for ($y=1; $y <=4 ; $y++) {
	   $wp_customize->add_setting('homepage_hero_cat_'.$y);
	   $wp_customize->add_control(
	    new WP_Customize_dropdown_category(
	            $wp_customize,
	            'homepage_hero_cat_'.$y,
	            array(
	                'label' => 'Category for hero '.$hero_class[$y],
	                'section' => 'p66__homepage_hero',
	                'setting' => 'homepage_hero_cat_'.$y
	            )
	        )
	    );
	}


    // Homepage Feature category
   $wp_customize->add_setting('homepage_feature_cat');
   $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'homepage_feature_cat',
            array(
                'label' => 'Choose category',
                'section' => 'p66_homepage_feature',
                'setting' => 'homepage_feature_cat'
            )
        )
    );

   // Homepage Promo
   for ($i=0; $i < 3 ; $i++) {
   	$count = $i + 1;
   	$wp_customize->add_setting('homepage_promo_'.$count);
		$wp_customize->add_control( 'homepage_promo_'.$count, array(
			'label'    => __( 'Full width Promo #'.$count, 'textdomain' ),
			'description' => 'Select page',
			'section'  => 'p66_homepage_promo',
			'type'     => 'dropdown-pages'
		) );
	$wp_customize->add_setting('homepage_promo_button'.$count,array('default' => 'Detail'));
		$wp_customize->add_control( 'homepage_promo_button'.$count, array(
			// 'label'    => __( 'Insert Promo Button Text #'.$count, 'textdomain' ),
			'description' => 'Insert Button Text',
			'section'  => 'p66_homepage_promo',
			'type'     => 'text'
		) );
   }

    // Homepage news Release
   $wp_customize->add_setting('homepage_news_release');
   $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'homepage_news_release',
            array(
                'label' => 'Choose category',
                'section' => 'p66_homepage_news_release',
                'setting' => 'homepage_news_release'
            )
        )
    );

   // SDS Footer
   $wp_customize->add_setting( 'sds_footer', array(
     'capability' => 'edit_theme_options',
     'default' => 'Enter Text',
     'sanitize_callback' => 'sanitize_text_field',
   ) );
   $wp_customize->add_control( 'sds_footer', array(
     'type' => 'textarea',
     'section' => 'p66_sds_footer', // // Add a default or your own section
     'label' => 'Custom Text Area',
   ) );

   // Contact Us
   $wp_customize->add_setting('contact_us_title');
   $wp_customize->add_control('contact_us_title',array(
        'label'     => 'Title',
        'section'   => 'p66_contact_us',
        'type'      => 'text',
    ));
   $wp_customize->add_setting('contact_us_desc');
   $wp_customize->add_control('contact_us_desc', array(
        'label'     => 'Description',
        'section'   => 'p66_contact_us',
        'type'      => 'textarea',
    ));
   $wp_customize->add_setting('contact_us_address');
   $wp_customize->add_control('contact_us_address', array(
        'label'     => 'Address',
        'section'   => 'p66_contact_us',
        'type'      => 'textarea',
    ));
   $wp_customize->add_setting('contact_us_phone');
   $wp_customize->add_control('contact_us_phone',array(
        'label'     => 'Phone',
        'section'   => 'p66_contact_us',
        'type'      => 'text',
    ));

   // Contact External Links
   $wp_customize->add_setting('contact_external_links_title');
   $wp_customize->add_control('contact_external_links_title',array(
        'label'     => 'Title',
        'section'   => 'p66_contact_external_links',
        'type'      => 'text',
    ));
   $wp_customize->add_setting('contact_external_links_desc');
   $wp_customize->add_control('contact_external_links_desc', array(
        'label'     => 'Description',
        'section'   => 'p66_contact_external_links',
        'type'      => 'textarea',
    ));

   for ($count=1; $count <= 5 ; $count++) {
    $wp_customize->add_setting('contact_external_links_url'.$count);
        $wp_customize->add_control( 'contact_external_links_url'.$count, array(
            'label'         => __( 'External Link #'.$count, 'textdomain' ),
            'description'   => 'Insert Link',
            'section'       => 'p66_contact_external_links',
            'type'          => 'link'
        ) );
    $wp_customize->add_setting('contact_external_links_text'.$count,array('default' => 'Detail'));
        $wp_customize->add_control( 'contact_external_links_text'.$count, array(
            'description'   => 'Insert Link Text',
            'section'       => 'p66_contact_external_links',
            'type'          => 'text'
        ) );
   }

   for ($count=1; $count <= 4 ; $count++) {
    $wp_customize->add_setting('contact_credit_cards_url'.$count);
        $wp_customize->add_control( 'contact_credit_cards_url'.$count, array(
            'label'         => __( 'Credit Cards #'.$count, 'textdomain' ),
            'description'   => 'Insert Link',
            'section'       => 'p66_contact_external_links',
            'type'          => 'link'
        ) );
    $wp_customize->add_setting('contact_credit_cards_text'.$count,array('default' => 'Detail'));
        $wp_customize->add_control( 'contact_credit_cards_text'.$count, array(
            'description'   => 'Insert Link Text',
            'section'       => 'p66_contact_external_links',
            'type'          => 'text'
        ) );
   }

   // Businesses Services
   for ($i=0; $i < 4 ; $i++) {
    $count = $i + 1;
    $wp_customize->add_setting('business_services'.$count);
        $wp_customize->add_control( 'business_services'.$count, array(
            'label'    => __( 'Businesses Services #'.$count, 'textdomain' ),
            'description' => 'Select page',
            'section'  => 'p66_businesses_services',
            'type'     => 'dropdown-pages'
        ) );
    $wp_customize->add_setting('business_services_text'.$count,array('default' => 'Detail'));
        $wp_customize->add_control( 'business_services_text'.$count, array(
            'description' => 'Insert Link Text',
            'section'  => 'p66_businesses_services',
            'type'     => 'text'
        ) );
   }

   //refinery Archive
    $wp_customize->add_setting('refinery_archive_page');
   $wp_customize->add_control(
    new WP_Customize_refinery_category(
            $wp_customize,
            'refinery_archive_page',
            array(
                'label' => 'Choose page',
                'section' => 'p66_refinery_archive',
                'setting' => 'refinery_archive_page'
            )
        )
    );

   // Sustainability Video
   // Images thumbnails
    $wp_customize->add_setting( 'sustainability_image_video', array(
        'default'        => '',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sustainability_image_video', array(
        'label'   => 'Image Thumbnails',
        'description' => 'Insert Images to display the Videos Thumbnails',
        'section' => 'p66_sustainability_video',
    ) ) );
    // Link Videos
    $wp_customize->add_setting( 'sustainability_link', array(
        'default'        => 'h7PJA3OzOqg',
    ) );
    $wp_customize->add_control('sustainability_link', array(
        'type'     => 'text',
        'label'   => 'Video Youtube ID',
        'description' => 'Insert Youtube ID to Display the Videos',
        'section' => 'p66_sustainability_video',
        'input_attrs' => array(
         'placeholder' => __( 'h7PJA3OzOqg' ),
       ),
     ) );
    // Title Videos
    $wp_customize->add_setting( 'sustainability_title', array(
        'default'        => 'Etiam auctor ex quam, et dignissim',
    ) );
    $wp_customize->add_control('sustainability_title', array(
        'type'     => 'text',
        'label'   => 'Title Video',
        'description' => 'Insert title of the Videos',
        'section' => 'p66_sustainability_video',
     ) );
    // Content Text Videos
   $wp_customize->add_setting( 'sustainability_content_1', array(
     'capability' => 'edit_theme_options',
     'default' => 'Enter Text',
     'sanitize_callback' => 'sanitize_text_field',
   ) );
   $wp_customize->add_control( 'sustainability_content_1', array(
     'type' => 'textarea',
     'label' => 'Content Video',
     'description' => 'Insert content of the Video',
     'section' => 'p66_sustainability_video',
   ) );
   $wp_customize->add_setting( 'sustainability_content_2', array(
     'capability' => 'edit_theme_options',
     'default' => 'Enter Text',
     'sanitize_callback' => 'sanitize_text_field',
   ) );
   $wp_customize->add_control( 'sustainability_content_2', array(
     'type' => 'textarea',
     'section' => 'p66_sustainability_video',
   ) );

   //Sustainability Promo
      // Images thumbnails
       $wp_customize->add_setting( 'sustainability_image_promo', array(
           'default'        => '',
       ) );
       $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sustainability_image_promo', array(
           'label'   => 'Image Thumbnails',
           'section' => 'p66_sustainability_promo',
       ) ) );
       // Title Promo
       $wp_customize->add_setting( 'sustainability_title_promo', array(
           'default'        => 'Fusce posuere',
       ) );
       $wp_customize->add_control('sustainability_title_promo', array(
           'type'     => 'text',
           'label'   => 'Title Promo',
           'description' => 'Insert title of Promo',
           'section' => 'p66_sustainability_promo',
        ) );
       // Content Text Promo
       $wp_customize->add_setting( 'sustainability_content_3', array(
         'capability' => 'edit_theme_options',
         'default' => 'Enter Text',
         'sanitize_callback' => 'sanitize_text_field',
       ) );
       $wp_customize->add_control( 'sustainability_content_3', array(
         'type' => 'textarea',
         'label' => 'Content Promo',
         'description' => 'Insert content of Promo',
         'section' => 'p66_sustainability_promo',
       ) );

       //Sustainability CEO
       // Images thumbnails CEO
           $wp_customize->add_setting( 'sustainability_image_ceo', array(
               'default'        => '',
           ) );
           $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sustainability_image_ceo', array(
               'label'   => 'Image Thumbnails for CEO',
               'section' => 'p66_sustainability_ceo',
           ) ) );
          // Images thumbnails Sign
           $wp_customize->add_setting( 'sustainability_image_sign', array(
               'default'        => '',
           ) );
           $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sustainability_image_sign', array(
               'label'   => 'Image Thumbnails for CEO Sign',
               'section' => 'p66_sustainability_ceo',
           ) ) );
           // Title CEO
           $wp_customize->add_setting( 'sustainability_title_ceo', array(
               'default'        => 'A Message from',
           ) );
           $wp_customize->add_control('sustainability_title_ceo', array(
               'type'     => 'text',
               'label'   => 'Title Ceo',
               'description' => 'Insert title of CEO',
               'section' => 'p66_sustainability_ceo',
            ) );



   // Footer media sosial
    $wp_customize->add_setting('footer_privacy');
        $wp_customize->add_control( 'footer_privacy', array(
            'label'    => __( 'Footer Link', 'p66' ),
            'description' => 'Privacy statement',
            'section'  => 'p66_footer',
            'type'     => 'dropdown-pages'
        ) );
    $wp_customize->add_setting('footer_term');
        $wp_customize->add_control( 'footer_term', array(
            // 'label'    => __( 'Term and Conditions', 'p66' ),
            'description' => 'Term and Conditions',
            'section'  => 'p66_footer',
            'type'     => 'dropdown-pages'
        ) );
    $wp_customize->add_setting('footer_disclosure');
        $wp_customize->add_control( 'footer_disclosure', array(
            // 'label'    => __( 'Transparency in Supply Chains Disclosure', 'p66' ),
            'description' => 'Transparency in Supply Chains Disclosure',
            'section'  => 'p66_footer',
            'type'     => 'dropdown-pages'
        ) );

   $media = array (
        1 => 'facebook',
        2 => 'twitter',
        3 => 'instagram',
        4 => 'youtube'
    );

   for ($m=1; $m <= 4 ; $m++) {
    if ($m == 1) {
        $label = "Media Sosial Link";
    } else { $label = '';}
    $wp_customize->add_setting('footer_media_'.$media[$m]);
        $wp_customize->add_control( 'footer_media_'.$media[$m], array(
            'label' => $label,
            'description' => 'Insert Url for '.$media[$m],
            'section'  => 'p66_footer',
            'type'     => 'url'
        ) );
   }

}
