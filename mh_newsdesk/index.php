<?php get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-loop" role="main"><?php
		mh_newsdesk_before_page_content();
		mh_newsdesk_page_title();
		if (have_posts()) :
			mh_newsdesk_loop_layout();
			mh_newsdesk_pagination();
		else :
			get_template_part('content', 'none');
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>