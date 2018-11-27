<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="asc-section asc-group">
	<div id="main-content" class="asc-content contact-page" role="main" itemprop="mainContentOfPage"><?php
		asc_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
		endwhile; ?>
	</div>
	<aside class="asc-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar('contact'); ?>
	</aside>
</div>
<?php get_footer(); ?>