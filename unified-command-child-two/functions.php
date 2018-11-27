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
function uctwo_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Front Page Unified Command Child 2 Widget Area', 'uc' ),
        'id' => 'sidebar-ucctwo',
        'description' => __( 'Appears when using the optional Front Page Unified Command Child 2 template with a page set as Static Front Page', 'uc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'uctwo_widgets_init' );

if(!function_exists('uc_customize_slider_register')):
function uc_customize_slider_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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

    //button header link
    $wp_customize->add_section('button_head',array(
        'title' => __('Header Button Link','uc')

    ));

    $wp_customize->add_setting('bt_head_label');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'bt_head_label',
        array(
            'label'      => __( 'Add label for button', 'uc' ),
            'section'   => 'button_head',
            'settings'   => 'bt_head_label',
            'type'       => 'text',
        ) )
    );

    $wp_customize->add_setting('bt_head_link');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'bt_head_link',
        array(
            'label'      => __( 'Add Link for button', 'uc' ),
            'section'   => 'button_head',
            'settings'   => 'bt_head_link',
            'type'       => 'url',
        ) )
    );

    // Set Color of Dropdown menu
    $wp_customize->add_setting( 'uc_dropdown_menu_color' , array(
        'default' => '#fff',
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
        'default' => '#b0b1b2',
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
        'default' => '#111111',
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

    // Set Color Font Heading widget
    $wp_customize->add_setting( 'uc_fonts_heading_widget_color' , array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_fonts_heading_widget_color',
        array(
            'label'      => __( 'Color fonts heading widget', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_fonts_heading_widget_color',
        ) )
    );

     // Set Heading widget Color
    $wp_customize->add_setting( 'uc_heading_widget_color' , array(
        'default' => '#98B8C7',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'uc_heading_widget_color',
        array(
            'label'      => __( 'Heading Widget Color', 'uc' ),
            'section'    => 'colors',
            'settings'   => 'uc_heading_widget_color',
        ) )
    );

    $wp_customize->remove_setting('uc_nav_color');
    $wp_customize->remove_control('uc_nav_color');

    // set color nav menu
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
		wp_enqueue_style( 'fontawesome-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/bootstrap.min.css' );
        wp_enqueue_style( 'bootstrap-min-theme-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/bootstrap-theme.min.css' );
		wp_enqueue_script( 'jquery-cycle2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.js', array('jquery'), '2.1.6', true );
		wp_enqueue_script( 'jquery-cycle2-caption2', trailingslashit(get_stylesheet_directory_uri()) . 'js/jquery.cycle2.caption2.js', array(), '20130708', true);
		wp_enqueue_script( 'bootstrap-min-js', trailingslashit(get_stylesheet_directory_uri()) . 'js/bootstrap.min.js', array('jquery'), '3.3.7', true);
		wp_enqueue_script( 'custom-child-script', trailingslashit(get_stylesheet_directory_uri()) . 'js/script.js', array(), '1.0', true);

	}
add_action( 'wp_enqueue_scripts', 'uc_child_register_script' );
endif;

if(!function_exists('uc_customizer_dropdown_color')):
function uc_customizer_dropdown_color() {
    $link_color = get_theme_mod( 'uc_dropdown_menu_color' );

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
add_action( 'wp_head', 'uc_customizer_dropdown_color' );
endif;

if(!function_exists('uc_heading_widget_colors')):
function uc_heading_widget_colors() {
    $link_widget_color = get_theme_mod( 'uc_heading_widget_color' );

    if ( $link_widget_color != '#98B8C7' ) :
    ?>
        <style type="text/css">
            div.sidebar-tmp2 aside h3.widget-title {
                background-color: <?php echo $link_widget_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_heading_widget_colors' );
endif;

if(!function_exists('uc_customizer_font_nav_color')):
function uc_customizer_font_nav_color() {
    $link_color = get_theme_mod( 'uc_fonts_nav_color' );

    if ( $link_color != '#ffffff' ) :
    ?>
        <style type="text/css">
        #page.page-tmp2 nav div > ul > li > a {
            color: <?php echo $link_color; ?> !important;
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

    if ( $link_color != '#111111' ) :
    ?>
        <style type="text/css">
        @media (min-width: 768px){
            #page.page-tmp2 nav div ul ul li a {
                color: <?php echo $link_color; ?> !important;
            }
        }

        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_font_dropdown_color' );
endif;

if(!function_exists('uc_customizer_font_heading_widget_color')):
function uc_customizer_font_heading_widget_color() {
    $link_color = get_theme_mod( 'uc_fonts_heading_widget_color' );

    if ( $link_color != '#ffffff' ) :
    ?>
        <style type="text/css">
        div.sidebar-tmp2 aside h3.widget-title {
                color: <?php echo $link_color; ?> !important;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_font_heading_widget_color' );
endif;

if(!function_exists('uc_def_customize_preview_js')):
function uc_def_customize_preview_js() {
    wp_enqueue_script( 'uc-childtwo-customizer', trailingslashit(get_stylesheet_directory_uri()) . 'js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'uc_def_customize_preview_js' );
endif;

if(!function_exists('uc_customizer_header_textcolor')):
function uc_customizer_header_textcolor() {
    $link_color = get_header_textcolor();
    $link_color_def = '369';
    
    if ( $link_color != 'blank' ) :
    ?>
        <style type="text/css">
        div.banner-title h2, div.banner-title h3 {
                color: #<?php echo $link_color; ?>;
            }
        </style>
    <?php else: ?>
        <style type="text/css">
        div.banner-title h2, div.banner-title h3 {
                color: #<?php echo $link_color_def; ?>;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_customizer_header_textcolor' );
endif;

if(!function_exists('uc_two_nav_color')):
function uc_two_nav_color() {
    $link_color = get_theme_mod('uc_nav_color','#b0b1b2');

    if ( $link_color != '#b0b1b2' ) :
    ?>
        <style type="text/css">
        div.page-tmp2 nav.navbar.navbar-inverse {
            background-image: none;
            background-color: <?php echo $link_color; ?> !important;
        }
        </style>
    <?php else: ?>
        <style type="text/css">
        div.page-tmp2 nav.navbar.navbar-inverse {
            background-image: none;
            background-color: <?php echo $link_color; ?> !important;
        }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'uc_two_nav_color' );
endif;

function set_style_body(){
    if(is_admin_bar_showing()):
?>
    <style type="text/css">
        header {
            margin-top: 18px;
        }
        @media screen and (max-width: 782px){
            header {
                margin-top: 4px;
            }
        }
    </style>
<?php
    endif;
}
add_action( 'wp_head', 'set_style_body' );

if ( ! function_exists( 'uc_two_entry_meta' ) ) :
function uc_two_entry_meta() {
    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'uc_two' ) );

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'uc_two' ) );

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time( 'F j, Y g:i A' ) ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date( 'F j, Y g:i A' ) )
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    if ( $tag_list ) {
        $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s.', 'uc_two' );
    } elseif ( $categories_list ) {
        $utility_text = __( 'This entry was posted in %1$s on %3$s.', 'uc_two' );
    } else {
        $utility_text = __( 'This entry was posted on %3$s.', 'uc_two' );
    }

    printf(
        $utility_text,
        $categories_list,
        $tag_list,
        $date
    );
}
endif;





?>