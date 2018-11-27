<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

// END ENQUEUE PARENT ACTION
if(!function_exists('exxon_customize_slider_register')):
function exxon_customize_slider_register( $wp_customize ) {
    // Image slider and Overlay
    $wp_customize->add_section('add_lgs',array(
        'title' => __('Add Image Slider','exxon'),
        'priority' => 30
    ));
    // Image Slider
    for( $k=0; $k<6; $k++ ){
        $wp_customize->add_setting( 'exxon_lk['.$k.']' );
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'exxon_lk['.$k.']',
            array(
            'label'    => __( 'Upload Image', 'exxon' ),
            'section'  => 'add_lgs',
            'settings' => 'exxon_lk['.$k.']'
        ) ) );
        $wp_customize->add_setting('exxon_title_overlay['.$k.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'exxon_title_overlay['.$k.']',
            array(
                'label'         => __( 'Title', 'exxon' ),
                'description'   => __('Title for description to show on overlay image','exxon'),
                'section'       => 'add_lgs',
                'settings'      => 'exxon_title_overlay['.$k.']',
                'type'          => 'text',
            ) )
        );
        $wp_customize->add_setting('exxon_desc_overlay['.$k.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'exxon_desc_overlay['.$k.']',
            array(
                'label'      	=> __( 'Description', 'exxon' ),
                'description' 	=> __('This description to show on overlay image','exxon'),
                'section'   	=> 'add_lgs',
                'settings'   	=> 'exxon_desc_overlay['.$k.']',
                'type'       	=> 'textarea',
            ) )
        );
        $wp_customize->add_setting('exxon_link_overlay['.$k.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'exxon_link_overlay['.$k.']',
            array(
                'label'      	=> __( 'Link/Url', 'exxon' ),
                'description' 	=> __('This link for description overlay','exxon'),
                'section'   	=> 'add_lgs',
                'settings'   	=> 'exxon_link_overlay['.$k.']',
                'type'       	=> 'url',
            ) )
        );
        $wp_customize->add_setting('exxon_text_link_overlay['.$k.']', array(
            'default' => 'Read more')
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'exxon_text_link_overlay['.$k.']',
            array(
                'label'         => __( 'Text Link', 'exxon' ),
                'description'   => __('Text for link. Example : <b>Read more</b>.','exxon'),
                'section'       => 'add_lgs',
                'settings'      => 'exxon_text_link_overlay['.$k.']',
                'type'          => 'text'
            ) )
        );
    }

    // Redirect Banner
    $wp_customize->add_section('exxon_redirect_url',array(
        'title' => __('Redirect Link','exxon')
    ));
    $wp_customize->add_setting('exxon_redirect_url_setting', array(
        'default' => home_url(),
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_redirect_url_setting',
        array(
            'label'      => __( 'Link/URL', 'exxon' ),
            'description'=> __('Example : <b>'.home_url().'</b>','exxon'),
            'section'    => 'exxon_redirect_url',
            'settings'   => 'exxon_redirect_url_setting',
            'type'       => 'url',
        ) )
    );

    //External Link
    $wp_customize->add_section('exxon_external_link',array(
        'title' => __('External Link','exxon')

    ));
    $wp_customize->add_setting('exxon_external_link_text', array(
        'default' => 'External Link'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_external_link_text',
        array(
            'label'      => __( 'Add text for external link', 'exxon' ),
            'section'    => 'exxon_external_link',
            'settings'   => 'exxon_external_link_text',
            'type'       => 'text',
        ) )
    );
    $wp_customize->add_setting('exxon_external_link_url', array(
        'default' => 'corporate.exxonmobil.com'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_external_link_url',
        array(
            'label'      => __( 'Add link/url for external link', 'exxon' ),
            'section'   => 'exxon_external_link',
            'settings'   => 'exxon_external_link_url',
            'type'       => 'url',
        ) )
    );
    $wp_customize->add_setting('exxon_external_link_logo', array(
        'default' => 'fa-globe'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_external_link_logo',
        array(
            'label'      => __( 'Add custom logo for external link', 'exxon' ),
            'description'=> __('Example : <b>fa-globe</b>,<b>fa-external-link</b>,<b>fa-external-link-square</b>.<br />More logo <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icon</a>.'),
            'section'    => 'exxon_external_link',
            'settings'   => 'exxon_external_link_logo',
            'type'       => 'text',
        ) )
    );

    //Static Link
    $wp_customize->add_section('exxon_static_link',array(
        'title' => __('Static Link','exxon')

    ));
    $wp_customize->add_setting('exxon_static_link_text', array(
        'default' => 'Static Link'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_static_link_text',
        array(
            'label'      => __( 'Add text for static link', 'exxon' ),
            'section'    => 'exxon_static_link',
            'settings'   => 'exxon_static_link_text',
            'type'       => 'text',
        ) )
    );
    $wp_customize->add_setting('exxon_static_link_url', array(
        'default' => 'corporate.exxonmobil.com'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_static_link_url',
        array(
            'label'      => __( 'Add link/url for static link', 'exxon' ),
            'section'   => 'exxon_static_link',
            'settings'   => 'exxon_static_link_url',
            'type'       => 'url',
        ) )
    );
    $wp_customize->add_setting('exxon_static_link_logo', array(
        'default' => 'fa-globe'
        ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'exxon_static_link_logo',
        array(
            'label'      => __( 'Add custom logo for static link', 'exxon' ),
            'description'=> __('Example : <b>fa-globe</b>.<br />More logo <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icon</a>.'),
            'section'    => 'exxon_static_link',
            'settings'   => 'exxon_static_link_logo',
            'type'       => 'text',
        ) )
    );

    // Set Color for dropdown menu
    $wp_customize->add_setting( 'exxon_dropdown_menu_color' , array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'exxon_dropdown_menu_color',
        array(
            'label'      => __( 'Dropdown Menu Color', 'exxon' ),
            'section'    => 'colors',
            'settings'   => 'exxon_dropdown_menu_color',
        ) )
    );

    // Set Color Font navigation
    $wp_customize->add_setting( 'exxon_fonts_nav_color' , array(
        'default' => '#454545',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'exxon_fonts_nav_color',
        array(
            'label'      => __( 'Color fonts navigation', 'exxon' ),
            'section'    => 'colors',
            'settings'   => 'exxon_fonts_nav_color',
        ) )
    );

    // Set Color Font Dropdown navigation
    $wp_customize->add_setting( 'exxon_fonts_dropdown_color' , array(
        'default' => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'exxon_fonts_dropdown_color',
        array(
            'label'      => __( 'Color fonts dropdown', 'exxon' ),
            'section'    => 'colors',
            'settings'   => 'exxon_fonts_dropdown_color',
        ) )
    );

    // Set Color Font Heading widget
    $wp_customize->add_setting( 'exxon_fonts_heading_widget_color' , array(
        'default' => '#3d3d3d',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'exxon_fonts_heading_widget_color',
        array(
            'label'      => __( 'Color fonts heading widget', 'exxon' ),
            'section'    => 'colors',
            'settings'   => 'exxon_fonts_heading_widget_color',
        ) )
    );

     // Set Heading widget Color
    $wp_customize->add_setting( 'exxon_heading_widget_color' , array(
        'default' => '#e0e0e0',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'exxon_heading_widget_color',
        array(
            'label'      => __( 'Heading Widget Color', 'exxon' ),
            'section'    => 'colors',
            'settings'   => 'exxon_heading_widget_color',
        ) )
    );
}
add_action( 'customize_register', 'exxon_customize_slider_register' );
endif;

