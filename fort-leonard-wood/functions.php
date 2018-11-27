<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'us_army-bootstrap','us_army-bootstrap-theme','us_army-font-awesome','us_army-calendar-blue' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

// Default Asset Image
if(!function_exists('fldefaultCustomizer')):
function fldefaultCustomizer($name_of_section){
    if(empty($name_of_section)){
        return false;
    } else {
        switch ($name_of_section) {
            case 'default-slider':
                $dh = array(
                    0 => get_stylesheet_directory_uri() . '/img/default_slider/1.jpg',
                    1 => get_stylesheet_directory_uri() . '/img/default_slider/2.jpg',
                    2 => get_stylesheet_directory_uri() . '/img/default_slider/3.jpg',
                    3 => get_stylesheet_directory_uri() . '/img/default_slider/4.jpg',
                );
                return $dh;
                break;

            case 'default-title':
                $dt = array(
                    0 => 'Engineer Sappers',
                    1 => 'Engineer Sappers',
                    2 => 'NBC Chamber',
                    3 => 'Welcome to Fort Leonard Wood',
                );
                return $dt;
                break;

            case 'default-desc':
                $dd = array(
                    0 => '',
                    1 => '',
                    2 => '',
                    3 => 'Basic Combat Training Arrival',
                );
                return $dd;
                break;

            default:
                return false;
                break;
        }
    }
}
endif;

// REMOVE UNUSED FUNCTIONALITY OF CUSTOMIZER
add_action( 'customize_register', 'fl_remove_custom', 15 );
function fl_remove_custom($wp_customize) {
    $wp_customize->remove_panel('us_army_theme_options');
    $wp_customize->add_panel('us_army_theme_options', array('title' => esc_html__('Fort Leonard Wood Theme Options', 'us_army'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

    $wp_customize->remove_section('us_army_headlines');
    $wp_customize->add_section('us_army_headlines',array(
        'title' => __('Fort Leonard Wood News','us_army'),
        'priority' => 1,
        'description' =>'Select category for displayed in news section',
        'panel' => 'us_army_theme_options'
    ));

    $wp_customize->remove_section('us_army_hot_topic');
    $wp_customize->add_section('us_army_hot_topic',array(
        'title' => __('Hot Topics','us_army'),
        'priority' => 2,
        'description' =>'Select category for displayed in hot topics section',
        'panel' => 'us_army_theme_options'
    ));

    $wp_customize->remove_section('us_army_footer_info');
    $wp_customize->add_section('us_army_footer_info', array(
        'title' => __('Footer Info','us_army'),
        'priority' => 180,
        'panel' => 'us_army_theme_options'
    ));

    $wp_customize->remove_setting('front_category_title_4');
    $wp_customize->remove_setting('front_category_title_6');

    $wp_customize->remove_section('us_army_get_latest');
    $wp_customize->remove_section('us_army_latest_press_release');
    $wp_customize->remove_section('us_army_past_press_release');
    $wp_customize->remove_section('us_army_orientation_video');
    $wp_customize->remove_section('us_army_dropdown_menus');
    $wp_customize->remove_section('us_army_hide_date_gf');

    $wp_customize->remove_control('hot_topics_display_date_setting');
    $wp_customize->remove_setting('hot_topics_display_date_setting');

    //remove social link
    $wp_customize->remove_section('social_media_link_opt');

    $wp_customize->add_setting( 'front_category_title_4', array('default' => 'Fort Leonard Wood News'));
    // $wp_customize->add_setting( 'front_category_title_6', array('default' => 'Fort Leonard Wood Orientation Video'));

    // BOTTOM LINK
    $wp_customize->add_section('bottom_link',array(
        'title' => __('Bottom Link','us_army'),
        'priority' => 7,
        'panel' => 'us_army_theme_options'
    ));

    for ($count=1; $count <= 2 ; $count++) {
        $wp_customize->add_setting( 'bottom_link_image'.$count);
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bottom_link_image'.$count, array(
           'label'          => __( 'Bottom Link #'.$count, 'textdomain' ),
           'description'    => 'Select Image Link',
           'section'        => 'bottom_link',
        ) ) );

        $wp_customize->add_setting('bottom_link_url'.$count, array('default'=>''));
        $wp_customize->add_control('bottom_link_url'.$count,array(
            'description'   => 'Insert Link',
            'section'       => 'bottom_link',
            'type'          => 'link',
        ));
    }

    // MIDDLE LINK
    $wp_customize->add_section('middle_link',array(
        'title' => __('Middle Link','us_army'),
        'priority' => 8,
        'panel' => 'us_army_theme_options'
    ));

    $wp_customize->add_setting( 'middle_link_image', array(
        'default'   => '',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'middle_link_image', array(
       'label'      => 'Select Image Link',
       'section'    => 'middle_link',
    ) ) );

    $wp_customize->add_setting('middle_link_url',array('default'=>''));
    $wp_customize->add_control( 'middle_link_url', array(
        'label'   => 'Insert Link',
        'section' => 'middle_link',
        'type'    => 'link'
    ) );



    //add instagram
    $wp_customize->add_setting('social_media_link_instagram');
    $wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'social_media_link_instagram',
        array(
            'label'         => __( 'instagram', 'us_army' ),
            'description'   => __('Insert the url','us_army'),
            'section'       => 'social_media_link_opt',
            'settings'      => 'social_media_link_instagram',
            'type'          => 'link',
        ) )
    );

    // Add Customizer Slider Image
    $wp_customize->add_section('fl_add_lgs',array(
        'title' => __('Homepage Image Slider','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 0
    ));

    for ($i=0; $i < 4; $i++) {
        $wp_customize->add_setting( 'fl_lk['.$i.']' , array(
            'default' => fldefaultCustomizer('default-slider')[$i],
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'fl_lk['.$i.']',
            array(
            'label'    => __( 'Image', 'us_army' ),
            'section'  => 'fl_add_lgs',
            'settings' => 'fl_lk['.$i.']'
        ) ) );
        $wp_customize->add_setting('fl_title_overlay['.$i.']',  array(
            'default' => fldefaultCustomizer('default-title')[$i],
        ));
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_title_overlay['.$i.']',
            array(
                'label'         => __( 'Title', 'us_army' ),
                'description'   => __('This title to show on overlay image','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_title_overlay['.$i.']',
                'type'          => 'text',
            ) )
        );
        $wp_customize->add_setting('fl_desc_overlay['.$i.']',  array(
            'default' => fldefaultCustomizer('default-desc')[$i],
        ));
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_desc_overlay['.$i.']',
            array(
                'label'         => __( 'Description', 'us_army' ),
                'description'   => __('This description to show on overlay image','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_desc_overlay['.$i.']',
                'type'          => 'textarea',
            ) )
        );
        $wp_customize->add_setting('fl_link_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_link_overlay['.$i.']',
            array(
                'label'         => __( 'Link/Url', 'us_army' ),
                'description'   => __('This link for title overlay','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_link_overlay['.$i.']',
                'type'          => 'url',
            ) )
        );
    }
    // Eof Customizer Slider Image

}

