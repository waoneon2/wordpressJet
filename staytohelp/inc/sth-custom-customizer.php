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
        1 => 'Your site styled to match your image',
        2 => 'Branded confirmation emails',
        3 => 'Keep track of your commissions',
        4 => 'Site control panel',
        5 => 'Administration panel',
        6 => 'Customize deals on your home page',
        7 => 'Customizable SEO',
        8 => 'Integrated Google Analytics',
        9 => 'TripAdvisor ratings and reviews',
        );

    //social media
    $media = array (
        1 => 'facebook',
        2 => 'twitter',
        3 => 'google-plus',
    );

    $def_linksocial = array (
        1 => 'https://www.facebook.com/staytohelp/',
        2 => 'https://twitter.com/staytohelp',
        3 => 'https://plus.google.com/u/0/b/116628179203058402481/116628179203058402481'
    );
/**************************************** Add Panels ****************************************/
	$wp_customize->add_panel(
		'sth_panel',
		array(
			'title' => esc_html__('STH Theme Options', 'sth'),
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
            array('default' => 'Turn-key fundraising opportunity')
        );
   	$wp_customize->add_control('content_main_title',array(
        'label'     => 'Title',
        'section'   => 'sth_content_main',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('content_main_subtitle',array('default' => 'Raise funds for your organization selling thousands of hotel rooms all over the world'));
   	$wp_customize->add_control('content_main_subtitle',array(
        'label'     => 'Subtitle',
        'section'   => 'sth_content_main',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('content_main_desc',array('default' => "StayToHelp provides a turn-key hotel booking service that you can advertise to raise money for your non-profit organization.&#13;&#10;Your supporters can book hotels for the same rates as other hotel booking sites they're using today but make your organization money at the same time.&#13;&#10;Our template is fully customizable and easy for you to style to match your own colors and image."));
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
        'default'   => 'right',
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

    for ($count=1; $count <= 9 ; $count++) {
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

    $wp_customize->add_setting('features2_additional_information',array('default'=>'<b>All of our sites include:</b>
    Access to over 200,000 hotels, mobile-ready theme, special mobile rates, customer self-service, real-time booking management, custom styling, enable up to 35 languages, enable up to 27 currencies, deal cities for your home page, use your own domain name, branded confirmation emails and 24/7/365 telephone booking support'));
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

    $wp_customize->add_setting( 'demo_ribbon_image',array('default'=>defaultAssetsImage('demo-ribbon-icon')));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'demo_ribbon_image', array(
       'label'    => 'Image Icon',
       'section'  => 'sth_demo_ribbon',
    ) ) );

    $wp_customize->add_setting('demo_ribbon_title',array('default' => 'Take a tour of one of our fundraising sites'));
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

    $wp_customize->add_setting('demo_ribbon_links_url',array('default'=>'https://reservations.staytohelp.com/'));
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

    $wp_customize->add_setting( 'signup_ribbon_image',array('default'=> defaultAssetsImage('signup-ribbon-icon')));
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

    $wp_customize->add_setting('signup_ribbon_links_url',array('default'=>'https://my.staytohelp.com/signup'));
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
    $wp_customize->add_setting( 'hide_how_it_work_section', array(
        'default'   => false,
    ) );
    $wp_customize->add_control('hide_how_it_work_section', array(
        'section'   => 'sth_how_it_work',
        'label'     => 'Hide How It Work Block section?',
        'type'      => 'checkbox'
    ) );

    $wp_customize->add_setting('how_it_work_title',array('default' => 'How our program works'));
    $wp_customize->add_control('how_it_work_title',array(
        'label'     => 'Title',
        'section'   => 'sth_how_it_work',
        'type'      => 'text',
    )); 

    $wp_customize->add_setting('how_it_work_desc',array('default'=>''));
    $wp_customize->add_control('how_it_work_desc', array(
        'label'     => 'Description',
        'section'   => 'sth_how_it_work',
        'type'      => 'textarea',
    ));

    $wp_customize->add_setting('how_it_work_content_title',array('default' => 'Fundraising made easy'));
    $wp_customize->add_control('how_it_work_content_title',array(
        'label'     => 'Content Title',
        'section'   => 'sth_how_it_work',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('how_it_work_content',array('default'=>'StayToHelp offers you a turn-key fundraising solution that converts hotel bookings into commission payments to your non-profit organization. When you offer your StayToHelp site to your supporters, they can make hotel bookings on your site for the same rates as other global travel websites. StayToHelp then passes a commission on to you for a percentage of the booking revenue (before taxes and fees).<p></p>This service is free for eligible non-profit organizations. All you need to do is promote your site with supporters of your organization. This fundraising program is based on volume of bookings. The more bookings sold on your site in a given month, the higher your commission payments will be; typically between 2% and 4% per booking. We would love to work with you to bring in more money for your organization.<a href="https://fundraising.staytohelp.com/signup"> Sign up today</a>'));
    $wp_customize->add_control('how_it_work_content', array(
        'label'     => 'Content',
        'section'   => 'sth_how_it_work',
        'type'      => 'textarea',
    ));

    $wp_customize->add_setting('how_it_work_quote_title',array('default'=>'Our philosophy'));
    $wp_customize->add_control('how_it_work_quote_title',array(
        'label'     => 'Quote Title',
        'section'   => 'sth_how_it_work',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('how_it_work_quote',array('default'=>'      We love to help organizations raise funds by selling travel services people want.'));
    $wp_customize->add_control('how_it_work_quote', array(
        'label'     => 'Quote',
        'section'   => 'sth_how_it_work',
        'type'      => 'textarea',
    ));

    $wp_customize->add_setting( 'how_it_work_image_profile', array(
        'default'   => defaultAssetsImage('how-it-work-profile'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'how_it_work_image_profile', array(
       'label'      => 'Image Profile Source',
       'section'    => 'sth_how_it_work',
    ) ) );

    $wp_customize->add_setting('how_it_work_quote_source',array('default'=>'Chad Baron'));
    $wp_customize->add_control('how_it_work_quote_source',array(
        'label'     => 'Source',
        'section'   => 'sth_how_it_work',
        'type'      => 'text',
    ));

    $wp_customize->add_setting('how_it_work_company',array('default'=>'Owner - StayToHelp.com'));
    $wp_customize->add_control('how_it_work_company',array(
        'label'     => 'Company',
        'section'   => 'sth_how_it_work',
        'type'      => 'text',
    ));

    // Footer
    $wp_customize->add_setting( 'footer_logo', array(
        'default'   => defaultAssetsImage('footer-setting'),
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
       'label'      => 'Footer Logo',
       'section'    => 'sth_footer',
    ) ) );

    $wp_customize->add_setting('footer_copyright',array('default'=>'© StayToHelp.com'));
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
    $contact_us_content = 'If you would like to discuss how this fundraising opportunity can work for your organization, get in touch with us.';
    $contact_us_site = 'StayToHelp.com';
    $contact_us_address = 'Bellingham, WA, 98225';
    $contact_us_email = 'admin@StayToHelp.com';


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