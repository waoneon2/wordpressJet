<?php
/*
Plugin Name: Archived Inquiries
Plugin URI: http://eresources.com/
Description: Jetty Inquiry
Version: 1.0.0
Author: Jetty Team
Author URI: http://eresources.com/
License: GPLv2 or later
Text Domain: jai
*/

define('JAI_DB_VERSION', '0.0.1');
define('JAI_VERSION', '0.0.1');

function jai_with_file($file, $mode, $cb) {
    if (($handle = fopen($file, $mode)) !== false) {
        try {
            call_user_func($cb, $handle);
        } finally {
             fclose($handle);
        }
    }
}

include __DIR__ . '/ai-core.php';
include __DIR__ . '/includes/cpt.php';
include __DIR__. '/ai-ajax.php';

if (is_admin()) {
    include __DIR__ . '/admin/admin-init.php';
    include __DIR__ . '/admin/inquiry-table-data.php';
    include __DIR__ . '/admin/import-export.php';
}

add_action('admin_enqueue_scripts', 'jai_admin_scripts');
function jai_admin_scripts() {
    $screen       = get_current_screen();
    $screen_id    = $screen ? $screen->id : '';

    $url = plugin_dir_url(__FILE__);

    wp_enqueue_style('jai-admin-style', $url . 'assets/jai-style.css');
    wp_register_script('jai-admin', $url . 'assets/jai-admin.js', ['jquery'], JAI_VERSION, true);
    if ( in_array( $screen_id, ['edit-jai_archived_inquiry', 'jai_archived_inquiry', 'admin_page_jai_view_as_report'])) {
        add_thickbox();
        wp_enqueue_script('jai-admin');
    }
}