<?php
/**
 * Plugin Name.
 *
 * @package   Jetty_UI
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @package Jetty_UI
 * @author  Your Name <email@example.com>
 */
class Jetty_UI {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = JETTY_VERSION;

	/**
	 *
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'jetty-ui';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Load Login Styles
		add_action('login_head',   [ $this, 'enqueue_login_styles' ],    1);
		// add_action('authenticate', [ $this, 'inject_login_stylesheet' ], 1);

		// password autocomplete off
		add_action('login_init', array( $this, 'jetty_autocomplete_login_init' ) );
		add_action('login_form', array( $this, 'jetty_autocomplete_login_form' ) );

		// Customize admin bar
		add_action( 'admin_bar_menu', array( $this, 'modify_admin_bar_menu' ), 9999 );

 		// Theme customizer
 		add_action( 'customize_register', array( $this, 'theme_customize_register' ) );
 		add_action( 'wp_head',            array( $this, 'theme_customize_meta_tags' ) );
		add_action( 'wp_head',            array( $this, 'theme_customize_css' ) );
		add_action( 'wp_head',            array( $this, 'theme_customize_share_image' ) );
		add_action( 'wp_footer',          array( $this, 'theme_customize_footer_tags' ), 9999 );
		add_action( 'wp_footer',          array( $this, 'theme_customize_footer_js' ), 9999 );

		// Favicon
		add_action( 'wp_head', array( $this, 'favicon' ), 1 );
		add_action( 'admin_head', array( $this, 'favicon' ), 1 );

		// URL admin
		// add_filter('admin_url', array($this, 'admin_url_filter'), 10, 3);
		// add_filter('network_admin_url', array($this, 'network_admin_url'), 10, 2);
	}

	public function jetty_autocomplete_login_init() {
		ob_start();
	}

	public function jetty_autocomplete_login_form() {

		$content = ob_get_contents();
		ob_end_clean();

		$content = str_replace('id="user_pass"', 'id="user_pass" autocomplete="off"', $content);

		echo $content;
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here

	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );

		wp_enqueue_style( $this->plugin_slug . '-plugin-update-styles', plugins_url( 'assets/css/public-update.css', __FILE__ ), array(), self::VERSION );

		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', [], '4.3.0' );

		wp_enqueue_style( 'roboto-slab-font', '//fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700', [], self::VERSION );

	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		if( is_user_logged_in() )
			wp_enqueue_script(
				$this->plugin_slug . '-admin-bar-script',
				plugins_url( 'admin/assets/js/admin-bar.js', __DIR__ ),
				array( 'jquery', 'jquery-masonry' ),
				'2.0.1',
				true
			);

	}

	/**
	 * Register and enqueue public-facing login style sheet.
	 *
	 * @since    1.0.0
	 */
	private function get_login_stylesheet_url() {
		return plugins_url( 'assets/css/login.css', __FILE__ );
	}
	public function enqueue_login_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', $this->get_login_stylesheet_url(), array(), self::VERSION );
	}
	public function inject_login_stylesheet() { ?>
		<link rel="stylesheet" href="<?php echo $this->get_login_stylesheet_url(); ?>">
	<?php }

	/**
	 * Modify admin bar
	 *
	 * @since 1.0.0
	 */
	public function modify_admin_bar_menu( $wp_admin_bar ) {

		if ( ! is_user_logged_in() )
		return;

		global $wp_admin_bar;

		// Remove the defaults
		$wp_admin_bar->remove_menu('archive');
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('preview');
		$wp_admin_bar->remove_menu('my-sites');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('my-account');
		$wp_admin_bar->remove_menu('view');
		$wp_admin_bar->remove_menu('search');
		$wp_admin_bar->remove_menu('edit');

		// Add logo
		$args = array(
			'href' 	 => get_admin_url(),
			'id' 	 => 'jetty-logo',
			'title'  => 'Jetty',
			'meta'   => ['html' 	=> '',
						 'class' 	=> '',
						 'onclick'  => '',
						 'target' 	=> '',
						 'title' 	=> '', ],
		);
		$wp_admin_bar->add_menu( $args );

		// Add site name
		$site_name = get_bloginfo('name');

		$args = [
			'href' 	 => get_site_url(),
			'parent' => false,
			'id' 	 => 'jetty-name',
			'title'  => $site_name,
			'meta'   => ['html' 	=> '',
						 'class' 	=> '',
						 'onclick'  => '',
						 'target' 	=> '',
						 'title' 	=> '', ],
		];
		$wp_admin_bar->add_menu( $args );

		// Site status
		$get_option_site_status = get_option('jetty_site_mode');
		if($get_option_site_status) {
			$args = [
				'href' 	 => admin_url( 'options-general.php?page=site-mode' ),
				'parent' => false,
				'id' 	 => 'jetty-site-status',
				'title'  => '('.$get_option_site_status.')',
				'meta'   => ['html' 	=> '',
							 'class' 	=> 'jetty-admin-bar-site-status',
							 'onclick'  => '',
							 'target' 	=> '',
							 'title' 	=> '', ],
			];
			$wp_admin_bar->add_menu( $args );
		}

		// Add flyout menu
		require_once( 'class-jetty-ui/FlyoutMenu.php' );
		$flyoutMenu = new \JettyUI\FlyoutMenu( $wp_admin_bar, 'top-secondary' );
		$flyoutMenu->draw();

		// Exit. User does not have enough permissions to draw final menu bar items.
		if ( !current_user_can( 'manage_options' )) {
			return;
		}
	
		// Add notifications menu. Notifications are temporarily disabled from
		// the public site as notifications is hard-coded to admin-only scripts.
		if ( is_admin() ) {
			$args = [
				'parent' => false, 
				'id' 	 => 'jetty-notifications',
				'parent' => 'top-secondary',
				'title'  => '<i class="fa fa-bell-o"></i><span id="notification-count">0</span>',
				'meta'   => ['html' 	=> '',
				'class' 	=> '',
				'onclick' 	=> '',
				'target' 	=> '',
				'title' 	=> '', ],
			];
			$wp_admin_bar->add_menu( $args );
		}

		// Add current time
		$current_time = current_time('g:i A');
		$timezone = get_option('timezone_string') ? get_option('timezone_string') : 'UTC '.get_option('gmt_offset');
		$args = [
			'href' 	 => esc_url(admin_url('options-general.php')),
			'parent' => false,
			'id' 	 => 'jetty-current-time',
			'parent' => 'top-secondary',
			'title'  => '<i id="current-time-content">'.$current_time.' '.$timezone.'</i>',
			'meta'   => ['html' 	=> '',
						 'class' 	=> '',
						 'onclick' 	=> '',
						 'target' 	=> '',
						 'title' 	=> '', ],
		]; ?>
		<?php $wp_admin_bar->add_node($args);
	}

	/**
	 * Add theme customizer settings
	 * See http://codex.wordpress.org/Theme_Customization_API
	 *
	 * @since    1.0.0
	 */
	public function theme_customize_register( $wp_customize ) {

		/*
		 * Add "Custom Meta" customization options
		 */
		$wp_customize->add_section( 'custom_meta_section', array (
			'title'       => __( 'Site Meta', $this->plugin_slug ),
			'priority'    => 30,
		) );
		$wp_customize->add_setting( 'custom_meta_tags', array (
			'default'     => '',
		) );
		$wp_customize->add_setting( 'custom_css' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
		) );
		$wp_customize->add_setting( 'custom_share_image', array (
			'default'     => '',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_meta_tags', array(
			'label'     => __( 'Meta Tags', $this->plugin_slug ),
			'section'   => 'custom_meta_section',
			'settings'  => 'custom_meta_tags',
			'type'		=> 'textarea',
		) ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_css', array(
			'label'     => __( 'CSS', $this->plugin_slug ),
			'section'   => 'custom_meta_section',
			'settings'  => 'custom_css',
			'type'		=> 'textarea',
		) ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_share_image', array (
			'label'       => __( 'Social Share Image', $this->plugin_slug ),
			'section'     => 'custom_meta_section',
			'settings'    => 'custom_share_image',
		) ) );

		/*
		 * Add "Footer Tags" customization options
		 */
		$wp_customize->add_section( 'custom_footer_tags_section', array (
			'title'       => __( 'Footer Tags', $this->plugin_slug ),
			'priority'    => 30,
		) );
		$wp_customize->add_setting( 'custom_footer_tags' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
		) );
		$wp_customize->add_setting( 'custom_footer_js' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_footer_tags', array(
			'label'     => __( 'Footer Tags', $this->plugin_slug ),
			'section'   => 'custom_footer_tags_section',
			'settings'  => 'custom_footer_tags',
			'type'		=> 'textarea',
		) ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_footer_js', array(
			'label'     => __( 'Footer JS', $this->plugin_slug ),
			'section'   => 'custom_footer_tags_section',
			'settings'  => 'custom_footer_js',
			'type'		=> 'textarea',
		) ) );

	}

	/**
	 * Output custom meta tags into site header
	 *
	 * @since    1.0.0
	 */
	public function theme_customize_meta_tags() {
		echo get_theme_mod( 'custom_meta_tags', '' );
	}

	/**
	 * Output custom css in theme
	 *
	 * @since    1.0.0
	 */
	public function theme_customize_css() {
	    ?>
	         <style type="text/css">
	            <?php echo get_theme_mod('custom_css', ''); ?>
	         </style>
	    <?php
	}

	/**
	 * Output custom meta tags into site header
	 *
	 * @since    1.0.0
	 */
	public function theme_customize_footer_tags() {
		echo get_theme_mod( 'custom_footer_tags', '' );
	}

	/**
	 * Output custom js in theme
	 *
	 * @since    1.0.0
	 */
	public function theme_customize_footer_js() {
	    ?>
	        <script type="text/javascript">
	        	(function ($) {
					"use strict";

		            <?php echo get_theme_mod('custom_footer_js', ''); ?>

	            })(jQuery);
	         </script>
	    <?php
	}

	/**
	 * Output custom share image in theme
	 */
	public function theme_customize_share_image() {
		$shareImage = get_theme_mod( 'custom_share_image', '' );
		if ( $shareImage ) {
			echo '<meta property="og:image" content="' . $shareImage . '" />';
		}
	}

	/**
	 * Output custom favicon
	 *
	 * @since    1.0.0
	 */
	public function favicon() {
	    ?>
	        <link rel="shortcut icon" href="<?php echo plugin_dir_url( __FILE__ ); ?>assets/img/favicon.ico" />
	    <?php
	}

	public function admin_url_filter($url, $path, $blog_id) {
		$scheme = (0 === strpos($url, '/')) ? 'relative' : 'admin';
		$find = get_site_url($blog_id, 'wp-admin/', $scheme);
		$replace = get_site_url($blog_id,  'dashboard/', $scheme);
		if (strpos($url, $find) === 0) {
			return  $replace . substr($url, strlen($find));
		}
		return $url;
	}

	public function network_admin_url($url, $path) {
		$find = network_site_url('wp-admin/', 'admin');
		$replace = network_site_url('dashboard/', 'admin');
		if (strpos($url, $find) === 0) {
			return  $replace . substr($url, strlen($find));
		}
		return $url;
	}
}
