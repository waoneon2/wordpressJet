<?php get_header(); ?>
<?php global $wp_query; ?>
<div class="asc-section asc-group">
	<div id="main-content" class="asc-loop" role="main"><?php
		asc_before_page_content();
		$slug = '';
		if(isset($wp_query->query['pagename'])){
			$slug = $wp_query->query['pagename'];
		} 
		if(isset($wp_query->query['name'])) {
			$slug = $wp_query->query['name'];
		}
		
		$status = get_page_by_path($slug, OBJECT, array('post','page'));

		if (is_object($status) && $status->post_status != "private" && is_user_logged_in()) {
			asc_page_title();
		}

		if (have_posts()) :
			asc_loop_layout();
			asc_pagination();
		else :
			get_template_part('content', 'none');
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>