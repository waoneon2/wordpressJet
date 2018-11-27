<?php /* Template Name: Full Width */ ?>
<?php get_header(); ?>
<div class="page-full-width" role="main" itemprop="mainContentOfPage"><?php
	mh_newsdesk_before_page_content();
	while (have_posts()) : the_post();
		get_template_part('content', 'page');
		comments_template();
	endwhile; ?>
</div>
<?php get_footer(); ?>