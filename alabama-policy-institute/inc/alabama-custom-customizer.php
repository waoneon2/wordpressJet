<?php
add_action('customize_register','alpi_custom_customizer');

function alpi_custom_customizer ($wp_customize){

    class WP_Customize_Text_Custom_Control extends WP_Customize_Control {
        public $type = 'custom_input_text';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input width="100%" type="text" maxlength="18" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class WP_Customize_Text_Custom_Control_One extends WP_Customize_Control {
        public $type = 'custom_input_text_one';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input width="100%" type="text" maxlength="15" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class WP_Customize_Text_Custom_Control_Two extends WP_Customize_Control {
        public $type = 'custom_input_text_two';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input width="100%" type="text" maxlength="10" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }



/**************************************** Add Panels ****************************************/

	$wp_customize->add_panel( 'alpi_panel', array(
			'title' => esc_html__('ALPI Theme Options', 'alpi'),
			'description' => '', 'capability' => 'edit_theme_options',
			'theme_supports' => '', 'priority' => 1
			));

/**************************************** Add Sections ****************************************/

    /******** Homepage Hero ********/
    $wp_customize->add_section('homepage_hero',array(
        'title' => __('Homepage Hero','alpi'),
        'priority' => 1,
        'description' => __('Select an Image and Descriptions for displaying on the Homepage hero area of ALABAMA POLICY INSTITUTE website.'),
        'panel' => 'alpi_panel'
    ));

    /******** Homepage CTA-section ********/
    $wp_customize->add_section('homepage_cta',array(
        'title' => __('Homepage CTA Section','alpi'),
        'priority' => 2,
        'description' => __('Select an Image and Descriptions for displaying on the Homepage cta section area of ALABAMA POLICY INSTITUTE website.'),
        'panel' => 'alpi_panel'
    ));

    /******** Footer Image ********/
    $wp_customize->add_section('alpi_footer_image',array(
        'title' => __('Footer Image','alpi'),
        'priority' => 3,
        'description' => __('Select Image for displaying on the footer area of ALABAMA POLICY INSTITUTE website.'),
        'panel' => 'alpi_panel'
    ));

    /******** Footer Information - Contact Us ********/
    $wp_customize->add_section('alpi_footer_information',array(
        'title'         => __('Footer Information','alpi'),
        'description'   => __('This Information will be displays on the footer area of ALABAMA POLICY INSTITUTE website.'),
        'priority'      => 4,
        'panel'         => 'alpi_panel'
    ));
        /******** Footer Information - Social Media ********/
    $media = array (
        1 => 'twitter',
        2 => 'facebook',
        3 => 'youtube',
        4 => 'instagram',
        5 => 'rss',
    );

    $link_social = array (
        1 => 'https://www.twitter.com/',
        2 => 'https://www.facebook.com/?/',
        3 => 'https://www.youtube.com',
        4 => 'https://www.instagram.com',
        5 => 'https://google.com',
    );



/************************************ Add Settings & Control **********************************/

    /******** Homepage Hero - Image ********/
     // Thumbnails
     $wp_customize->add_setting( 'homepage_hero_image', array(
         'default'        => get_template_directory_uri() . '/img/backgrounds/bg--home-hero.jpg',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_hero_image', array(
         'label'   => 'Image Thumbnails',
         'section' => 'homepage_hero',
     ) ) );
     // ALPI Logo
     $wp_customize->add_setting( 'homepage_hero_logo', array(
         'default'        => get_template_directory_uri() . '/img/brandmarks/logo--hero.png',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_hero_logo', array(
         'label'   => 'Image Logo',
         'section' => 'homepage_hero',
     ) ) );

     /******** Homepage Hero - Title ********/
      // Title 1
     $wp_customize->add_setting('homepage_hero_title1', array(
          'default'        => '<b>Strengthening</b> Free Enterprise',
      ) );
     $wp_customize->add_control('homepage_hero_title1',array(
         'label'     => 'Title 1',
         'description'   => 'Insert title on line 1 for homepage title',
         'section'   => 'homepage_hero',
         'type'      => 'text',
     ));
      // Title 2
     $wp_customize->add_setting('homepage_hero_title2', array(
          'default'        => '<b>Defending</b> Limited Government',
      ) );
     $wp_customize->add_control('homepage_hero_title2',array(
         'label'     => 'Title 2',
         'description'   => 'Insert title on line 2 for homepage title',
         'section'   => 'homepage_hero',
         'type'      => 'text',
     ));
      // Title 3
     $wp_customize->add_setting('homepage_hero_title3', array(
          'default'        => '<b>Championing</b> Strong Families',
      ) );
     $wp_customize->add_control('homepage_hero_title3',array(
         'label'     => 'Title 3',
         'description'   => 'Insert title on line 3 for homepage title',
         'section'   => 'homepage_hero',
         'type'      => 'text',
     ));

    /******** Homepage Hero - Link Videos ********/
     // Tittle Button
    $wp_customize->add_setting('hero_vid_button', array(
         'default'        => 'PLAY VIDEO',
     ) );
    $wp_customize->add_control( 
        new WP_Customize_Text_Custom_Control_Two(
            $wp_customize,
            'hero_vid_button',
            array(
                'label'         => 'Title Button',
                'description'   => 'Insert title on hero videos button ',
                'section'       => 'homepage_hero',
                'type'          => 'custom_input_text_two',
            )
        )
    );
     // Button Link
     $wp_customize->add_setting( 'hero_link', array(
         'default'        => 'https://',
     ) );
     $wp_customize->add_control('hero_link', array(
         'type'     => 'url',
         'label'   => 'Insert link',
         'description' => 'Insert link to display the Videos',
         'section' => 'homepage_hero',
         'input_attrs' => array(
          'placeholder' => __( 'https://' ),
        ),
      ) );


     /******** Homepage CTA-section ********/
     /******** CTA Section - Latest ********/
        // Title 1
     $wp_customize->add_setting( 'homepage_title_cta1', array(
         'default'        => 'DAILY CLIPPINGS',
     ) );
    $wp_customize->add_control( new WP_Customize_Text_Custom_Control (
            $wp_customize,
            'homepage_title_cta1', 
            array(
             'type'         => 'custom_input_text',
             'label'        => 'Latest Title',
             'description'  => 'Insert the title of latest cta section',
             'section'      => 'homepage_cta',
            ) 
        )
    );
        // Content 1
     $wp_customize->add_setting( 'homepage_content_cta1', array(
       'capability' => 'edit_theme_options',
       'default' => 'Insert Text',
       'sanitize_callback' => 'sanitize_text_field',
     ) );
     $wp_customize->add_control( 'homepage_content_cta1', array(
       'type' => 'textarea',
       'label' => 'Latest Content',
       'description' => 'Insert the content of latest cta section',
       'section' => 'homepage_cta',
     ) );
      // Tittle Button 1
     $wp_customize->add_setting('homepage_button_cta1', array(
          'default'        => 'VIEW THE LATEST',
      ) );
    $wp_customize->add_control( new WP_Customize_Text_Custom_Control_Two(
            $wp_customize,
            'homepage_button_cta1',
            array(
             'label'        => 'Latest Button Title',
             'description'  => 'Insert title on homepage latest button ',
             'section'      => 'homepage_cta',
             'type'         => 'custom_input_text_two',
            )
        )
    );
       // Image 1
     $wp_customize->add_setting( 'homepage_image_cta1', array(
         'default'        => get_template_directory_uri() . '/img/pics/HP_DailyClippings.jpg',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_image_cta1', array(
         'label'   => 'Latest Image Thumbnails',
         'section' => 'homepage_cta',
     ) ) );


     /******** CTA Section - Events ********/
        // Title 2
     $wp_customize->add_setting( 'homepage_title_cta2', array(
         'default'        => 'EVENTS',
     ) );
     $wp_customize->add_control( new WP_Customize_Text_Custom_Control (
            $wp_customize,
            'homepage_title_cta2', 
            array(
             'type'         => 'custom_input_text',
             'label'        => 'Events Title',
             'description'  => 'Insert the title of events cta section',
             'section'      => 'homepage_cta',
            )
        )
    );
        // Content 2
     $wp_customize->add_setting( 'homepage_content_cta2', array(
       'capability' => 'edit_theme_options',
       'default' => 'Insert Text',
       'sanitize_callback' => 'sanitize_text_field',
     ) );
     $wp_customize->add_control( 'homepage_content_cta2', array(
       'type' => 'textarea',
       'label' => 'Events Content',
       'description' => 'Insert the contents of events cta section',
       'section' => 'homepage_cta',
     ) );
      // Tittle Button 1
     $wp_customize->add_setting('homepage_button_cta2', array(
          'default'        => 'VIEW ALL EVENTS',
      ) );
    $wp_customize->add_control( new WP_Customize_Text_Custom_Control_Two (
            $wp_customize,
            'homepage_button_cta2',
            array(
             'label'        => 'Events Button Title',
             'description'  => 'Insert title on homepage events button ',
             'section'      => 'homepage_cta',
             'type'         => 'custom_input_text_two',
            )
        )
    );
       // Image 2
     $wp_customize->add_setting( 'homepage_image_cta2', array(
         'default'        => get_template_directory_uri() . '/img/pics/HP_Audience.jpg',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_image_cta2', array(
         'label'   => 'Events Image Thumbnails',
         'section' => 'homepage_cta',
     ) ) );

     /******** CTA Section - Downloads ********/
        // Title 3
     $wp_customize->add_setting( 'homepage_title_cta3', array(
         'default'        => 'DOWNLOAD',
     ) );
     $wp_customize->add_control( new WP_Customize_Text_Custom_Control (
            $wp_customize,
            'homepage_title_cta3', 
            array(
             'type'         => 'custom_input_text',
             'label'        => 'Downloads Title',
             'description'  => 'Insert the title of downloads cta section',
             'section'      => 'homepage_cta',
            ) 
        )
    );
        // Content 3
     $wp_customize->add_setting( 'homepage_content_cta3', array(
       'capability' => 'edit_theme_options',
       'default' => 'Insert Text',
       'sanitize_callback' => 'sanitize_text_field',
     ) );
     $wp_customize->add_control( 'homepage_content_cta3', array(
       'type' => 'textarea',
       'label' => ' Downloads Content',
       'description' => 'Insert the contents of downloads cta section',
       'section' => 'homepage_cta',
     ) );
        // Tittle Button 3
     $wp_customize->add_setting('homepage_button_cta3', array(
          'default'        => 'VIEW ALL DOWNLOADS',
      ) );
    $wp_customize->add_control( new WP_Customize_Text_Custom_Control (
            $wp_customize,
            'homepage_button_cta3',
            array(
             'label'        => 'Downloads Button Title',
             'description'  => 'Insert title on homepage downloads button ',
             'section'      => 'homepage_cta',
             'type'         => 'custom_input_text',
            )
        )
    );
       // Image 3
     $wp_customize->add_setting( 'homepage_image_cta3', array(
         'default'        => get_template_directory_uri() . '/img/pics/Download_Image.jpg',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_image_cta3', array(
         'label'   => 'Downloads Image Thumbnails',
         'section' => 'homepage_cta',
     ) ) );


    /******** Footer Image ********/
     // Thumbnails
     $wp_customize->add_setting( 'image_footer_thumbnails', array(
         'default'        => get_template_directory_uri() . '/img/backgrounds/bg--footer.jpg',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_footer_thumbnails', array(
         'label'   => 'Image Thumbnails',
         'section' => 'alpi_footer_image',
     ) ) );
     // ALPI Logo
     $wp_customize->add_setting( 'image_footer_logo', array(
         'default'        => get_template_directory_uri() . '/img/brandmarks/logo--footer.png',
     ) );
     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_footer_logo', array(
         'label'   => 'Image Logo',
         'section' => 'alpi_footer_image',
     ) ) );


      /******** Footer Information - Contact Us ********/
      // Phone Number
    $wp_customize->add_setting('contact_us_phone_number', array(
         'default'        => '(205) 870.9900',
     ) );
    $wp_customize->add_control('contact_us_phone_number',array(
        'label'     => 'Phone Number',
        'section'   => 'alpi_footer_information',
        'type'      => 'text',
    ));
    // E-Mail
    $wp_customize->add_setting('contact_us_email', array(
         'default'        => 'info@alabamapolicy.org',
     ) );
    $wp_customize->add_control('contact_us_email',array(
        'label'     => 'e-mail',
        'section'   => 'alpi_footer_information',
        'type'      => 'text',
    ));
    // PO. Box
    $wp_customize->add_setting('contact_us_pobox', array(
         'default'        => 'Post Office Box 131088',
     ) );
    $wp_customize->add_control('contact_us_pobox',array(
        'label'     => 'P.O Box',
        'section'   => 'alpi_footer_information',
        'type'      => 'text',
    ));
    // Address
    $wp_customize->add_setting('contact_us_address', array(
         'default'        => 'Birmingham, AL 35213',
     ) );
    $wp_customize->add_control('contact_us_address',array(
        'label'     => 'Address',
        'section'   => 'alpi_footer_information',
        'type'      => 'text',
    ));

    /******** Footer Information - Social Media ********/
    for ($m = 1; $m <= 5; $m++) {
        if ($m == 1) {
            $label = "Media Sosial Link";
        } else { $label = '';}
        $wp_customize->add_setting('social_media'.$media[$m], array('default'=>$link_social[$m]));
        $wp_customize->add_control( 'social_media'.$media[$m], array(
            'label'         => $label,
            'description'   => 'Insert Url for '.$media[$m],
            'section'       => 'alpi_footer_information',
            'type'          => 'url'
        ) );
    }
}