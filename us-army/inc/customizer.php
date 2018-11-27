<?php
/**
 * US Army Theme Customizer
 *
 * @package US_Army
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function us_army_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'us_army_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function us_army_customize_preview_js() {
	wp_enqueue_script( 'us_army_customizer', get_template_directory_uri() . '/js/customizer_wp.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'us_army_customize_preview_js' );
