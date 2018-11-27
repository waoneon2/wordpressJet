<?php
function uc_customize_register( $wp_customize ) {

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

    $wp_customize->add_section('add_logos',array(
        'title' => __('Add Logo','uc'),
        'priority' => 160

    ));
    for ($i=0; $i < 15; $i++) {
        // set logo
        $wp_customize->add_setting( 'uc_logo['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'uc_logo['.$i.']',
            array(
            'label'    => __( 'Upload Logo', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'uc_logo['.$i.']'
        ) ) );

        $wp_customize->add_setting( 'uc_logo_title['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'uc_logo_title['.$i.']',
            array(
            'label'    => __( 'Title', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'uc_logo_title['.$i.']',
            'type'     => 'text',
        ) ) );

        $wp_customize->add_setting( 'uc_logo_alt['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Textarea_Control(
            $wp_customize,
            'uc_logo_alt['.$i.']',
            array(
            'label'    => __( 'Alt/Description', 'uc' ),
            'section'  => 'add_logos',
            'settings' => 'uc_logo_alt['.$i.']',
            'type'     => 'textarea',
        ) ) );

        $wp_customize->add_setting('uc_link_logos['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'uc_link_logos['.$i.']',
            array(
                'label'      => __( 'Link', 'uc' ),
                'section'    => 'add_logos',
                'settings'   => 'uc_link_logos['.$i.']',
                'type'       => 'url',
            ) )
        );
    }

    // set color nav menu
    $wp_customize->add_setting( 'uc_nav_color' , array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_nav_color',
        array(
            'label'      => __( 'Nav Menu Color', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_nav_color',
        ) )
    );
    // -------------------------------------------- //
}
add_action( 'customize_register', 'uc_customize_register' );
add_image_size( 'logo-client-image', 768, 9999 );
?>