<?php get_header(); ?>
<?php global $wp_query; ?>
<div class="houston-section houston-group">
	<div id="main-content" class="houston-loop" role="main"><?php
		houston_uasi_before_page_content();
		$slug = '';
		if(isset($wp_query->query['pagename'])){
			$slug = $wp_query->query['pagename'];
		} 
		if(isset($wp_query->query['name'])) {
			$slug = $wp_query->query['name'];
		}
		
		$status = get_page_by_path($slug, OBJECT, array('post','page'));

		if (is_object($status) && $status->post_status != "private" && is_user_logged_in()) {
			houston_uasi_page_title();
		}

		if (have_posts()) :
			houston_uasi_loop_layout();
			houston_uasi_pagination();
		else :
			get_template_part('content', 'none');
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>