// REMOVE PARENT FUNCTIONS
add_action('after_setup_theme', 'remove_parent_functions');
function remove_parent_functions() {
    remove_action('wp_head', 'set_header_text_color', 10);
}

// FOR CHILD ACTION
if( !function_exists( 'fl_set_header_text_color') ):
    function fl_set_header_text_color(){
        $link_color = get_header_textcolor();
        $link_color_default = 'fff';

            if ( $link_color !== 'blank' && $link_color !== '000000') :
        ?>
            <style type="text/css">
            .navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3  {
                color: #<?php echo $link_color; ?>;
            }
            @media (max-width: 1067px){
                div.navbar-title a, div.navbar-title a:visited {
                    color: #333333 !important;
                    font-weight: bold !important;
                }
            }
            </style>
        <?php else: ?>
            <style type="text/css">
            .navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3 {
                color: #<?php echo $link_color_default; ?>;
            }
            </style>
        <?php
        endif; ?>
        <?php
    }
endif;
add_action('wp_head', 'fl_set_header_text_color', 15);

// EXCERPT MORE
function new_excerpt_more($more) {
       global $post;
    return '...<a class="moretag" href="'. get_permalink($post->ID) . '"></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


function fl_image_sizes() {
    add_image_size('fl_thumb', 200, 200, true);
    add_image_size('fl_slider', 996, 370, true);
}
add_action('after_setup_theme', 'fl_image_sizes');

require_once( get_stylesheet_directory() . '/inc/slider-image-homepage.php' );

add_filter('wp_nav_menu_items','fl_search_nav', 10, 2);
function fl_search_nav( $items, $args ) {

    $search = '';
    if ( $args->theme_location == 'menu-1')  {
        $search = '<li><div role="search" id="liveSearch">
          <form action="'.esc_url( home_url( '/' ) ).'" method="get" id="searchForm">
            <h2>
              <label class="hide" for="search">Search</label>
              <input type="text" size="32" id="search" name="s" placeholder="Search Press Center..." >
              <input type="submit" id="searchbutton" class="searchclose" value="">
            </h2>
          </form>
        </div></li>';
    }
    return $items.$search;
}
