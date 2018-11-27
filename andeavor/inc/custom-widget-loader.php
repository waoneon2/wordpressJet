<?php

// require 'widget-box/jetty-widget-box.php';
require 'widget-box/jetty-widget-andeavor-category-update.php';
require 'widget-box/jetty-widget-button-text.php';
require 'widget-box/jetty-widget-andeavor-category-faq.php';

function andeavor_custom_register_widget() {
	register_widget('Jetty_Widget_Andeavor_Category_Update');
	register_widget('Jetty_Widget_Button_Text');
	register_widget('Jetty_Widget_Andeavor_Category_Faq');
}
add_action( 'widgets_init', 'andeavor_custom_register_widget' );

function andeavor_custom_widget_area() {
	register_sidebar( array(
		'name'			=> esc_html__( 'Homepage', 'andeavor' ),
		'id'			=> 'jetty-homepage',
		'description'	=> esc_html__( 'Widget area for Homepage', 'andeavor' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s col-md-6 content-left-right"><div class="box-content box">',
	    'after_widget'  => '</div></section>',
	    'before_title'  => '<h2 class="widget-title">',
	    'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'andeavor_custom_widget_area' );