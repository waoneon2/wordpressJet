<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-content" role="main" itemprop="mainContentOfPage"><?php
		mh_newsdesk_before_post_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			mh_newsdesk_share_buttons();
			mh_newsdesk_postnav();
			if ($mh_newsdesk_options['author_box'] == 'enable' && get_the_author_meta('description') && !is_attachment()) {
				get_template_part('content', 'author-box');
			}
			if ($mh_newsdesk_options['related_content'] == 'enable') {
				get_template_part('content', 'related');
			}
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>