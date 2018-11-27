<?php get_header(); ?>
<div class="asc-section asc-group">
	<div id="main-content" class="asc-content" role="main" itemprop="mainContentOfPage"><?php
		asc_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>