if(!function_exists('exxon_child_register_script')):
	function exxon_child_register_script(){
		wp_enqueue_style( 'fontawesome-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/bootstrap.min.css' );
        wp_enqueue_style( 'bootstrap-min-theme-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/bootstrap-theme.min.css' );
        wp_enqueue_style( 'cal-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/calendar-blue.css' );

		wp_enqueue_script( 'jquery-cycle2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.js', array('jquery'), '2.1.6', true );
		wp_enqueue_script( 'jquery-cycle2-caption2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.caption2.js', array(), '20130708', true);
		wp_enqueue_script( 'bootstrap-min-js', trailingslashit(get_stylesheet_directory_uri()) . 'js/bootstrap.min.js', array('jquery'), '3.3.7', true);
        wp_enqueue_script( 'calendar-custom', trailingslashit(get_stylesheet_directory_uri()) . 'js/calendar.js', array(), '1.1' , true);
        wp_enqueue_script( 'calendar-eng-lang', trailingslashit(get_stylesheet_directory_uri()) . 'js/calendar-en.js', array(), '1.1', true );
        wp_enqueue_script( 'calendar-custom-setup', trailingslashit(get_stylesheet_directory_uri()) . 'js/calendar-setup.js', array(), '1.1' , true);
		wp_enqueue_script( 'custom-child-script', trailingslashit(get_stylesheet_directory_uri()) . 'js/script.js', array(), '1.0', true);

	}
add_action( 'wp_enqueue_scripts', 'exxon_child_register_script' );
endif;

if(!function_exists('exxon_customize_preview_js')):
function exxon_customize_preview_js() {
    wp_enqueue_script( 'twentytwelve-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20170210', true );
}
add_action( 'customize_preview_init', 'exxon_customize_preview_js' );
endif;

