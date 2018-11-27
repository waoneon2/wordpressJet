<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-content contact-page" role="main" itemprop="mainContentOfPage"><?php
		mh_newsdesk_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
		endwhile; ?>
	</div>
	<aside class="mh-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar('contact'); ?>
	</aside>
</div>
<?php get_footer(); ?>