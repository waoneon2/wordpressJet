<?php $houston_uasi_options = houston_uasi_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><?php
		if ($houston_uasi_options['tags'] === 'enable') {
			 the_tags('<div class="entry-tags clearfix"><span>' . esc_html__('TOPICS:', 'houston-uasi') . '</span>','','</div>');
		} ?>
	</header><?php
	houston_uasi_featured_image();
	dynamic_sidebar('post-ad-1');
	houston_uasi_post_meta(); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
	<?php dynamic_sidebar('post-ad-2'); ?>
</article>