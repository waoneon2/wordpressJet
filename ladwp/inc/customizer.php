<?php
/**
 * LADWP Theme Customizer
 *
 * @package LADWP
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ladwp_customize_register( $wp_customize ) {
    class Ladwp_Customize_Control_Multiple_Select extends WP_Customize_Control {

        public $type = 'multiple-select';

        public function render_content() {
            $args = array(
                'posts_per_page'   => -1,
                'offset'           => 0,
                'category'         => '',
                'category_name'    => '',
                'orderby'          => 'date',
                'order'            => 'DESC',
                'include'          => '',
                'exclude'          => '',
                'meta_key'         => '',
                'meta_value'       => '',
                'post_type'        => 'post',
                'post_mime_type'   => '',
                'post_parent'      => '',
                'author'           => '',
                'author_name'      => '',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );
            $postArr = array();
            $posts_array = get_posts( $args );
            foreach ($posts_array as $key => $value) {
                $postArr[$value->ID] = $value->post_title;
            }
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;width: 100%;" id="ladwp_post_multiple">
                    <?php
                        foreach ( $postArr as $value => $label ) {
                            $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                            echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                        }
                    ?>
                </select>
            </label>
        <?php }
    }

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

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

        // Slider posts
    $wp_customize->add_section('ladwp_add_section_slider_post',array(
        'title' => __('Add Slider','ladwp'),
        'priority' => 90
    ));

    $wp_customize->add_setting( 'multiple_select_setting', array(
    'default' => array(),
    ) );

    $wp_customize->add_control(
        new Ladwp_Customize_Control_Multiple_Select(
            $wp_customize,
            'multiple_select_setting',
            array(
                'settings' => 'multiple_select_setting',
                'label'    => __('Testing multiple select','ladwp'),
                'description'   => __('Displaying post for header slider.<br />For multiple select use <b>Ctrl</b>+<b>Click</b>, on mac <b>Shift</b>+<b>Click</b>','ladwp'),
                'section'  => 'ladwp_add_section_slider_post',
                'type'     => 'multiple-select',
            )
        )
    );

    // Set border widget Color
    $wp_customize->add_setting( 'ladwp_border_widget_color' , array(
        'default' => '#0000ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'ladwp_border_widget_color',
        array(
            'label'      => __( 'Border Widget Color', 'ladwp' ),
            'section'    => 'colors',
            'settings'   => 'ladwp_border_widget_color',
        ) )
    );

    // Set Copyright footer
    $wp_customize->add_section('ladwp_add_section_copyright',array(
        'title' => __('Copyright Footer','ladwp')
    ));
    $wp_customize->add_setting('ladwp_setting_copyright_footer');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_setting_copyright_footer',
        array(
            'label'         => __( 'Text Copyright', 'ladwp' ),
            'description'   => __('This text to display on copyright','ladwp'),
            'section'       => 'ladwp_add_section_copyright',
            'settings'      => 'ladwp_setting_copyright_footer',
            'type'          => 'text',
        ) )
    );
    $wp_customize->add_setting('ladwp_setting_link_copyright_footer');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_setting_link_copyright_footer',
        array(
            'label'         => __( 'Link for Copyright', 'ladwp' ),
            'section'       => 'ladwp_add_section_copyright',
            'settings'      => 'ladwp_setting_link_copyright_footer',
            'type'          => 'url',
        ) )
    );

    // Customization for background color of widgets
     $wp_customize->add_setting( 'ladwp_background_color_widget' , array(
        'default' => '#f2f2f2',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'ladwp_background_color_widget',
        array(
            'label'      => __( 'Background color of widgets', 'ladwp' ),
            'section'    => 'colors',
            'settings'   => 'ladwp_background_color_widget',
        ) )
    );

    // Customization for latest news background color
     $wp_customize->add_setting( 'ladwp_ln_background_color_widget' , array(
        'default' => '#f2f2f2',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'ladwp_ln_background_color_widget',
        array(
            'label'      => __( 'Background color of Latest News Release', 'ladwp' ),
            'section'    => 'colors',
            'settings'   => 'ladwp_ln_background_color_widget',
        ) )
    );

    //setting for New Release Option
    $wp_customize->add_section('ladwp_new_release_opt',array(
        'title' => __('Category Settings','ladwp'),
        'priority' => 95
    ));

    // first title setting
    $wp_customize->add_setting( 'ladwp_new_release_title');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_new_release_title',
        array(
            'label'         => __( 'FIRST Category Title', 'ladwp' ),
            'description'   => __('This text to display title in first category section ','ladwp'),
            'section'       => 'ladwp_new_release_opt',
            'settings'      => 'ladwp_new_release_title',
            'type'          => 'text',
        ) )
    );

    // first link text setting
    $wp_customize->add_setting( 'ladwp_new_release_link_text');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_new_release_link_text',
        array(
            'label'         => __( 'Link text', 'ladwp' ),
            'description'   => __('','ladwp'),
            'section'       => 'ladwp_new_release_opt',
            'settings'      => 'ladwp_new_release_link_text',
            'type'          => 'text',
        ) )
    );

    //first category
    $wp_customize->add_setting( 'ladwp_new_release_category');
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'ladwp_new_release_category',
                array(
                    'label' => 'Set first category',
                    // 'description'   => __('Select category to display','ladwp'),
                    'section' => 'ladwp_new_release_opt',
                    'setting' => 'ladwp_new_release_category'
                )
            )
        );



    // second title setting
    $wp_customize->add_setting( 'ladwp_new_release_title_2');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_new_release_title_2',
        array(
            'label'         => __( 'SECOND Category Title', 'ladwp' ),
            'description'   => __('This text to display title in second category section ','ladwp'),
            'section'       => 'ladwp_new_release_opt',
            'settings'      => 'ladwp_new_release_title_2',
            'type'          => 'text',
        ) )
    );

    // second link text setting
    $wp_customize->add_setting( 'ladwp_new_release_link_text_2');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ladwp_new_release_link_text_2',
        array(
            'label'         => __( 'Link text', 'ladwp' ),
            'description'   => __('','ladwp'),
            'section'       => 'ladwp_new_release_opt',
            'settings'      => 'ladwp_new_release_link_text_2',
            'type'          => 'text',
        ) )
    );

    //second category
    $wp_customize->add_setting( 'ladwp_new_release_category_2');
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'ladwp_new_release_category_2',
                array(
                    'label' => 'Set second category',
                    // 'description'   => __('Select category to display','ladwp'),
                    'section' => 'ladwp_new_release_opt',
                    'setting' => 'ladwp_new_release_category_2'
                )
            )
        );
}
add_action( 'customize_register', 'ladwp_customize_register' );

/**
 * Customizer to add Google Analytic Code
 */

