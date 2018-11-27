<?php
/**
 * @package Jetty Social Monitoring
 * @version 1.0
 */
/*
Plugin Name: Jetty Social Monitoring
Plugin URI: https://jettyapp.com/
Description: Jetty Social Monitoring
Author: Jetty Team
Version: 1.0
Author URI: https://jettyapp.com/
Text Domain: jetty_smm
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
include_once( plugin_dir_path( __FILE__ ) . 'class-register-assets.php' );
include_once( plugin_dir_path( __FILE__ ) . 'assets/jcs/twitter-oauth.php' );
include_once( plugin_dir_path( __FILE__ ) . 'hook-social-monitoring.php' );

add_action( 'plugins_loaded', array( 'JSSM', 'GetInstance' ) );
 
$SocialMediaMonitoring = JSSM::GetInstance();
$SocialMediaMonitoring->InitPlugin();
?>