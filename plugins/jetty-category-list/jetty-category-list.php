<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: Jetty Category List
Plugin URI: http://eresources.com
Description: A widget that allow to display your posts in widget areas
Version: 0.1
Author: Jetty Team
Author URI: http://eresources.com
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// register the widget
function jmc_register_widgets() {
    require __DIR__ . '/class-jetty-category-list-widget.php';
    register_widget('Jetty_Category_List_Widget');
}

add_action('widgets_init', 'jmc_register_widgets');

add_filter( 'wp_dropdown_cats', 'wp_dropdown_cats_multiple', 10, 2 );
function wp_dropdown_cats_multiple( $output, $r ) {

    if( isset( $r['multiple'] ) && $r['multiple'] ) {

         $output = preg_replace( '/^<select/i', '<select multiple', $output );

        $output = str_replace( "name='{$r['name']}'", "name='{$r['name']}[]'", $output );

        foreach ( array_map( 'trim', explode( ",", $r['selected'] ) ) as $value )
            $output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );

    }
    return $output;
}