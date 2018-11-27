<?php

require 'widget-horizontal-tab/jetty-widget-horizontal-tab.php';

require 'widget-vertical-tab/jetty-widget-vertical-tab.php';

require 'widget-promo/jetty-widget-promo.php';

require 'widget-collapse-gallery/jetty-widget-collapse-gallery.php';

require 'widget-message/jetty-widget-message.php';

require 'widget-info-box/jetty-widget-info-box.php';

require 'widget-carousel/jetty-widget-carousel.php';

require 'widget-statistics/jetty-widget-statistics.php';

function p66_custom_register_widgets() {
    register_widget('Jetty_Widget_Horizontal_Tab');
    register_widget('Jetty_Widget_Vertical_Tab');
    register_widget('Jetty_Widget_Promo');
    register_widget('Jetty_Widget_Collapse_Gallery');
    register_widget('Jetty_Widget_Message');
    register_widget('Jetty_Widget_Info_Box');
    register_widget('Jetty_Widget_Carousel');
    register_widget('Jetty_Widget_Statistics');
}
add_action('widgets_init', 'p66_custom_register_widgets');

function p66_custom_widgets_area() {
  register_sidebar( array(
    'name'          => esc_html__( 'About Page', 'p66' ),
    'id'            => 'jetty-about-page',
    'description'   => esc_html__( 'Widget area for about page', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Businesses Page', 'p66' ),
    'id'            => 'jetty-businesses-page',
    'description'   => esc_html__( 'Widget area for businesses page', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

    register_sidebar( array(
    'name'          => esc_html__( 'Sustainability Page', 'p66' ),
    'id'            => 'jetty-sustainability-page',
    'description'   => esc_html__( 'Widget area for businesses page', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Refinery Block 1', 'p66' ),
    'id'            => 'jetty-refinery-page-1',
    'description'   => esc_html__( 'Widget area for refinery pages', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Refinery Block 2', 'p66' ),
    'id'            => 'jetty-refinery-page-2',
    'description'   => esc_html__( 'Widget area for refinery pages', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Refinery Block 3', 'p66' ),
    'id'            => 'jetty-refinery-page-3',
    'description'   => esc_html__( 'Widget area for refinery pages', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Refinery Block 4', 'p66' ),
    'id'            => 'jetty-refinery-page-4',
    'description'   => esc_html__( 'Widget area for refinery pages', 'p66' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'p66_custom_widgets_area' );

function p66_custom_widgets_enqueue_admin_scripts() {
    global $pagenow;

    // HORIZONTAL TABS
    wp_register_script('jw-horizontal-tab', get_template_directory_uri() . '/inc/widget-horizontal-tab/js/widget-horizontal-tab.js', array('jquery'));
    wp_register_style('jw-horizontal-tab', get_template_directory_uri() . '/inc/widget-horizontal-tab/css/widget-horizontal-tab.css');
    wp_localize_script('jw-horizontal-tab', 'jw_admin_horizontal_tab', array(
        'remove_text' => __('Remove', 'jetty'),
        'label_tab_title' => __( 'Tab Title', 'jetty' ),
        'label_content1' => __( 'Content 1', 'jetty' ),
        'label_content2' => __( 'Content 2', 'jetty' )
    ));
    // VERTICAL TABS
    wp_register_script('jw-vertical-tab', get_template_directory_uri() . '/inc/widget-vertical-tab/js/widget-vertical-tab.js', array('jquery'));
    wp_register_style('jw-vertical-tab', get_template_directory_uri() . '/inc/widget-vertical-tab/css/widget-vertical-tab.css');
    wp_localize_script('jw-vertical-tab', 'jw_admin_vertical_tab', array(
        'btn_text' => __('Upload', 'jetty'),
        'remove_text' => __('Remove', 'jetty'),
        'label_tab_title' => __( 'Tab Title', 'jetty' ),
        'label_content' => __( 'Content', 'jetty' ),
        'label_url_text' => __( 'Url Text', 'jetty' ),
        'label_url' => __( 'Url', 'jetty' )
    ));
    // PROMO
    wp_register_script('jw-promo', get_template_directory_uri() . '/inc/widget-promo/js/widget-promo.js', array('jquery'));
    wp_register_style('jw-promo', get_template_directory_uri() . '/inc/widget-promo/css/widget-promo.css');
    wp_localize_script('jw-promo', 'jw_admin_promo', array());

    // CAROUSEL
    wp_register_script('jw-carousel', get_template_directory_uri() . '/inc/widget-carousel/js/widget-carousel.js', array('jquery'));
    wp_register_style('jw-carousel', get_template_directory_uri() . '/inc/widget-carousel/css/widget-carousel.css');
    wp_localize_script('jw-carousel', 'jw_admin_carousel', array(
        'btn_text' => __('Upload', 'jetty'),
        'remove_text' => __('Remove', 'jetty'),
        'label_desc' => __( 'Description', 'jetty' ),
        'label_type' => __( 'Carousel Type', 'jetty' ),
    ));

    // only loads our scripts on widgets page and customizer
    if (in_array($pagenow,  array('widgets.php', 'customize.php'))) {
        wp_enqueue_media();
        wp_enqueue_script('jw-horizontal-tab');
        wp_enqueue_style('jw-horizontal-tab');
        wp_enqueue_script('jw-vertical-tab');
        wp_enqueue_style('jw-vertical-tab');
        wp_enqueue_script('jw-promo');
        wp_enqueue_style('jw-promo');
        wp_enqueue_script('jw-carousel');
    }
}

add_action('admin_enqueue_scripts', 'p66_custom_widgets_enqueue_admin_scripts');
