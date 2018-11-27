<?php

/***** Theme Info Page *****/

if (!function_exists('asc_add_theme_info_page')) {
	function asc_add_theme_info_page() {
		add_theme_page(__('Welcome to ASC Ready State', 'asc'), __('Theme Info', 'asc'), 'edit_theme_options', 'newsdesk', 'asc_display_theme_info_page');
	}
}
add_action('admin_menu', 'asc_add_theme_info_page');

if (!function_exists('asc_display_theme_info_page')) {
	function asc_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(__('Welcome to %1s %2s', 'asc'), $theme_data->Name, $theme_data->Version); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(__('Getting Started with %s', 'asc'), $theme_data->Name); ?></h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4><?php _e('Theme Options', 'asc'); ?></h4>
							<p class="about"><?php printf(__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'asc'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Customize Theme', 'asc'); ?></a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php _e('Theme Screenshot', 'asc'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(__('%1s WordPress theme is proudly brought to you by %2s.', 'asc'), $theme_data->Name, '<a target="_blank" href="http://jettyapp.com" title="Jetty">Jetty</a>'); ?></p>
			</div>
		</div> <?php
	}
}
?>