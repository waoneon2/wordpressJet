<?php
/**
 * NCOC Theme Customizer.
 *
 * @package NCOC
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ncoc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'ncoc_customize_register' );

function ncoc_customize_slider_register( $wp_customize ) {

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

    $wp_customize->add_section('add_ncoc_img_slider',array(
        'title' => __('Add Image Slider','ncoc'),
        'priority' => 30
    ));

    $wp_customize->add_section('add_ncoc_npc',array(
        'title' => __('Settings','ncoc'),
        'description' => __('Settings link and image for news, publicaton, and contact.')
    ));

    $wp_customize->add_setting( 'ncoc_li_news_img' );
    $wp_customize->add_setting( 'ncoc_li_news_text' );
    $wp_customize->add_setting( 'ncoc_li_publication_img' );
    $wp_customize->add_setting( 'ncoc_li_publication_text' );
    $wp_customize->add_setting( 'ncoc_li_contact_img' );
    $wp_customize->add_setting( 'ncoc_li_contact_text' );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_li_news_img', 
        array(
        'label'    => __( 'Image news', 'ncoc' ),
        'section'  => 'add_ncoc_npc',
        'settings' => 'ncoc_li_news_img'
    ) ) );
    $wp_customize->add_control(
        new WP_Customize_Textarea_Control(
        $wp_customize,
        'ncoc_li_news_text',
        array(
            'label'         => __( 'Link text news', 'ncoc' ),
            'description'   => __('','ncoc'),
            'section'       => 'add_ncoc_npc',
            'settings'      => 'ncoc_li_news_text',
            'type'          => 'textarea',
        ) )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_li_publication_img', 
        array(
        'label'    => __( 'Image publication', 'ncoc' ),
        'section'  => 'add_ncoc_npc',
        'settings' => 'ncoc_li_publication_img'
    ) ) );
    $wp_customize->add_control(
        new WP_Customize_Textarea_Control(
        $wp_customize,
        'ncoc_li_publication_text',
        array(
            'label'         => __( 'Link text publication', 'ncoc' ),
            'description'   => __('','ncoc'),
            'section'       => 'add_ncoc_npc',
            'settings'      => 'ncoc_li_publication_text',
            'type'          => 'textarea',
        ) )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_li_contact_img', 
        array(
        'label'    => __( 'Image contact', 'ncoc' ),
        'section'  => 'add_ncoc_npc',
        'settings' => 'ncoc_li_contact_img'
    ) ) );
    $wp_customize->add_control(
        new WP_Customize_Textarea_Control(
        $wp_customize,
        'ncoc_li_contact_text',
        array(
            'label'         => __( 'Link text contact', 'ncoc' ),
            'description'   => __('','ncoc'),
            'section'       => 'add_ncoc_npc',
            'settings'      => 'ncoc_li_contact_text',
            'type'          => 'textarea',
        ) )
    );


    $wp_customize->add_setting( 'ncoc_lk[0]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[0]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[0]'
    ) ) );

    $wp_customize->add_setting( 'ncoc_lk[1]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[1]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[1]'
    ) ) );

    $wp_customize->add_setting( 'ncoc_lk[2]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[2]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[2]'
    ) ) );

    $wp_customize->add_setting( 'ncoc_lk[3]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[3]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[3]'
    ) ) );

    $wp_customize->add_setting( 'ncoc_lk[4]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[4]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[4]'
    ) ) );

    $wp_customize->add_setting( 'ncoc_lk[5]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_lk[5]', 
        array(
        'label'    => __( 'Upload Image', 'ncoc' ),
        'description' 	=> __('Adding Image Slider on homepage','ncoc'),
        'section'  => 'add_ncoc_img_slider',
        'settings' => 'ncoc_lk[5]'
    ) ) );
}
add_action( 'customize_register', 'ncoc_customize_slider_register' );

function ncoc_customize_logo_register( $wp_customize ) {
	$wp_customize->add_section('add_logos',array(
        'title' => __('Add Logo','ncoc'),
        'priority' => 160

    ));
    // set logo
    $wp_customize->add_setting( 'ncoc_logo[0]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[0]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[0]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[0]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[0]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[0]',
            'type'       => 'url',
        ) ) 
    );

    // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[1]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[1]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[1]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[1]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[1]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[1]',
            'type'       => 'url',
        ) ) 
    );

    // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[2]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[2]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[2]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[2]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[2]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[2]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[3]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[3]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[3]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[3]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[3]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[3]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[4]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[4]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[4]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[4]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[4]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[4]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[5]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[5]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[5]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[5]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[5]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[5]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[6]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[6]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[6]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[6]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[6]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[6]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[7]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[7]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[7]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[7]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[7]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[7]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[8]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[8]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[8]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[8]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[8]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[8]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[9]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[9]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[9]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[9]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[9]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[9]',
            'type'       => 'url',
        ) ) 
    );

     // -------------------------------------------- //

    $wp_customize->add_setting( 'ncoc_logo[10]' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
        'ncoc_logo[10]', 
        array(
        'label'    => __( 'Upload Logo', 'ncoc' ),
        'section'  => 'add_logos',
        'settings' => 'ncoc_logo[10]'
    ) ) );

    $wp_customize->add_setting('ncoc_link_logos[10]');
    $wp_customize->add_control( 
        new WP_Customize_Control( 
        $wp_customize, 
        'ncoc_link_logos[10]', 
        array(
            'label'      => __( 'Link for Logo', 'ncoc' ),
            'section'   => 'add_logos',
            'settings'   => 'ncoc_link_logos[10]',
            'type'       => 'url',
        ) ) 
    );
}
add_action( 'customize_register', 'ncoc_customize_logo_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ncoc_customize_preview_js() {
	wp_enqueue_script( 'ncoc_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ncoc_customize_preview_js' );
