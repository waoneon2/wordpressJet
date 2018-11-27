<?php $houston_uasi_options = houston_uasi_theme_options(); ?>
<?php get_header(); ?>
<div class="houston-section houston-group">
	<div id="main-content" class="houston-content" role="main" itemprop="mainContentOfPage"><?php
		houston_uasi_before_post_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			houston_uasi_share_buttons();
			houston_uasi_postnav();
			if ($houston_uasi_options['author_box'] == 'enable' && get_the_author_meta('description') && !is_attachment()) {
				get_template_part('content', 'author-box');
			}
			if ($houston_uasi_options['related_content'] == 'enable') {
				get_template_part('content', 'related');
			}
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>