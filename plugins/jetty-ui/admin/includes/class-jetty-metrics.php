<?php

	class Jetty_Ui_Jetty_Metrics
	{
		// value of Inquiry
		const OPEN    = 'open';
    	const CLOSED  = 'closed';
    	const ON_HOLD = 'hold';

    	private static $text_domain = 'inquiries';

		private static $postType = 'inquiry';

		public function __construct ()
		{

			// Add the options page and menu item.
			add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

			add_filter( 'get_inquiry_stats', array( $this, 'jm_inquiries_stats' ), 10, 1);
			add_filter( 'get_post_stats', array( $this, 'jm_post_stats' ), 10, 3);

		}

		public function add_plugin_admin_menu() {

			$this->plugin_screen_hook_suffix = add_submenu_page(
				'tools.php',
				__( 'Jetty Metrics', 'jetty-metrics' ),
				__( 'Metrics', 'jetty-metrics' ),
				'manage_options',
				'jetty-metrics',
				array( $this, 'display_plugin_admin_page' )
			);
		}

		public function display_plugin_admin_page() {

			$dates = 90;
			$range = 'the past 90 days';

			if (isset($_POST['dates'])) {
				$dates = array();
				$dates['start_date'] = esc_attr($_POST['dates']['start_date']);
				$dates['end_date'] = esc_attr($_POST['dates']['end_date']);

				$range = $dates['start_date'] . ' to ' . $dates['end_date'];
			}

			$post_stats = $this->jm_post_stats( 'post', 'publish', $dates );
			$inquiry_stats = $this->jm_inquiries_stats( $dates );

			include_once( 'metrics-views/metrics-view.php' );

		}

		public static function jetty_ui_get_all_sources( $exclude_labels = false ) {
		
			
			$sources = [];
			if(class_exists('CommunicationChannels')):
				$communicationChannels = \Jetty\CommunicationChannels::Get([
					'is_available' => NULL
				]);
				foreach ( $communicationChannels as $channelID => $channel ) {
					$sources[ $channelID ] = $channel->getName();
				}
			endif;
			
			$otherSources = [
				'form' 				=> __( 'Form', self::$text_domain ),
				'facebook' 			=> __( 'Facebook', self::$text_domain ),
				'rss' 				=> __( 'RSS', self::$text_domain ),
				'twitter' 			=> __( 'Twitter', self::$text_domain ),
				'twitter_mention' 	=> __( 'Twitter Mention', self::$text_domain ),
				'twitter_message' 	=> __( 'Twitter DM', self::$text_domain ),
				'instagram' 		=> __( 'Instagram', self::$text_domain ),
				'other' 			=> __( 'Other', self::$text_domain ),
			];
			
			$sources = array_merge( $otherSources, $sources );

			if ( $exclude_labels ) {
				$labels_removed = [];

				foreach ( $sources as $source => $label ) {
					$labels_removed[] = $source;
				}

				$sources = $labels_removed;
			}
			
			return $sources;
		}

		public function jm_inquiries_stats( $dates ) {

			$inquiries = $this->jm_post_query( 'inquiry', 'publish', $dates );

			$status_labels = self::get_inquiry_status_type_label();
			if(class_exists('Jetty_Inquiries')){
				$sources = Jetty_Inquiries::get_all_sources();
			} else {
				$sources = self::jetty_ui_get_all_sources();
			}

			$uncategorized = 0;
			$status_counts = array('open' => 0, 'closed' => 0, 'hold' => 0);

			foreach ( $inquiries['posts'] as $inquiry )
			{
				// open, closed, on-hold
				$status = self::inquiry_get_status( $inquiry->ID );
				$status_counts[ $status['value'] ]++;

				// inquiries by category
				$categories = get_the_terms( $inquiry->ID, 'inquiry_category');

				if ($categories == false)
				{

					$uncategorized++;

				} else if ( !is_wp_error($categories) ) {

					foreach ( $categories as $c )
					{
						$slugs[] = $c->slug;
					}

				}

				// inquiries by source
				$source = self::inquiry_get_source( $inquiry->ID );
				$values[] = empty($source['value']) ? 'unknown' : $source['value'];
			}

			$source_counts = !empty($values) ? array_count_values($values) : array();
			$cat_counts = !empty($slugs) ? array_count_values($slugs) : array();
			$cat_counts['uncategorized'] = $uncategorized;

			$stats = array(
				'open' => $status_counts['open'],
				'closed' => $status_counts['closed'],
				'hold' => $status_counts['hold'],
				'total-inquiries' => $inquiries['total_posts'],
				'categories' => $cat_counts,
				'sources' => $sources,
				'source' => $source_counts
			);

			return $stats;
		}

		public static function get_inquiry_status_type_label(){
			return [
				self::OPEN    => 'Open',
				self::CLOSED  => 'Closed',
				self::ON_HOLD => 'On Hold'
			];
		}

		public static function inquiry_get_source( $post_id, $exclude_label = false ) {
			$source = [];
			$source['value'] = get_post_meta( $post_id, 'inquiry_source', true );
			if(class_exists('Jetty_Inquiries')){
				$default_labels = Jetty_Inquiries::get_all_sources();
			} else {
				$default_labels = self::jetty_ui_get_all_sources();
			}


			// Set label to default or Unknown if there is no label for value
			$source['label'] = array_key_exists($source['value'], $default_labels) ? $default_labels[$source['value']] : ucwords ( $source['value'] );

			if ( $exclude_label )
				$source = $source['value'];

			return $source;
		}

		public static function inquiry_get_status( $post_id, $default_status = 'open' ) {
			$status = [];
			$saved = get_post_meta( $post_id, 'inquiry_status', true );
			$labels = self::get_inquiry_status_type_label();

			// Default to 'open'
			if ( ! array_key_exists($saved, $labels)) {
				$status['value'] = $default_status;
				$status['label'] = 'Open';

				return $status;
			}

			$status['value'] = $saved;
			$status['label'] = $labels[$saved];

			return $status;
		}

		public function jm_post_stats( $post_type = 'post', $status = 'publish', $dates ) {
			// possible status: http://codex.wordpress.org/Post_Status
			if(is_array($post_type)){
				$post_type = "post";
			}
			if(is_array($status)){
				$status = "publish";
			}
			$post_query = $this->jm_post_query( $post_type, $status, $dates );
			$posts = $post_query['posts'];
			$total_posts = $post_query['total_posts'];

			$slugs = array();
			foreach ( $posts as $post ) {
				$categories = get_the_category( $post->ID );
				foreach ($categories as $c) {
					$slugs[] = $c->slug;
				}
			}

			$cat_counts = array_count_values($slugs);

			$stats = array(
				'total_posts' => $total_posts,
				'categories' => $cat_counts
			);

			return $stats;
		}

		private function jm_post_query( $post_type, $status, $dates ) {
			// query for past number of days (default on metrics page is 90 and dashboard is 360
			$total_posts = 0;
			$posts = array();
			
			if (!is_array($dates)) {
				global $wpdb;
				$posts = $wpdb->get_results(
					"
					SELECT *
					FROM $wpdb->posts
					WHERE post_date BETWEEN NOW() - INTERVAL $dates DAY AND NOW()
						AND post_type = '$post_type'
						AND post_status = '$status'
					"
				);

				$total_posts = $wpdb->num_rows;
			}

			// query for date range
			if (is_array($dates) && isset($dates['start_date']) && isset($dates['end_date'])) {

				$args = array(
					'post_type' => $post_type,
					'post_status' => $status,
					'date_query' => array(
						array(
							'after'     => $dates['start_date'],
							'before'    => $dates['end_date'] . ' 23:59:59',
							'inclusive' => true,
						),
					),

					'posts_per_page' => -1,
				);
				$query = new WP_Query( $args );
				$total_posts = $query->post_count;
				$posts = $query->posts;
			}

			return array('posts' => $posts, 'total_posts' => $total_posts);
		}

		public static function dashboard_charts() {

			$blog_id = get_current_blog_id();
			$data = get_transient('chart_data_' . $blog_id);

			// stats are cached for 5 min, pass resetdata=true to force reload of the stats
			if (isset($_GET['resetdata']) && (true == $_GET['resetdata'])) {
				$data = false;
			}

			if ( false === $data ) {

				$i = apply_filters('get_inquiry_stats', 360);
				$p = apply_filters('get_post_stats', 'post', 'publish', 360);

				// Inquiries by Status
				$inquiries_by_status = array('open' => $i['open'], 'closed' => $i['closed'], 'hold' => $i['hold']);

				// Inquiries by Source
				$inquiries_by_source = array();
				foreach ( $i['source'] as $k => $v ) {

					$label = $k == 'unknown' ? 'Unknown' : $i['sources'][$k];

					$inquiries_by_source['labels'][] = $label;
					$inquiries_by_source['data'][] = $v;

				}

				// prevents errors in the js if there are no inquiries
				if (empty($inquiries_by_source)) {

					$inquiries_by_source['labels'][] = 'No Inquiries';
					$inquiries_by_source['data'][] = 0;

				}

				// Inquiries by category
				$inquiries_by_cat = array();
				foreach ( $i['categories'] as $k => $v ) {

					$term = $k != 'uncategorized' ? get_term_by('slug', $k, 'inquiry_category') : 'Uncategorized';
					$label = isset($term->name) ? $term->name : $term;

					// shorten cat names if they are long
					$label = self::shorten_category_name($label);

					$inquiries_by_cat['labels'][] = $label;
					$inquiries_by_cat['data'][] = $v;

				}

				// Posts by category
				$posts_by_cat = array();
				foreach ( $p['categories'] as $k => $v ) {

					$term = get_term_by('slug', $k, 'category');
					$label = $term->name;

					// shorten cat names if they are long
					$label = self::shorten_category_name($label);

					$posts_by_cat['labels'][] = $label;
					$posts_by_cat['data'][] = $v;

				}

				// this is to avoid js errors when there are no posts
				if ( empty($posts_by_cat) ) {

					$posts_by_cat['labels'][] = 'No Posts';
					$posts_by_cat['data'][] = '0';

				}

				$data = array(
					'inquiries_by_status' => $inquiries_by_status,
					'inquiries_by_source' => $inquiries_by_source,
					'inquiries_by_cat' => $inquiries_by_cat,
					'posts_by_cat' => $posts_by_cat
				);

				set_transient('chart_data_' . $blog_id, $data, 5 * MINUTE_IN_SECONDS);

			}

			return $data;

		}

		public static function shorten_category_name($category_name) {

			// first attempt to split it by words
			$cat_array = explode(' ', $category_name);
			if (count($cat_array) > 1) {

				// take first two words
				$category_name = $cat_array[0] . ' ' . $cat_array[1];

				if (strlen($category_name) <= 13 && count($cat_array) > 2) {

					return $category_name . '...';

				}

			}

			// then shorten words
			if (strlen($category_name) > 13) {

				$category_name = substr($category_name, 0, 13);
				$category_name .= '...';

			}

			return $category_name;

		}

		public static function enqueue_metrics() {

			$screen = get_current_screen();
		    if ($screen->id === 'dashboard' || $screen->id === 'dashboard_page_jetty-admin-dashboard') {

		        // Enqueue script
				wp_enqueue_script( 'jetty_charts', plugins_url( '../assets/js/jetty-metrics.js', __FILE__ ), array(), JETTY_VERSION, true );

		        // Prepare data
				$data = Jetty_Ui_Jetty_Metrics::dashboard_charts();

		        // Localize data
				wp_localize_script( 'jetty_charts', 'jettyUi_jettyMetrics', $data);
		    }

		    if ($screen->id == 'tools_page_jetty-metrics') {
			    wp_enqueue_script('jquery-ui-datepicker');
			    wp_register_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
			    wp_enqueue_style('jquery-ui');
		    }

		}

	}
