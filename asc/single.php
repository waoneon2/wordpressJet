<?php $asc_options = asc_theme_options(); ?>
<?php get_header(); ?>
<div class="asc-section asc-group">
	<div id="main-content" class="asc-content" role="main" itemprop="mainContentOfPage"><?php
		asc_before_post_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			asc_share_buttons();
			asc_postnav();
			if ($asc_options['author_box'] == 'enable' && get_the_author_meta('description') && !is_attachment()) {
				get_template_part('content', 'author-box');
			}
			if ($asc_options['related_content'] == 'enable') {
				get_template_part('content', 'related');
			}
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>