<?php
/**
 * Jetty UI.
 *
 * @package   Jetty_UI_Admin
 * @author    Jetty Team <team@jettyapp.com>
 * @license   GPL-2.0+
 * @link      https://jettyapp.com
 * @copyright 2016-2017 Jetty
 */

 /*
 * @package Jetty_UI_Admin
 * @author  Jetty Team <team@jettyapp.com>
 */
class Jetty_UI_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		$plugin = Jetty_UI::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Overwrite redirect dashboard from jetty core
		add_action('load-index.php', array( &$this,'jetty_ui_redirect_dashboard'), 9999 );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ));
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		// Update footer text
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
		add_filter( 'update_footer', array( $this, 'admin_footer_version' ), 20 );

		// Remove dashboard widgets
		add_action('wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );
		add_action('wp_network_dashboard_setup', array( $this, 'remove_network_dashboard_widgets' ) );

		// Adding new widget on admin Dashboard
		add_action('wp_dashboard_setup',array( $this, 'add_dashboard_widget'));

		// Remove  WordPress Welcome Panel
		remove_action('welcome_panel', 'wp_welcome_panel' );

		// Change page title
		add_filter('admin_title', array( $this, 'dashboard_title' ), 10, 2);

		// Remove admin-specific menu items
		add_action( 'admin_menu', array( $this, 'customize_admin_menu' ), 999 );

		// Update text
		add_filter( 'gettext', array( $this, 'customize_text' ), 20, 3 );
		add_filter( 'ngettext', array( $this, 'customize_text' ), 20, 3 );

		// Remove help tab from admin pages
		add_filter( 'contextual_help', array( $this, 'hijack_admin_help_tabs'), 1, 3 );

		// Customize post list
		add_action( 'init', array( $this, 'customize_posts_list' ) );

		add_action('admin_head', array($this, 'set_html_dialog'));

		// Dashboard Jetty Admin
		add_action('admin_menu', array( &$this,'jetty_ui_new_register_menu') );

		// 
		add_action('add_meta_boxes_dashboard_page_jetty-admin-dashboard',array($this,'add_mb_to_cp'));
	}

	public function add_mb_to_cp(){
		 add_meta_box(
	        'jetty_ui_rsb',
	        __('Recent Status Boards','jetty_ui'),
	        array($this, 'jetty_ui_dashboard_status_boards'),
	        'dashboard_page_jetty-admin-dashboard',
	        'side' 
	    );

		add_meta_box(
	        'jetty_ui_ri', 
	        __('Recent Inquiries','jetty_ui'),
	        array($this, 'jetty_ui_dashboard_inquiries'),
	        'dashboard_page_jetty-admin-dashboard',
	        'normal' 
	    );
	}

	public function jetty_ui_redirect_dashboard(){
		if( is_admin() ) {
			$screen = get_current_screen();

			if( $screen->base == 'dashboard' ) {
				wp_safe_redirect( admin_url( 'index.php?page=jetty-admin-dashboard' ) );
				exit;
			}
		}
	}

	public function jetty_ui_new_register_menu() {
		global $jad;
		$jad = add_dashboard_page( 'Jetty Dashboard', '', 'read', 'jetty-admin-dashboard', array( &$this,'jetty_ui_new_create_dashboard') );
		add_action("load-$jad", array($this, "jetty_ui_custom_main_dashboard_screen_options"));
		add_action("admin_footer-$jad", array($this, "jetty_ui_custom_main_dashboard_footer"));
	}

	function jetty_ui_custom_main_dashboard_footer() {
		global $jad;
	    ?>
	    <script>jQuery(document).ready(function(){ postboxes.add_postbox_toggles(pagenow);});</script>
	    <?php
	}

	public function jetty_ui_custom_main_dashboard_screen_options(){
		global $jad;
		$screen = get_current_screen();

		do_action('add_meta_boxes_'.$jad, null);
    	do_action('add_meta_boxes', $jad, null);

    	wp_enqueue_script('postbox');

		if(!is_object($screen) || $screen->id != $jad)
			return;
		// https://code.tutsplus.com/articles/integrating-with-wordpress-ui-meta-boxes-on-custom-pages--wp-26843
	}

	public function jetty_ui_new_create_dashboard() {
		include_once( 'includes/jetty-dashboard-admin.php'  );
	}

	public function set_html_dialog(){
		$dialog_html = '';
		$dialog_html .= '<div id="status-board-modal" class="hidden" style="max-width:800px">';
			$dialog_html .= '<div class="container-content">';
				$dialog_html .= '<h3 class="on_title"></h3>';
				$dialog_html .= '<p class="on_content"></p>';
			$dialog_html .= '</div>';

			$dialog_html .= '<hr>';

			$dialog_html .= '<div class="container-footer">';
				$dialog_html .= '<p class="on_control"></p>';
			$dialog_html .= '</div>';
		$dialog_html .= '</div>';

		$dialog_html .= '<input type="hidden" id="top_widget_sort_value" value="'.get_option('top_widget_sort_chart','id=1&id=2&id=3&id=4').'"></input>';
		$dialog_html .= '<input type="hidden" id="bottom_widget_sort_value" value="'.get_option('bottom_widget_sort_chart','id=1&id=2').'"></input>';
		$dialog_html .= '<div id="custom_c_v_div" style="display:none;">';
			$dialog_html .= get_option('handler_custom_checked','');
		$dialog_html .= '</div>';

		echo $dialog_html;
	}

	public function add_dashboard_widget(){
		wp_add_dashboard_widget('dashboard_inquiries', __('Recent Inquiries','jetty-ui'), array($this,'jetty_ui_dashboard_inquiries'));
		wp_add_dashboard_widget('dashboard_status_boards', __('Recent Boards','jetty-ui'), array($this,'jetty_ui_dashboard_status_boards'));

		wp_add_dashboard_widget('dashboard_inquiries_by_status', __('Inquiries by Status','jetty-ui'), array($this,'jetty_ui_dashboard_inquiries_by_status'));
		wp_add_dashboard_widget('dashboard_inquiries_by_category', __('Inquiries by Category','jetty-ui'), array($this,'jetty_ui_dashboard_inquiries_by_category'));
		wp_add_dashboard_widget('dashboard_inquiries_by_source', __('Inquiries by Source','jetty-ui'), array($this,'jetty_ui_dashboard_inquiries_by_source'));
		wp_add_dashboard_widget('dashboard_post_by_status', __('Posts by Category','jetty-ui'), array($this,'jetty_ui_dashboard_post_by_status'));
	}

	public function jetty_ui_dashboard_inquiries(){
		$args = [
			'post_type' => 'inquiry',
			'posts_per_page' => 10,
			'post_status' => 'publish',
		];
		$the_query = new WP_Query( $args );
		$i = 0;

		$owner = "";

		$html_table = '';
		$html_table .= '<table class="wp-list-table widefat fixed">';
			$html_table .= '<thead>';
				$html_table .= '<tr>';
					$html_table .= '<th class="dashboard-inquiries-post-column">Title</th>';
					$html_table .= '<th class="dashboard-inquiries-status-column">Status</th>';
				$html_table .= '</tr>';
			$html_table .= '</thead>';

			$html_table .= '<tbody>';
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$post_id = get_the_id();
						if(class_exists('Jetty_Inquiries')){
							$owner_id = Jetty_Inquiries::get_owner( $post_id );
							$owner = get_userdata( $owner_id );
						} else {
							$owner_id = self::jetty_ui_get_owner($post_id);
							if(!empty($owner_id)){
								$owner = get_userdata($owner_id);
							} else {
								$owner = '';
							}	
						}
						$status = Jetty_Ui_Jetty_Metrics::inquiry_get_status( $post_id );

						$add_class = "";

						if(($i % 2) == 0){
							$add_class = "alternate";
						}

						$html_table .= '<tr class="'.$add_class.'">';
							$html_table .= '<td class="dashboard-inquiries-post-column post-title page-title column-title"><strong><a class="post-edit-link" href="'.get_edit_post_link( $post_id ).'">'.get_the_title( $post_id ).'<a></strong></td>';
							$html_table .= '<td class="dashboard-inquiries-status-column"><strong>'.$status['label'].'</strong><br>'.(is_object($owner) ? $owner->display_name : '').'</td>';
						$html_table .= '</tr>';
						$i++;
					}
				} else {
					$html_table .= '<tr>';
						$html_table .= '<td colspan="2">';
							$html_table .= '<p>'.__('No inquiries to display').'</p>';
						$html_table .= '</td>';
					$html_table .= '</tr>';
				}
				wp_reset_postdata();
			$html_table .= '</tbody>';
		$html_table .= '</table>';

		echo $html_table;
	}

	public function jetty_ui_dashboard_status_boards(){
		$args = [
			'post_type' => 'status_board',
			'posts_per_page' => 10,
			'orderby' => 'modified',
			'post_status' => 'publish',
		];
		$the_query = new WP_Query( $args );
		$i = 0;

		$html_table = '';
		$html_table .= '<table class="wp-list-table widefat fixed">';
			$html_table .= '<thead>';
				$html_table .= '<tr>';
					$html_table .= '<th class="dashboard-status-boards-post-column">Title</th>';
					$html_table .= '<th class="dashboard-status-boards-modified-column">Modified</th>';
				$html_table .= '</tr>';
			$html_table .= '</thead>';

			$html_table .= '<tbody>';
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$post_id = get_the_id();
						$title = get_the_title($post_id);
						$author = get_the_modified_author();
						$date = get_the_modified_date("M j, Y \\a\\t g:ia");

						$add_class = "";

						if(($i % 2) == 0){
							$add_class = "alternate";
						}

						$html_table .= '<tr class="'.$add_class.'">';
							$html_table .= '<td class="dashboard-status-boards-post-column post-title page-title column-title" width="400">';
								$html_table .= '<strong><span class="row-title clickable" data-status-board-lightbox="'.$post_id.'">'.$title.'</span></strong>';
							$html_table .= '</td>';

							$html_table .= '<td class="dashboard-status-boards-modified-column">';
								$html_table .= '<strong>'.$date.'</strong><br>'.$author.'';
							$html_table .= '</td>';
						$html_table .= '</tr>';
						$i++;
					}
				} else {
					$html_table .= '<tr>';
						$html_table .= '<td colspan="2">';
							$html_table .= '<p>'.__('No status boards to display').'</p>';
						$html_table .= '</td>';
					$html_table .= '</tr>';
				}

			wp_reset_postdata();
			$html_table .= '</tbody>';
		$html_table .= '</table>';

		echo $html_table;
	}

	public function jetty_ui_dashboard_inquiries_by_status(){
		$chart_html = '';
		$chart_html .= '<div id="dashboard-chart-1" class="dashboard-chart">';
			$chart_html .= '<div><canvas id="Chart1" width="400" height="400"></canvas></div>';
		$chart_html .= '</div>';

		echo $chart_html;
	}

	public function jetty_ui_dashboard_inquiries_by_category(){
		$chart_html = '';
		$chart_html .= '<div id="dashboard-chart-2" class="dashboard-chart">';
			$chart_html .= '<div><canvas id="Chart2" width="400" height="400"></canvas></div>';
		$chart_html .= '</div>';

		echo $chart_html;
	}

	public function jetty_ui_dashboard_inquiries_by_source(){
		$chart_html = '';
		$chart_html .= '<div id="dashboard-chart-3" class="dashboard-chart">';
			$chart_html .= '<div><canvas id="Chart3" width="400" height="400"></canvas></div>';
		$chart_html .= '</div>';

		echo $chart_html;
	}

	public function jetty_ui_dashboard_post_by_status(){
		$chart_html = '';
		$chart_html .= '<div id="dashboard-chart-4" class="dashboard-chart">';
			$chart_html .= '<div><canvas id="Chart4" width="400" height="400"></canvas></div>';
		$chart_html .= '</div>';

		echo $chart_html;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		$screen = get_current_screen();

		if($screen->id == 'dashboard') {
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
		}

		// overwrite default color admin

		// Fresh (fresh)
		wp_admin_css_color(
		 'fresh', __( 'Default', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_admin_style.css", __FILE__ ),
		 array( '#008D68', '#001E42', '#235B97', '#D6D6D6' ),
		 array('base' => '#008D68', 'focus' => '#001E42', 'current' => '#235B97' )
		);

		// Light (light)
		wp_admin_css_color(
		 'light', __( 'Light', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_light_color.css", __FILE__ ),
		 array( '#e5e5e5', '#999', '#d64e07', '#04a4cc' ),
		 array('base' => '#999', 'focus' => '#ccc', 'current' => '#ccc' )
		);

		// Blue (blue)
		wp_admin_css_color(
		 'blue', __( 'Blue', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_blue_color.css", __FILE__ ),
		 array( '#096484', '#4796b3', '#52accc', '#74B6CE' ),
		 array('base' => '#e5f8ff', 'focus' => '#fff', 'current' => '#fff' )
		);

		// Coffee (coffee)
		wp_admin_css_color(
		 'coffee', __( 'Coffee', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_coffee_color.css", __FILE__ ),
		 array( '#46403c', '#59524c', '#c7a589', '#9ea476' ),
		 array('base' => '#f3f2f1', 'focus' => '#fff', 'current' => '#fff' )
		);

		// Ectoplasm (ectoplasm)
		wp_admin_css_color(
		 'ectoplasm', __( 'Ectoplasm', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_ectoplasm_color.css", __FILE__ ),
		 array( '#413256', '#523f6d', '#a3b745', '#d46f15' ),
		 array('base' => '#ece6f6', 'focus' => '#fff', 'current' => '#fff' )
		);

		// Midnight (midnight)
		wp_admin_css_color(
		 'midnight', __( 'Midnight', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_midnight_color.css", __FILE__ ),
		 array( '#25282b', '#363b3f', '#69a8bb', '#e14d43' ),
		 array('base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		// Ocean (ocean)
		wp_admin_css_color(
		 'ocean', __( 'Ocean', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_ocean_color.css", __FILE__ ),
		 array( '#627c83', '#738e96', '#9ebaa0', '#aa9d88' ),
		 array('base' => '#f2fcff', 'focus' => '#fff', 'current' => '#fff' )
		);

		// Sunrise (sunrise)
		wp_admin_css_color(
		 'sunrise', __( 'Sunrise', 'admin_schemes' ),
		 plugins_url( "assets/css/jetty_sunrise_color.css", __FILE__ ),
		 array( '#b43c38', '#cf4944', '#dd823b', '#ccaf0b' ),
		 array('base' => '#f3f1f1', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], '4.7.0' );

		wp_enqueue_style( 'roboto-slab-font', '//fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700', [], Jetty_UI::VERSION );

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Plugin_Name" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		$screen = get_current_screen();

		// Load admin bar script
		wp_enqueue_script(
			$this->plugin_slug . '-admin-bar-script',
			plugins_url( 'assets/js/admin-bar.js', __FILE__ ),
			array( 'jquery', 'jquery-masonry' ),
			'2.0.1',
			true
		);

		// Load lightbox script
		wp_enqueue_script( $this->plugin_slug . '-admin-lightbox-script', plugins_url( 'assets/js/jquery.magnific-popup.min.js', __FILE__ ), array( 'jquery' ), Jetty_UI::VERSION );

		if($screen->id == 'dashboard' || $screen->id === 'dashboard_page_jetty-admin-dashboard') {
			// Load chart script
			wp_enqueue_script( $this->plugin_slug . '-jetty-ui-admin-chart-script', plugins_url( 'assets/js/Chart.min.js', __FILE__ ), array( 'jquery' ), Jetty_UI::VERSION );
			wp_enqueue_script( 'jquery-ui-dialog' );

		}
		if(in_array($screen->id, array('dashboard_page_jetty-admin-dashboard', 'dashboard', 'tools_page_jetty-metrics'))) {
			Jetty_Ui_Jetty_Metrics::enqueue_metrics();
		}

		// Load admin script
		wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Jetty_UI::VERSION, true );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * @TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Jetty UI Options', $this->plugin_slug ),
			__( 'UI Options', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * Change the page title for the dashboard
	 *
	 * @since 1.0.0
	 */
	function dashboard_title($admin_title, $title) {

	    return $title .' | ' . get_bloginfo('name') . ' &laquo Jetty';

	}

	/**
	 * Replaces admin footer text
	 *
	 * @since 1.0.0
	 */
	public function admin_footer_text() {

		return 'Created by <a href="http://jettyapp.com" target="_blank">the Jetty team</a>';

	}

	/**
	 * Replaces admin footer text
	 *
	 * @since 1.0.0
	 */
	public function admin_footer_version() {

		if (class_exists('Jetty_Core')) {
	    	return "Version " . Jetty_Core::VERSION;
	    }

	    return;
	}

	/**
	 * Removes default dashboard widgets
	 *
	 * @since 1.0.0
	 */
	public function remove_dashboard_widgets () {

      	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
        remove_meta_box( 'dashboard_wordpress_news', 'dashboard', 'normal');
        remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal');

	}

	/**
	 * Removes default network dashboard widgets
	 *
	 * @since 1.0.0
	 */
	public function remove_network_dashboard_widgets () {

      	// remove_meta_box ( 'network_dashboard_right_now', 'dashboard-network', 'normal' );
	    remove_meta_box ( 'dashboard_plugins', 'dashboard-network', 'normal' );
	    remove_meta_box ( 'dashboard_primary', 'dashboard-network', 'side' );
	    remove_meta_box ( 'dashboard_secondary', 'dashboard-network', 'side' );

	}

	/**
	 * Removes admin-only menu items
	 *
	 * @since 1.0.0
	 */
	public function customize_admin_menu() {

		if ( is_network_admin() )
			return;

		global $menu;

		// If user is not administrator (Jetty team), remove restricted menu items
		if ( ! current_user_can( 'access_all' ) ) {
			remove_menu_page( 'edit.php?post_type=acf' );
			remove_submenu_page( 'options-general.php', 'options-media.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			remove_submenu_page( 'options-general.php', 'nested-pages-settings');

			// the wrong permalinks settings can break inquiries so it is removed and the correct
			// settings are set programatically in jetty-core
			remove_submenu_page( 'options-general.php', 'options-permalink.php' );

			// remove some of the Gravity Forms menu items
			remove_submenu_page( 'gf_edit_forms', 'gf_settings');
			remove_submenu_page( 'gf_edit_forms', 'gf_help');
			remove_submenu_page( 'gf_edit_forms', 'gf_addons');
			remove_submenu_page( 'gf_edit_forms', 'gf_update');

		}

		// removes icon from Gravity Forms menu item
		unset($menu['16.9'][6]);

		// Grab our primary menu items
		$primary_items = [
			'Main Separator' => [
				null,
				'read',
				'separator1',
				null,
				'wp-menu-separator',
			],
			'Injects' => [],
			'Pages' => [],
			'Posts' => [],
			'Archived Inquiries' => [],
			'Inquiries' => [],
			'Monitor' => [],
			'Boards' => [],
			'Dashboard' => [],
		];
		$primary_item_paths = [
			'index.php', // Dashboard
		    'edit.php?post_type=status_board', // Status Boards
		    'jetty-monitor', // Social
		    'edit.php?post_type=inquiry', // Inquiries
		    'edit.php', // Posts
		    'edit.php?post_type=page', // Pages
			'edit.php?post_type=inject', // Injects
		];

	    foreach( $menu as $key => $value ) {

	    	// If item label is one of the primary ones
	        if( isset( $primary_items[$value[0]] ) ) {

	        	// Add custom class
	            $value[4] .= " jetty-primary-menu-item";

	            // Move to items array
	            $primary_items[$value[0]] = $value;
	            unset( $menu[$key] );

	        } elseif ( $value[4] == 'wp-menu-separator' ) {

	        	// Remove all separators
	        	unset( $menu[$key] );

	        } elseif ( ! current_user_can( 'access_all' ) ) {

	        	// Remove secondary user for all non administrators
	        	unset( $menu[$key] );

	        }

	    }

	    // Rearrange Menu
	    foreach ($primary_items as $key => $value) {
	    	if ( ! empty($value) ) {
	    		array_unshift($menu, $value);
	    	}
	    }

	}

	public static function jetty_ui_get_owner( $post_id ) {
		$owner = get_post_meta( $post_id, 'inquiry_owner', true );
		if ( !empty( $owner )) {
			return $owner;
		}
		
		return '';
	}

	/**
	 * Removes admin-only menu items
	 *
	 * @since 1.0.0
	 */
	public function customize_text( $translated, $text, $domain ) {

		$words = [
					'wordpress.org' => 'jettyapp.com',
                	'WordPress' => 'Jetty',
                 ];

    	$translated = str_ireplace(  array_keys($words),  $words,  $translated );

    	return $translated;

	}

	/**
	 * Removes admin-only menu items
	 *
	 * @since 1.0.0
	 */
	public function customize_posts_list() {

		global $wp_post_types;

		// foreach ($wp_post_types as $key => $value) {
		// 	$value->labels->add_new = 'New';
		// }

	}

	/**
	 * removes the help tab on admin pages.
	 *
	 * @access public
	 * @param mixed $old_help
	 * @param mixed $screen_id
	 * @param mixed $screen
	 * @return void
	 */
	public function hijack_admin_help_tabs($old_help, $screen_id, $screen){
		$screen->remove_help_tabs();
		$screen->set_help_sidebar('');

		// Taken from Better Admin Tabs plugin
		// Only used if plugin is activated
		if ( function_exists( 'makeHelptabQuery' ) ) {

			$qargs = array(
			   'post_type' => 'sbah_helptab',
			   'posts_per_page' => '-1',
			   'meta_query' => array(
			       array(
			           'key' => '_sbah_screen_text',
			           'value' => $screen_id,
			           'compare' => 'LIKE',
			       )
			   )
			 );

			$the_querying = get_posts($qargs);
			foreach ( $the_querying as $post ) : setup_postdata( $post );
			        $hscreen = get_post_meta($post->ID, '_sbah_screen_text', true );
			        $htype = get_post_meta($post->ID, '_sbah_type_radio', true );
			        $htitle = get_the_title($post->ID);
			        $hcontent = get_the_content($post->ID);
			if ($htype == 'tab') {
			$screen->add_help_tab( array(
			'id' => $post->ID, //unique id for the tab
			'title' => $htitle, //unique visible title for the tab
			'content' => '<p></p>' . $hcontent, //actual help text
			));
			} else {
			$hscontent ='<h5>'.$htitle. '</h5>' . $hcontent . '<p></p>';
			$screen->set_help_sidebar($hscontent);
			}

			endforeach;
			wp_reset_postdata();

		}

		return $old_help;
	}

}
