<?php
add_action('customize_register','sth_custom_customizer');

function sth_custom_customizer ($wp_customize){
    //features 1

    $def_features1title = array (
        1 => 'Site Setup is Easy',
        2 => 'Easy To Customize',
        3 => 'Easy To Understand Commissions'
    );

    $def_features1desc = array (
        1 => 'Be up and running in less than a day',
        2 => 'Use your own colors and branding&#13;&#10;Use your own domain name&#13;&#10;Choose to display up to 35 languages&#13;&#10;Shop and book in up to 27 currencies',
        3 => 'Earn up to 5% commission per booking&#13;&#10;Keep track of your bookings with your full booking dashboard'
    );

    //features 2
    $def_feature2title = array(
        1 => 'Your site your brand',
        2 => 'Branded confirmation emails',
        3 => 'You can manage all your bookings',
        4 => 'Customer booking management',
        5 => 'Site control panel',
        6 => 'Administration panel',
        7 => 'Customize deals on your home page',
        8 => 'Customizable SEO',
        9 => 'Integrate Google Analytics',
        10 => 'TripAdvisor ratings and reviews',
        );

    //social media
    $media = array (
        1 => 'facebook',
        2 => 'twitter',
        3 => 'google-plus',
    );

    $def_linksocial = array (
        1 => 'https://www.facebook.com/ezbookingsite/',
        2 => 'https://twitter.com/ezbookingsite',
        3 => 'https://plus.google.com/u/0/b/117233358843403602864/117233358843403602864'
    );
    
/**************************************** Add Panels ****************************************/
	$wp_customize->add_panel(
		'sth_panel',
		array(
			'title' => esc_html__('EBS Theme Options', 'sth'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			)
		);

/**************************************** Add Sections ****************************************/

    // main content
    $wp_customize->add_section('sth_content_main',array(
        'title' 		=> __('Content Main','sth'),
        'description'   => __('Select the Image, Title and Description to display in Content Main section','sth'),
        'priority' 		=> 1,
        'panel' 		=> 'sth_panel'
    ));

    // Features 1
    $wp_customize->add_section('sth_features1',array(
        'title'         => __('Features 1','sth'),
        'description'   => __('Select the Image, Title and Description to display in Features section','sth'),
        'priority'      => 2,
        'panel'         => 'sth_panel'
    ));

    // Features 2
    $wp_customize->add_section('sth_features2',array(
        'title'         => __('Features 2','sth'),
        'description'   => __('Select the Image, Title and Description to display in Features section','sth'),
        'priority'      => 3,
        'panel'         => 'sth_panel'
    ));

    // Demo Ribbon
    $wp_customize->add_section('sth_demo_ribbon',array(
        'title'         => __('Demo Ribbon','sth'),
        // 'description'   => __('Select the Image, Title and Description to display in Demo Ribbon section','sth'),
        'priority'      => 4,
        'panel'         => 'sth_panel'
    ));

    // Sign Up Ribbon
    $wp_customize->add_section('sth_signup_ribbon',array(
        'title'         => __('Sign Up Ribbon','sth'),
        // 'description'   => __('Select the Image, Title and Description to display in Sign Up Ribbon section','sth'),
        'priority'      => 5,
        'panel'         => 'sth_panel'
    ));

    // how its work block
    $wp_customize->add_section('sth_how_it_work',array(
        'title'         => __('How It Work Block','sth'),
        'description'   => __('','sth'),
        'priority'      => 6,
        'panel'         => 'sth_panel'
    ));

    // Contact Us
        $wp_customize->add_section('contact_us',array(
            'title'         => __('Contact Us','sth'),
            'description'   => __('','sth'),
            'priority'      => 7,
            'panel'         => 'sth_panel'
        ));

    // Footer
    $wp_customize->add_section('sth_footer',array(
        'title'         => __('Footer Setting','sth'),
        'description'   => __('','sth'),
        'priority'      => 8,
        'panel'         => 'sth_panel'
    ));

/************************************ Add Settings & Control **********************************/

   // main content
    $wp_customize->add_setting( 'content_main_image', array(
        'default'	=> defaultAssetsImage('content-main'),
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_main_image', array(
	   'label'   	=> 'Image Background for Containt Main',
	   'section' 	=> 'sth_content_main',
	) ) );

	$wp_customize->add_setting('content_main_title',
            array('default' => 'Start your own hotel booking site')
        );
   	$wp_customize->add_control('content_main_title',array(
        'label'     => 'Title',
        'section'   => 'sth_content_main',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('content_main_subtitle',array('default' => 'Earn commission selling thousands of hotel rooms all over the world'));
   	$wp_customize->add_control('content_main_subtitle',array(
        'label'     => 'Subtitle',
        'section'   => 'sth_content_main',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('content_main_desc',array('default' => '&nbsp;EasyBookingSite provides a turn-key hotel booking website template that you can use for your travel business.&#13;&#10;You can be brand new to the travel industry or a seasoned professional looking for an easier way to sell hotel rooms.&#13;&#10;Our template is fully customizable and easy for you to style to match your own colors and brand image.'));
   	$wp_customize->add_control('content_main_desc', array(
        'label'     => 'Description',
        'section'   => 'sth_content_main',
        'type'      => 'textarea',
    ));

    // Features 1

    for ($count=1; $count <= 3 ; $count++) {
        $wp_customize->add_setting( 'features1_image'.$count, array(
            'default' => defaultAssetsImage('feature-one')[$count],
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'features1_image'.$count, array(
           'label'          => __( 'Features #'.$count, 'textdomain' ),
           'description'    => 'Image Icon',
           'section'        => 'sth_features1',
        ) ) );

        $wp_customize->add_setting('features1_title'.$count, array('default'=>$def_features1title[$count]));
        $wp_customize->add_control('features1_title'.$count,array(
            'description'   => 'Title',
            'section'       => 'sth_features1',
            'type'          => 'text',
        ));

        $wp_customize->add_setting('features1_desc'.$count, array('default'=>$def_features1desc[$count]));
        $wp_customize->add_control('features1_desc'.$count, array(
            'description'   => 'Description',
            'section'       => 'sth_features1',
            'type'          => 'textarea',
        ));
    }

    // Features 2

    $wp_customize->add_setting( 'features2_image', array(
        'default'   => defaultAssetsImage('feature-two-image'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'features2_image', array(
       'label'      => 'Select Image',
       'section'    => 'sth_features2',
    ) ) );

    $wp_customize->add_setting( 'image_position', array(
        'default'   => 'left',
    ) );

    $wp_customize->add_control( 'image_position', array(
        'label'     => 'Image Position',
        'section'   => 'sth_features2',
        'type'      => 'radio',
        'choices'   => array(
            'right'     => 'Right',
            'left'      => 'Left',
        ),
    ) );

    for ($count=1; $count <= 10 ; $count++) {
        $wp_customize->add_setting( 'features2_image_icon'.$count, array(
            'default' => defaultAssetsImage('feature-two')[$count],
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'features2_image_icon'.$count, array(
           'label'          => __( 'Features #'.$count, 'textdomain' ),
           'description'    => 'Image Icon',
           'section'        => 'sth_features2',
        ) ) );

        $wp_customize->add_setting('features2_title'.$count, array('default'=>$def_feature2title[$count]));
        $wp_customize->add_control('features2_title'.$count,array(
            'description'   => 'Title',
            'section'       => 'sth_features2',
            'type'          => 'text',
        ));
    }

    $wp_customize->add_setting('features2_additional_information',array('default'=>''));
    $wp_customize->add_control('features2_additional_information', array(
        'label'     => 'Additional Information',
        'section'   => 'sth_features2',
        'type'      => 'textarea',
    ));

    // Demo Ribbon
    $wp_customize->add_setting( 'demo_ribbon_image_background', array(
        'default'   => defaultAssetsImage('demo-ribbon-bg'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'demo_ribbon_image_background', array(
       'label'      => 'Image Background for Demo Ribbon',
       'section'    => 'sth_demo_ribbon',
    ) ) );

    $wp_customize->add_setting( 'demo_ribbon_image',array('default' => defaultAssetsImage('demo-ribbon-icon')));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'demo_ribbon_image', array(
       'label'    => 'Image Icon',
       'section'  => 'sth_demo_ribbon',
    ) ) );

    $wp_customize->add_setting('demo_ribbon_title',array('default' => 'Take a tour of one of our template sites'));
    $wp_customize->add_control('demo_ribbon_title',array(
        'label'     => 'Title',
        'section'   => 'sth_demo_ribbon',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('demo_ribbon_desc',array('default' => 'This is a live site, you can make a real booking'));
    $wp_customize->add_control('demo_ribbon_desc', array(
        'label'     => 'Description',
        'section'   => 'sth_demo_ribbon',
        'type'      => 'textarea',
    ));

    $wp_customize->add_setting('demo_ribbon_links_url',array('default'=>'https://needtobook.com/'));
    $wp_customize->add_control( 'demo_ribbon_links_url', array(
        'label'   => 'Insert Link',
        'section' => 'sth_demo_ribbon',
        'type'    => 'link'
    ) );

    $wp_customize->add_setting('demo_ribbon_links_text',array('default' => 'Demo'));
    $wp_customize->add_control( 'demo_ribbon_links_text', array(
        'label'   => 'Insert Link Text',
        'section' => 'sth_demo_ribbon',
        'type'    => 'text'
    ) );

    // Sign Up Ribbon
    $wp_customize->add_setting( 'signup_ribbon_image_background', array(
        'default'   => defaultAssetsImage('signup-ribbon-bg'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'signup_ribbon_image_background', array(
       'label'      => 'Image Background for Sign Up Ribbon',
       'section'    => 'sth_signup_ribbon',
    ) ) );

    $wp_customize->add_setting( 'signup_ribbon_image',array('default' => defaultAssetsImage('signup-ribbon-icon')));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'signup_ribbon_image', array(
       'label'    => 'Image Icon',
       'section'  => 'sth_signup_ribbon',
    ) ) );

    $wp_customize->add_setting('signup_ribbon_title',array('default'=>'Like what you see?'));
    $wp_customize->add_control('signup_ribbon_title',array(
        'label'     => 'Title',
        'section'   => 'sth_signup_ribbon',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('signup_ribbon_desc',array('default'=>'Sign up today'));
    $wp_customize->add_control('signup_ribbon_desc', array(
        'label'     => 'Description',
        'section'   => 'sth_signup_ribbon',
        'type'      => 'textarea',
    ));

    $wp_customize->add_setting('signup_ribbon_links_url',array('default'=>'https://my.ezbookingsite.com/signup?pp=standard'));
    $wp_customize->add_control( 'signup_ribbon_links_url', array(
        'label'   => 'Insert Link',
        'section' => 'sth_signup_ribbon',
        'type'    => 'link'
    ) );

    $wp_customize->add_setting('signup_ribbon_links_text',array('default' => 'Sign Up'));
    $wp_customize->add_control( 'signup_ribbon_links_text', array(
        'label'   => 'Insert Link Text',
        'section' => 'sth_signup_ribbon',
        'type'    => 'text'
    ) );

    // how its work block
    // $wp_customize->add_setting( 'hide_how_it_work_section', array(
    //     'default'   => false,
    //     'transport' => 'postMessage'
    // ) );
    // $wp_customize->add_control('hide_how_it_work_section', array(
    //     'section'   => 'sth_how_it_work',
    //     'label'     => 'Hide How It Work Block section?',
    //     'type'      => 'checkbox'
    // ) );

    // $wp_customize->add_setting('how_it_work_title',array('default'=>''));
    // $wp_customize->add_control('how_it_work_title',array(
    //     'label'     => 'Title',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'text',
    // ));

    // $wp_customize->add_setting('how_it_work_desc',array('default'=>''));
    // $wp_customize->add_control('how_it_work_desc', array(
    //     'label'     => 'Description',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'textarea',
    // ));

    // $wp_customize->add_setting('how_it_work_content_title',array('default'=>''));
    // $wp_customize->add_control('how_it_work_content_title',array(
    //     'label'     => 'Content Title',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'text',
    // ));

    // $wp_customize->add_setting('how_it_work_content',array('default'=>''));
    // $wp_customize->add_control('how_it_work_content', array(
    //     'label'     => 'Content',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'textarea',
    // ));

    // $wp_customize->add_setting('how_it_work_quote_title',array('default'=>''));
    // $wp_customize->add_control('how_it_work_quote_title',array(
    //     'label'     => 'Quote Title',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'text',
    // ));

    // $wp_customize->add_setting('how_it_work_quote',array('default'=>''));
    // $wp_customize->add_control('how_it_work_quote', array(
    //     'label'     => 'Quote',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'textarea',
    // ));

    // $wp_customize->add_setting( 'how_it_work_image_profile', array(
    //     'default'   => '',
    // ) );
    // $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'how_it_work_image_profile', array(
    //    'label'      => 'Image Profile Source',
    //    'section'    => 'sth_how_it_work',
    // ) ) );

    // $wp_customize->add_setting('how_it_work_quote_source',array('default'=>''));
    // $wp_customize->add_control('how_it_work_quote_source',array(
    //     'label'     => 'Source',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'text',
    // ));

    // $wp_customize->add_setting('how_it_work_company',array('default'=>''));
    // $wp_customize->add_control('how_it_work_company',array(
    //     'label'     => 'Company',
    //     'section'   => 'sth_how_it_work',
    //     'type'      => 'text',
    // ));

    // Footer
    $wp_customize->add_setting( 'footer_logo', array(
        'default'   => defaultAssetsImage('footer-setting'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
       'label'      => 'Footer Logo',
       'section'    => 'sth_footer',
    ) ) );

    $wp_customize->add_setting('footer_copyright',array('default'=>'© EasyBookingSite.com'));
    $wp_customize->add_control('footer_copyright',array(
        'label'     => 'Copyright',
        'section'   => 'sth_footer',
        'type'      => 'text',
    ));

    for ($m=1; $m <= 3 ; $m++) {
        if ($m == 1) {
            $label = "Media Sosial Link";
        } else { $label = '';}
        $wp_customize->add_setting('footer_media_'.$media[$m], array('default'=>$def_linksocial[$m]));
        $wp_customize->add_control( 'footer_media_'.$media[$m], array(
            'label'         => $label,
            'description'   => 'Insert Url for '.$media[$m],
            'section'       => 'sth_footer',
            'type'          => 'url'
        ) );
    }

    // Contact Us

    $contact_us_title = 'Contact Us';
    $contact_us_desc = 'We look forward to the opportunity to get to work with you on your hotel booking website. Let us know how we can assist you.';
    $contact_us_content = 'If you have a website project you would like to discuss, get in touch with us.';
    $contact_us_site = 'EasyBookingSite.com';
    $contact_us_address = 'Bellingham, WA, 98225';
    $contact_us_email = 'admin@EZBookingSite.com';


        $wp_customize->add_setting('contact_us_title',array('default'=>$contact_us_title));
        $wp_customize->add_control('contact_us_title',array(
            'label'     => 'Title',
            'section'   => 'contact_us',
            'type'      => 'text',
        ));

        $wp_customize->add_setting('contact_us_desc',array('default'=>$contact_us_desc));
        $wp_customize->add_control('contact_us_desc', array(
            'label'     => 'Description',
            'section'   => 'contact_us',
            'type'      => 'textarea',
        ));

        $wp_customize->add_setting('contact_us_content',array('default'=>$contact_us_content));
        $wp_customize->add_control('contact_us_content', array(
            'label'     => 'Content',
            'section'   => 'contact_us',
            'type'      => 'textarea',
        ));

        $wp_customize->add_setting('contact_us_site',array('default'=>$contact_us_site));
        $wp_customize->add_control('contact_us_site',array(
            'label'     => 'website',
            'section'   => 'contact_us',
            'type'      => 'text',
        ));

        $wp_customize->add_setting('contact_us_address',array('default'=>$contact_us_address));
        $wp_customize->add_control('contact_us_address',array(
            'label'     => 'Address',
            'section'   => 'contact_us',
            'type'      => 'text',
        ));

        $wp_customize->add_setting('contact_us_email',array('default'=>$contact_us_email));
        $wp_customize->add_control('contact_us_email',array(
            'label'     => 'e-mail',
            'section'   => 'contact_us',
            'type'      => 'text',
        ));

        $forms = RGFormsModel::get_forms( true, 'title');
        if(!empty($forms)){
            foreach( $forms as $form ):
                $select[$form->id]= $form->title;
            endforeach;

            $wp_customize->add_setting( 'gravity_form', array(
            'default'  => 'hide',
            ) );
            $wp_customize->add_control( 'gravity_form', array(
                'label'  => 'Form',
                'section'  => 'contact_us',
                'type'   => 'select',
                'choices'  => $select,
            ) );
        }
}