if(!function_exists('exoon_customizer_dropdown_color')):
function exoon_customizer_dropdown_color() {
    $link_color = get_theme_mod( 'exxon_dropdown_menu_color' );

    if ( $link_color != '#fff' ) :
    ?>
        <style type="text/css">
            ul.dropdown-menu {
                background-color: <?php echo $link_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exoon_customizer_dropdown_color' );
endif;

if(!function_exists('exxon_heading_widget_colors')):
function exxon_heading_widget_colors() {
    $link_widget_color = get_theme_mod( 'exxon_heading_widget_color' );

    if ( $link_widget_color != '#e0e0e0' ) :
    ?>
        <style type="text/css">
            div.front-exxon-sidebar aside h3.widget-title {
                background-color: <?php echo $link_widget_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exxon_heading_widget_colors' );
endif;

if(!function_exists('exxon_customizer_font_nav_color')):
function exxon_customizer_font_nav_color() {
    $link_color = get_theme_mod( 'exxon_fonts_nav_color' );

    if ( $link_color != '#454545' ) :
    ?>
        <style type="text/css">
        #main-nav .navbar-nav > li > a {
            color: <?php echo $link_color; ?>;
        }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exxon_customizer_font_nav_color' );
endif;

if(!function_exists('exxon_customizer_font_dropdown_color')):
function exxon_customizer_font_dropdown_color() {
    $link_color = get_theme_mod( 'exxon_fonts_dropdown_color' );

    if ( $link_color != '#111111' ) :
    ?>
        <style type="text/css">
            nav div ul ul li a {
                color: <?php echo $link_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exxon_customizer_font_dropdown_color' );
endif;

if(!function_exists('exxon_customizer_font_heading_widget_color')):
function exxon_customizer_font_heading_widget_color() {
    $link_color = get_theme_mod( 'exxon_fonts_heading_widget_color' );

    if ( $link_color != '#3d3d3d' ) :
    ?>
        <style type="text/css">
        div.front-exxon-sidebar aside h3.widget-title {
                color: <?php echo $link_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exxon_customizer_font_heading_widget_color' );
endif;

if(!function_exists('exxon_def_customize_register')):
function exxon_def_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'exxon_def_customize_register' );
endif;

if(!function_exists('exxon_customizer_header_textcolor')):
function exxon_customizer_header_textcolor() {
    $link_color = get_header_textcolor();
    $link_color_def = '7b7b7b';

    if ( $link_color != 'blank' ) :
    ?>
        <style type="text/css">
        nav#main-nav .navbar-title,
        nav#main-nav .navbar-logo {
                color: #<?php echo $link_color; ?>;
            }
        </style>
    <?php else: ?>
        <style type="text/css">
        nav#main-nav .navbar-title,
        nav#main-nav .navbar-logo {
                color: #<?php echo $link_color_def; ?>;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'exxon_customizer_header_textcolor' );
endif;

if(!function_exists('exxon_customizer_styles')):
function exxon_customizer_styles() { ?>
    <style>
        #customize-theme-controls li#accordion-section-add_lgs ul.accordion-section-content li[id^="customize-control-exxon_lk-"] {
            border-top: 2px solid #333;
        }
        #customize-theme-controls li#accordion-section-add_lgs ul.accordion-section-content > li#customize-control-exxon_lk-0 {
            border-top: none;
        }
        #customize-theme-controls li#accordion-section-colors ul.accordion-section-content > li#customize-control-uc_nav_color {
            display: none !important;
        }
        #customize-theme-controls li#accordion-section-add_logos  {
            display: none !important;
        }
        #customize-theme-controls ul > li#accordion-section-title_tagline > ul.accordion-section-content > li#customize-control-display_header_text {
            display: none !important;
        }
    </style>
    <?php

}
add_action( 'customize_controls_print_styles', 'exxon_customizer_styles', 999 );
endif;

class exxon_walker_nav_menu extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul class=\"sub-menu dropdown-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
        if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;

        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
        endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}

function getHeaderImage() {
  $headerImage = get_header_image();
  if ( '' == $headerImage ) {
   $headerImage = get_stylesheet_directory_uri() . '/img/2000px-Exxon_Mobil_Logo.svg.png';
  }
  return $headerImage;
}

if(!function_exists('exxon_set_header_image')):
function exxon_set_header_image() {
    $exxon_header_img = getHeaderImage();

    ?>
        <style type="text/css">
        nav#main-nav .navbar-logo {
            background-image: url(<?php echo $exxon_header_img;?>) !important;
        }
        </style>
    <?php
}
add_action( 'wp_head', 'exxon_set_header_image' );
endif;

