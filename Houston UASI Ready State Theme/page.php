<?php get_header(); ?>
<div class="houston-section houston-group">
	<div id="main-content" class="houston-content" role="main" itemprop="mainContentOfPage"><?php
		houston_uasi_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>