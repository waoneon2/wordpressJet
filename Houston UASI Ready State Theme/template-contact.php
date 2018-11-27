<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="houston-section houston-group">
	<div id="main-content" class="houston-content contact-page" role="main" itemprop="mainContentOfPage"><?php
		houston_uasi_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
		endwhile; ?>
	</div>
	<aside class="houston-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar('contact'); ?>
	</aside>
</div>
<?php get_footer(); ?>