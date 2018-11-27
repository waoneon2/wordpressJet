<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Jetty_UI
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 *
 * @wordpress-plugin
 * Plugin Name:       Jetty UI
 * Plugin URI:        http://jettyapp.com
 * Description:       Jetty UI
 * Version:           1.0.0
 * Author:            Jetty
 * Author URI:        http://jettyapp.com
 * Text Domain:       plugin-name-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-jetty-ui.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
register_activation_hook( __FILE__, array( 'Jetty_UI', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Jetty_UI', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
add_action( 'plugins_loaded', array( 'Jetty_UI', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/class-jetty-metrics.php' );
	new Jetty_Ui_Jetty_Metrics;

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-jetty-ui-admin.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/wp-private-pages-in-menu-builder.php' );
	add_action( 'plugins_loaded', array( 'Jetty_UI_Admin', 'get_instance' ) );
}
if ( is_admin() ) {

	add_action( 'admin_enqueue_scripts', 'enqueue_admin_on_ajax_styles' );
	add_action( 'admin_enqueue_scripts', 'enqueue_admin_on_ajax_scripts' );
	add_action( 'wp_ajax_get_content_status_board', 'get_content_status_board' );
	add_action( 'wp_ajax_dynamic_timer', 'dynamic_timer' );
	add_action( 'wp_ajax_save_event_top_widget_sortable', 'save_event_top_widget_sortable' );
	add_action( 'wp_ajax_save_event_bottom_widget_sortable', 'save_event_bottom_widget_sortable' );
	add_action( 'wp_ajax_save_event_handler_custom_checked', 'save_event_handler_custom_checked' );

	function enqueue_admin_on_ajax_styles() {

	}

	function enqueue_admin_on_ajax_scripts() {
		$screen = get_current_screen();
		if($screen->id == 'dashboard' || $screen->id == 'dashboard_page_jetty-admin-dashboard'){
			wp_enqueue_script( 'jetty_ui_admin_on_ajax_scripts', plugins_url( 'admin/assets/js/on-admin-ajax.js', __FILE__ ), array( 'jquery'), '1.0.0', true );
			wp_localize_script( 'jetty_ui_admin_on_ajax_scripts', 'jetty_ui_ajax_status_board', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));
		}

		if($screen->id === 'dashboard_page_jetty-admin-dashboard'){
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jetty_ui_admin_main_dashboard', plugins_url( 'admin/assets/js/jetty-ui-admin-dashboard.js', __FILE__ ), array( 'jquery' ), '1.1.0', true );
			wp_localize_script( 'jetty_ui_admin_main_dashboard', 'jetty_ui_sortable_widget_chart', array(
				'chart_ajax_url' => admin_url( 'admin-ajax.php' )
			));
		}

		wp_enqueue_script( 'jetty_ui_admin_on_ajax_time_scripts', plugins_url( 'admin/assets/js/timer-on-admin-ajax.js', __FILE__ ), array( 'jquery'), '1.0.0', true );
		wp_localize_script( 'jetty_ui_admin_on_ajax_time_scripts', 'jetty_ui_timer', array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));
	}

	function save_event_handler_custom_checked(){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$datachecked = $_POST['datachecked'];
			$data = json_encode($datachecked);
			update_option('handler_custom_checked', $data);
			echo get_option('handler_custom_checked','');
			die();
		}
	}

	function save_event_top_widget_sortable(){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$dataSortable = $_POST['datasort'];
			update_option('top_widget_sort_chart', $dataSortable);
			echo get_option('top_widget_sort_chart','id=1&id=2&id=3&id=4');
			die();
		}
	}

	function save_event_bottom_widget_sortable(){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$dataSortable = $_POST['datasortsecond'];
			update_option('bottom_widget_sort_chart', $dataSortable);
			echo get_option('bottom_widget_sort_chart','id=1&id=2');
			die();
		}
	}

	function dynamic_timer(){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$current_time = current_time('g:i A');
			$timezone = get_option('timezone_string') ? get_option('timezone_string') : 'UTC '.get_option('gmt_offset');
			echo $current_time.' '.$timezone;
			die();
		}
	}

	function get_content_status_board(){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			if(isset($_POST['post_id'])){
				$status_board_id = $_POST['post_id'];
				$args = array(
					'p' => $status_board_id,
					'post_type' => 'status_board',
				);

				$status_board_query = new WP_Query($args);
				if ( $status_board_query->have_posts() ) {
					while ( $status_board_query->have_posts() ) {
						$status_board_query->the_post();
						$arr_content_board = array(
							'title' 		=> get_the_title(),
							'content' 		=> get_the_content(),
							'edit_link'		=> esc_url(get_edit_post_link(get_the_id()))
						);
						echo json_encode($arr_content_board);
					}
				}
				wp_reset_postdata();
			}
		}
		die();
	}
}
// turns off admin notice in mh_newsdesk theme
function mh_newsdesk_admin_notice() {}
