<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><?php
		if ($mh_newsdesk_options['tags'] === 'enable') {
			 the_tags('<div class="entry-tags clearfix"><span>' . esc_html__('TOPICS:', 'mh-newsdesk') . '</span>','','</div>');
		} ?>
	</header><?php
	mh_newsdesk_featured_image();
	dynamic_sidebar('post-ad-1');
	mh_newsdesk_post_meta(); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
	<?php dynamic_sidebar('post-ad-2'); ?>
</article>