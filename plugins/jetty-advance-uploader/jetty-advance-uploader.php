<?php
/*
Plugin Name: Jetty Advance Uploader
Plugin URI: https://jettyapp.com/
Description: Jetty Advance Uploader
Version: 0.0.1
Author: Jetty Team
Author URI: https://jettyapp.com/
Text Domain: jau, jetty
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Default value of chunk size and max retry.
// For explanation chunk and max retry https://github.com/moxiecode/plupload/wiki/Chunking
define('jau_chunk_size', 512);
define('jau_max_retry', 6);

// max execution time change to 30 minutes.
@ini_set( 'max_execution_time', '9000' );

function jau_get_mime_type( $filename ) {
    if ( function_exists( 'mime_content_type' ) ) {
        return mime_content_type( $filename );
    }
}

add_filter('upload_post_params', 'jau_filter_params');
add_filter('plupload_default_params', 'jau_filter_params');
function jau_filter_params($jfp){
    $jfp['action'] = 'jau_upload_large_file';
    return $jfp;
}

// disk_free_space : Returns available space on filesystem or disk partition
// sys_get_temp_dir : Returns directory path used for temporary files
add_filter('upload_size_limit', 'jau_disk_free_space');
function jau_disk_free_space($none){
    $free_space = disk_free_space( sys_get_temp_dir() );
    if ( $free_space === false ) {
        $free_space = 0;
    }
    return $free_space;
}

add_filter('plupload_init', 'jau_wp_upload_settings');
add_filter('plupload_default_settings', 'jau_wp_upload_settings');
function jau_wp_upload_settings($jau_wpus){
    $jau_wp_chunk_size = jau_chunk_size . 'kb';
    $jau_wp_max_retry = jau_max_retry;
    $jau_wp_max_filesize = jau_disk_free_space('') . 'b';

    $jau_wpus['url'] = admin_url( 'admin-ajax.php' );
    $jau_wpus['filters']['max_file_size'] = $jau_wp_max_filesize;
    $jau_wpus['chunk_size'] = $jau_wp_chunk_size;
    $jau_wpus['max_retries'] = $jau_wp_max_retry;

    return $jau_wpus;
}

include __DIR__ . '/jau-ajax-settings.php';