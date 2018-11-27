<?php

/***** Register Widgets *****/

function asc_register_widgets() {
	register_widget('asc_custom_posts');
	register_widget('asc_custom_pages');
	register_widget('asc_posts_large');
	register_widget('asc_posts_grid');
	register_widget('asc_posts_list');
	register_widget('asc_recent_posts');
	register_widget('asc_youtube');
	register_widget('asc_facebook_page');
	register_widget('asc_authors');
	register_widget('asc_comments');
}
add_action('widgets_init', 'asc_register_widgets');

/***** Include Widgets *****/

require_once('widgets/asc-custom-posts.php');
require_once('widgets/asc-custom-pages.php');
require_once('widgets/asc-posts-large.php');
require_once('widgets/asc-posts-grid.php');
require_once('widgets/asc-posts-list.php');
require_once('widgets/asc-recent-posts.php');
require_once('widgets/asc-youtube.php');
require_once('widgets/asc-facebook-page.php');
require_once('widgets/asc-authors.php');
require_once('widgets/asc-comments.php');

?>