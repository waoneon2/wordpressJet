<?php
/*
Version: 0.0.1
Author: Jetty Team
Author URI: http://eresources.com/
License: GPLv2 or later
*/

require __DIR__ . '/class-jetty_irotator_widget.php';

// register the widget
function jirw_register_widgets() {
    register_widget('Jetty_IRotator_Widget');
}
add_action('widgets_init', 'jirw_register_widgets');

