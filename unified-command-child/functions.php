<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
// END ENQUEUE PARENT ACTION

if(!function_exists('uc_customize_slider_register')):
function uc_customize_slider_register( $wp_customize ) {
    $wp_customize->add_section('add_lgs',array(
        'title' => __('Add Image Slider','uc'),
        'priority' => 30
    ));

    for ($i=0; $i < 10; $i++) {
        $wp_customize->add_setting( 'uc_lk['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'uc_lk['.$i.']',
            array(
            'label'    => __( 'Upload Image', 'uc' ),
            'section'  => 'add_lgs',
            'settings' => 'uc_lk['.$i.']'
        ) ) );
        $wp_customize->add_setting('uc_desc_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'uc_desc_overlay['.$i.']',
            array(
                'label'         => __( 'Description', 'uc' ),
                'description'   => __('This description to show on overlay image','uc'),
                'section'       => 'add_lgs',
                'settings'      => 'uc_desc_overlay['.$i.']',
                'type'          => 'textarea',
            ) )
        );
        $wp_customize->add_setting('uc_link_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'uc_link_overlay['.$i.']',
            array(
                'label'         => __( 'Link/Url', 'uc' ),
                'description'   => __('This link for description overlay','uc'),
                'section'       => 'add_lgs',
                'settings'      => 'uc_link_overlay['.$i.']',
                'type'          => 'url',
            ) )
        );
    }

    // Set Color of Dropdown menu
    $wp_customize->add_setting( 'uc_dropdown_menu_color' , array(
        'default' => '#efefef',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_dropdown_menu_color',
        array(
            'label'      => __( 'Dropdown Menu Color', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_dropdown_menu_color',
        ) )
    );

    // Set Color Font navigation
    $wp_customize->add_setting( 'uc_fonts_nav_color' , array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_fonts_nav_color',
        array(
            'label'      => __( 'Color fonts navigation', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_fonts_nav_color',
        ) )
    );

    // Set Color Font Dropdown navigation
    $wp_customize->add_setting( 'uc_fonts_dropdown_color' , array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_fonts_dropdown_color',
        array(
            'label'      => __( 'Color fonts dropdown', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_fonts_dropdown_color',
        ) )
    );

    // Remove default setting nav color from parent
    $wp_customize->remove_setting('uc_nav_color');
    $wp_customize->remove_control('uc_nav_color');

    // Set color nav menu
    $wp_customize->add_setting( 'uc_nav_color' , array(
        'default' => '#b0b1b2',
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
}
add_action( 'customize_register', 'uc_customize_slider_register', 15 );
endif;

if(!function_exists('uc_child_register_script')):
	function uc_child_register_script(){
		wp_enqueue_script( 'jquery-cycle2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.js', array('jquery'), '2.1.6', true );
		wp_enqueue_script( 'jquery-cycle2-caption2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.caption2.js', array(), '20130708', true);
		wp_enqueue_script( 'custom-child-script', trailingslashit(get_stylesheet_directory_uri()) . 'js/script.js', array(), '1.0', true);

	}
add_action( 'wp_enqueue_scripts', 'uc_child_register_script' );
endif;

if(!function_exists('uc_customizer_dropdown_color')):
function uc_customizer_dropdown_color() {
    $link_color = get_theme_mod( 'uc_dropdown_menu_color' );

    if ( $link_color != '#efefef' ) :
    ?>
        <style type="text/css">
        @media screen and (min-width: 600px){
             .main-navigation li ul li a {
                background: <?php echo $link_color; ?> !important;
            }
        }

        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_dropdown_color' );
endif;

if(!function_exists('uc_customizer_font_nav_color')):
function uc_customizer_font_nav_color() {
    $link_color = get_theme_mod( 'uc_fonts_nav_color' );

    if ( $link_color != '#ffffff' ) :
    ?>
        <style type="text/css">
        @media screen and (min-width: 600px){
             .main-navigation li a {
                color: <?php echo $link_color; ?> !important;
            }
        }

        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_font_nav_color' );
endif;

if(!function_exists('uc_customizer_font_dropdown_color')):
function uc_customizer_font_dropdown_color() {
    $link_color = get_theme_mod( 'uc_fonts_dropdown_color' );

    if ( $link_color != '#ffffff' ) :
    ?>
        <style type="text/css">
        @media screen and (min-width: 600px){
             .main-navigation li ul li a {
                color: <?php echo $link_color; ?> !important;
            }
        }

        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_font_dropdown_color' );
endif;

if(!function_exists('uc_customizer_nav_color')):
function uc_customizer_nav_color() {
    $link_color = get_theme_mod( 'uc_nav_color', '#b0b1b2');

    if ( $link_color != '#b0b1b2' ) :
    ?>
        <style type="text/css">
        @media screen and (min-width: 600px){
            #site-navigation.main-navigation {
                background-color: <?php echo $link_color; ?> !important;
            }
        }

        </style>
    <?php
    else:
    ?>
        <style type="text/css">
        @media screen and (min-width: 600px){
            #site-navigation.main-navigation {
                background-color: <?php echo $link_color; ?> !important;
            }
        }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_nav_color' );
endif;


if ( ! function_exists( 'uc_one_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own uc_one_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function uc_one_entry_meta() {
    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'uc_one' ) );

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'uc_one' ) );

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time( 'F j, Y g:i A' ) ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date( 'F j, Y g:i A' ) )
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    if ( $tag_list ) {
        $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s.', 'uc_one' );
    } elseif ( $categories_list ) {
        $utility_text = __( 'This entry was posted in %1$s on %3$s.', 'uc_one' );
    } else {
        $utility_text = __( 'This entry was posted on %3$s.', 'uc_one' );
    }

    printf(
        $utility_text,
        $categories_list,
        $tag_list,
        $date
    );
}
endif;