if(!function_exists('exxon_setup')):
function exxon_setup() {
    register_nav_menu( 'footer_nav_one', __( 'Footer Nav', 'exxon' ) );
    register_nav_menu( 'footer_nav_two', __( 'Footer Nav 2', 'exxon' ) );
}
add_action( 'after_setup_theme', 'exxon_setup' );
endif;


//frontpage widget register
function exxon_frontpage_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Frontpage Exxon Widget', 'twentytwelve' ),
        'id' => 'front-sidebar',
        'description' => __( 'Appears in frontpage only', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_widget('jetty_widget_twitter_feed');
    // Remove unused sidebar from Parent Theme
    unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}
add_action( 'widgets_init', 'exxon_frontpage_widgets_init', 11 );


// Exxon Breadcrumbs
if(!function_exists('exxon_breadcrumbs')) :
    function exxon_breadcrumbs($addTexts = true) {
    $home = 'Home';
    $before = '<li class="active">';
    $sep = '';
    $after = '</li>';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<ol class="breadcrumb hidden-xs clearfix">';
        global $post;
        $homeLink = home_url();
        echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $sep . '</li> ';
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo '<li>'.get_category_parents($parentCat, true, "{$sep}</li><li>").'</li>';
            }
            $format = $before . ($addTexts ? (__('Archive by category ', 'exxon') . '"%s"') : '%s') . $after;
            echo sprintf($format, single_cat_title('', false));

        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
            ) . '</a></li> ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                    'F'
            ) . '</a></li> ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
            ) . '</a></li> ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo '<li>' . get_category_parents($cat, true, $sep) . '</li>';
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search()) {
            $post_type = get_post_type_object(get_post_type());
            if(!empty($post_type)) :
            echo $before . $post_type->labels->singular_name . $after;
            endif;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, $sep);
            echo '<li><a href="' . get_permalink(
                    $parent
            ) . '">' . $parent->post_title . '</a></li> ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title(
                                $page->ID
                        ) . '</a>' . $sep . '</li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            $format = $before . ($addTexts ? (__('Search results for "', 'exxon') . '"%s"') : '%s') . $after;
            echo sprintf($format, get_search_query());
        } elseif (is_tag()) {
            $format = $before . ($addTexts ? (__('Posts tagged "', 'exxon') . '"%s"') : '%s') . $after;
            echo sprintf($format, single_tag_title('', false));
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            $format = $before . ($addTexts ? (__('Articles posted by ', 'exxon') . '"%s"') : '%s') . $after;
            echo sprintf($format, $userdata->display_name);
        } elseif (is_404()) {
            echo $before . __('Error 404', 'exxon') . $after;
        }
        echo '</ol>';
    }
}
endif;

// Exxon Pagination
if(!function_exists('exxon_pagination')) :
function exxon_pagination() {
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_next' => true,
        'prev_text' => __( '&laquo; prev', 'cobalt' ),
        'next_text' => __( 'next &raquo;', 'cobalt' ),
        'type' => 'list',
    ) );
    $paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='cob_pagination'>", $paginate_links );
    $paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
    $paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links );
    $paginate_links = str_replace( '</span>', '</a>', $paginate_links );
    $paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
    $paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
    // Display the pagination if more than one page is found.
    if ( $paginate_links ) {
        echo '<div class="pagination-centered">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}
endif;

include 'inc/jetty-advance-search.php';
include 'inc/jetty-widget-twitter-feed.php';
include 'inc/jetty-redirect-custom-url-home.php';

function change_height_of_header(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
       /* fixing for overlapping wpadmin bar on jetty */
        @media (min-width: 768px) {
            header#masthead {
                margin-top: 18px;
            }
        }
    </style>
<?php
    endif;
}
add_action('wp_head','change_height_of_header');

if(!function_exists('exxon_filter_theme_page_templates')){
    function exxon_filter_theme_page_templates( $page_templates ) {
        
        if ( isset( $page_templates['page-templates/full-width.php'] ) ) {
            unset( $page_templates['page-templates/full-width.php'] );
        }
        if ( isset( $page_templates['page-templates/template-one.php'] ) ) {
            unset( $page_templates['page-templates/template-one.php'] );
        }
        if ( isset( $page_templates['page-templates/template-two.php'] ) ) {
            unset( $page_templates['page-templates/template-two.php'] );
        }
        if ( isset( $page_templates['page-templates/front-page.php'] ) ) {
            unset( $page_templates['page-templates/front-page.php'] );
        }

        return $page_templates;
    }
}
add_filter( 'theme_page_templates', 'exxon_filter_theme_page_templates', 20, 1);

add_filter('widget_text', 'do_shortcode');