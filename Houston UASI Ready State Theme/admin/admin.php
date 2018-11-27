<?php

/***** Theme Info Page *****/

if (!function_exists('houston_uasi_add_theme_info_page')) {
	function houston_uasi_add_theme_info_page() {
		add_theme_page(__('Welcome to Houston UASI Ready State', 'houston-uasi'), __('Theme Info', 'houston-uasi'), 'edit_theme_options', 'newsdesk', 'houston_uasi_display_theme_info_page');
	}
}
add_action('admin_menu', 'houston_uasi_add_theme_info_page');

if (!function_exists('houston_uasi_display_theme_info_page')) {
	function houston_uasi_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(__('Welcome to %1s %2s', 'houston-uasi'), $theme_data->Name, $theme_data->Version); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(__('Getting Started with %s', 'houston-uasi'), $theme_data->Name); ?></h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4><?php _e('Theme Options', 'houston-uasi'); ?></h4>
							<p class="about"><?php printf(__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'houston-uasi'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Customize Theme', 'houston-uasi'); ?></a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php _e('Theme Screenshot', 'houston-uasi'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(__('%1s WordPress theme is proudly brought to you by %2s.', 'houston-uasi'), $theme_data->Name, '<a target="_blank" href="http://jettyapp.com" title="Jetty">Jetty</a>'); ?></p>
			</div>
		</div> <?php
	}
}
?>