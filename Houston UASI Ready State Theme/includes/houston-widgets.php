<?php

/***** Register Widgets *****/

function houston_uasi_register_widgets() {
	register_widget('houston_uasi_custom_posts');
	register_widget('houston_uasi_custom_pages');
	register_widget('houston_uasi_posts_large');
	register_widget('houston_uasi_posts_grid');
	register_widget('houston_uasi_posts_list');
	register_widget('houston_uasi_recent_posts');
	register_widget('houston_uasi_youtube');
	register_widget('houston_uasi_facebook_page');
	register_widget('houston_uasi_authors');
	register_widget('houston_uasi_comments');
	register_widget('Houston_Widget_RSS');
}
add_action('widgets_init', 'houston_uasi_register_widgets');

/***** Include Widgets *****/

require_once('widgets/houston-custom-posts.php');
require_once('widgets/houston-custom-pages.php');
require_once('widgets/houston-posts-large.php');
require_once('widgets/houston-posts-grid.php');
require_once('widgets/houston-posts-list.php');
require_once('widgets/houston-recent-posts.php');
require_once('widgets/houston-youtube.php');
require_once('widgets/houston-facebook-page.php');
require_once('widgets/houston-authors.php');
require_once('widgets/houston-comments.php');
require_once('widgets/Houston-widget-rss.php');
?>