if(!function_exists('ladwp_custom_customizer')):
    function ladwp_custom_customizer($wp_customize){
        $wp_customize->add_section('add_ga_id',array(
            'title' => __('Google Analytic','ladwp'),
            'priority' => 70
        ));

        $wp_customize->add_setting('ladwp_field_ga_analytic_id');
        $wp_customize->add_control( 
            new WP_Customize_Control( 
            $wp_customize, 
            'ladwp_field_ga_analytic_id', 
            array(
                'label'         => __( 'Google Analytic Field', 'ladwp' ),
                'description'   => __('This is to adding Google Analytic code to theme.<br /> Example: <b>UA-84821720-1</b>','ladwp'),
                'section'       => 'add_ga_id',
                'settings'      => 'ladwp_field_ga_analytic_id',
                'type'          => 'text',
            ) ) 
        );
    }
    add_action( 'customize_register', 'ladwp_custom_customizer' );
endif;

if(!function_exists('ladwp_add_js_ga_analytic')):
function ladwp_add_js_ga_analytic() {
    $ga_id = get_theme_mod( 'ladwp_field_ga_analytic_id' );
    
    if ( $ga_id != '' ) :
    ?>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          <?php echo "ga('create', '".$ga_id."', 'auto');"."\n" ?>
          ga('send', 'pageview');

        </script>
    <?php
    endif;
}
add_action( 'wp_head', 'ladwp_add_js_ga_analytic' );
endif;

/* Ovveride Menus Priority */
function change_menus_priority($wp_customize){
    $menus = $wp_customize->get_panel('nav_menus');
    if( $menus instanceof \WP_Customize_Nav_Menus_Panel ) {
        $menus->priority = 65;    
    }
}
add_action('customize_register', 'change_menus_priority', 12);

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ladwp_customize_preview_js() {
	wp_enqueue_script( 'ladwp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ladwp_customize_preview_js' );