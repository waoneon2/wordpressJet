<?php

function oilspills_custom_cutomizer_register( $wp_customize ) {
	// Hero Image and Overlay Page
    $wp_customize->add_section('add_hero_image_overlay',array(
        'title' => __('Hero Image','oilspill'),
        'priority' => 30
    ));
    // Add Hero Image
    $wp_customize->add_setting( 'oilspill_add_hero_img' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'oilspill_add_hero_img',
        array(
        'label'    => __( 'Upload Hero Image', 'oilspill' ),
        'section'  => 'add_hero_image_overlay',
        'settings' => 'oilspill_add_hero_img'
    ) ) );
    // Setting for Hero Image
    $wp_customize->add_setting( 'oilspill_opt_hero_img' , array(
    	'default' => '0'
    	));
    $wp_customize->add_control(
        'oilspill_hero_image_opt',
        array (
            'label' => esc_html__('Hero Image Option', 'oilspill'),
            'section' => 'add_hero_image_overlay', 
            'settings' => 'oilspill_opt_hero_img',
            'type' => 'select',
            'choices' => array (
                '0' => 'Full Width',
                '1' => 'Content Width'
            )
         )
    );
    // Setting for Overlay page
	$wp_customize->add_setting( 'oilspill_opt_overlay_page', array(
		'default'   => ''
	) );

	$wp_customize->add_control( 'oilspill_opt_overlay_page', array(
			'label'    => __( 'Select Page for overlay', 'oilspill' ),
			'section'  => 'add_hero_image_overlay',
			'type'     => 'dropdown-pages'
	) );


//Custom Frontpage Widget #1
    $wp_customize->add_section('cust_front_widget1',array(
        'title' => __('Custom Frontpage Widget #1','oilspill')

    ));

    $wp_customize->add_setting('cfw1-title');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw1-title', 
        array(
            'label'      => __( 'Title', 'oilspill' ),
            'section'   => 'cust_front_widget1',
            'settings'   => 'cfw1-title',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting( 'cfw1-image' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'cfw1-image', 
        array(
        'label'    => __( 'Upload Image', 'oilspill' ),
        'section'  => 'cust_front_widget1',
        'settings' => 'cfw1-image'
    ) ) );

    $wp_customize->add_setting('cfw1-excerpt');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw1-excerpt', 
        array(
            'label'      => __( 'The excerpt', 'oilspill' ),
            'section'   => 'cust_front_widget1',
            'settings'   => 'cfw1-excerpt',
            'type'       => 'textarea',
        ) ) 
    );

    $wp_customize->add_setting('cfw1-url');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw1-url', 
        array(
            'label'      => __( 'Learn more', 'oilspill' ),
            'description' => 'add url for learn more link',
            'section'   => 'cust_front_widget1',
            'settings'   => 'cfw1-url',
            'type'       => 'url',
        ) ) 
    );

    $wp_customize->add_setting('cfw1-button-text');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw1-button-text', 
        array(
            'label'      => __( 'Button Text', 'oilspill' ),
            'description' => 'optional, fill out if you want to add button',
            'section'   => 'cust_front_widget1',
            'settings'   => 'cfw1-button-text',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting('cfw1-button-link');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw1-button-link', 
        array(
            'label'      => __( 'Button link', 'oilspill' ),
            'description' => 'this is url for button',
            'section'   => 'cust_front_widget1',
            'settings'   => 'cfw1-button-link',
            'type'       => 'url',
        ) ) 
    );



//Custom Frontpage Widget #2
    $wp_customize->add_section('cust_front_widget2',array(
        'title' => __('Custom Frontpage Widget #2','oilspill')

    ));

    $wp_customize->add_setting('cfw2-title');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw2-title', 
        array(
            'label'      => __( 'Title', 'oilspill' ),
            'section'   => 'cust_front_widget2',
            'settings'   => 'cfw2-title',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting( 'cfw2-image' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'cfw2-image', 
        array(
        'label'    => __( 'Upload Image', 'oilspill' ),
        'section'  => 'cust_front_widget2',
        'settings' => 'cfw2-image'
    ) ) );

    $wp_customize->add_setting('cfw2-excerpt');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw2-excerpt', 
        array(
            'label'      => __( 'The excerpt', 'oilspill' ),
            'section'   => 'cust_front_widget2',
            'settings'   => 'cfw2-excerpt',
            'type'       => 'textarea',
        ) ) 
    );

    $wp_customize->add_setting('cfw2-url');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw2-url', 
        array(
            'label'      => __( 'Learn more', 'oilspill' ),
            'description' => 'add url for learn more link',
            'section'   => 'cust_front_widget2',
            'settings'   => 'cfw2-url',
            'type'       => 'url',
        ) ) 
    );

    $wp_customize->add_setting('cfw2-button-text');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw2-button-text', 
        array(
            'label'      => __( 'Button Text', 'oilspill' ),
            'description' => 'optional, fill out if you want to add button',
            'section'   => 'cust_front_widget2',
            'settings'   => 'cfw2-button-text',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting('cfw2-button-link');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw2-button-link', 
        array(
            'label'      => __( 'Button link', 'oilspill' ),
            'description' => 'this is url for button',
            'section'   => 'cust_front_widget2',
            'settings'   => 'cfw2-button-link',
            'type'       => 'url',
        ) ) 
    );


    //Custom Frontpage Widget #3
    $wp_customize->add_section('cust_front_widget3',array(
        'title' => __('Custom Frontpage Widget #3','oilspill')

    ));

    $wp_customize->add_setting('cfw3-title');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw3-title', 
        array(
            'label'      => __( 'Title', 'oilspill' ),
            'section'   => 'cust_front_widget3',
            'settings'   => 'cfw3-title',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting( 'cfw3-image' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'cfw3-image', 
        array(
        'label'    => __( 'Upload Image', 'oilspill' ),
        'section'  => 'cust_front_widget3',
        'settings' => 'cfw3-image'
    ) ) );

    $wp_customize->add_setting('cfw3-excerpt');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw3-excerpt', 
        array(
            'label'      => __( 'The excerpt', 'oilspill' ),
            'section'   => 'cust_front_widget3',
            'settings'   => 'cfw3-excerpt',
            'type'       => 'textarea',
        ) ) 
    );

    $wp_customize->add_setting('cfw3-url');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw3-url', 
        array(
            'label'      => __( 'Learn more', 'oilspill' ),
            'description' => 'add url for learn more link',
            'section'   => 'cust_front_widget3',
            'settings'   => 'cfw3-url',
            'type'       => 'url',
        ) ) 
    );

    $wp_customize->add_setting('cfw3-button-text');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw3-button-text', 
        array(
            'label'      => __( 'Button Text', 'oilspill' ),
            'description' => 'optional, fill out if you want to add button',
            'section'   => 'cust_front_widget3',
            'settings'   => 'cfw3-button-text',
            'type'       => 'text',
        ) ) 
    );

    $wp_customize->add_setting('cfw3-button-link');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'cfw3-button-link', 
        array(
            'label'      => __( 'Button link', 'oilspill' ),
            'description' => 'this is url for button',
            'section'   => 'cust_front_widget3',
            'settings'   => 'cfw3-button-link',
            'type'       => 'url',
        ) ) 
    );

}
add_action( 'customize_register', 'oilspills_custom_cutomizer_register' );


function oilspill_customizer_set_hero_image() {
    $setting_hero_img = get_theme_mod('oilspill_opt_hero_img'); 
    if(!empty($setting_hero_img)) :
    	if($setting_hero_img != '0') :
    ?>
		 <style type="text/css">
		 	div.background-image.container {
		 		padding-left: 0;
		 		padding-right: 0;
		 	}
	        .site-header .background-image img {
	            min-width: 100%;
			    width: auto;
			    min-height: 100%;
			    position: inherit;
			    top: 0;
			    left: 0;
			    transform: inherit;
			    z-index: 0;
	        }
            div#oilspill-overlay-page {
                position: absolute;
                right: 425px;
            }
            .post-title-container {
                position: absolute;
                margin-top: 150px;
                top:4px;
            }
            @media only screen and (max-width : 768px) {
                div#oilspill-overlay-page {
                    right:0;
                }
                .post-title-container {
                    margin-top: 60px;
                    top:4px;
                }
            }
            
        </style>
	<?php
    	endif;
    endif;

}
add_action( 'wp_head', 'oilspill_customizer_set_hero_image' );



//ad new sidebar
function oilspill_custom_sidebar() {
        register_sidebar( array(
        'name' => __( 'Frontpage Widget', 'oilspill' ),
        'id' => 'front-sidebar',
        'description'   => esc_html__( 'Please add just one widget', 'oilspill' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'oilspill_custom_sidebar' );

function getHeaderImage() {
  $headerImage = get_header_image();
  if ( '' == $headerImage ) {
   $headerImage = "empty";
  }
  return $headerImage;
}


function oilspill_set_header_image() {
    $oilspill_header_img = getHeaderImage();
    if($oilspill_header_img != "empty"):
    ?>
        <style type="text/css">
        @media (min-width: 768px){
            a.navbar-brand {
                margin-top: 0;
                margin-bottom: 0;
            }
        }
        .navbar-brand {
          padding: 0px;
        }

        }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'oilspill_set_header_image' );

function oilspill_set_title_desc_color(){
    $get_color = get_header_textcolor();
    if($get_color != 'ffffff'):
?>
    <style type="text/css">
        div.top-header .navbar-default .navbar-brand {
                color: #<?php echo $get_color; ?>;
            }
    </style>
<?php
    endif;
}
add_action( 'wp_head', 'oilspill_set_title_desc_color' );

function oilspill_set_background_color(){
    $get_backg_color = get_background_color();
    if($get_backg_color != 'f8f5f0'):
?>
    <style type="text/css">
        #page {
                background-color: #<?php echo $get_backg_color; ?>;
            }
    </style>
<?php
    endif;
}
add_action( 'wp_head', 'oilspill_set_background_color' );