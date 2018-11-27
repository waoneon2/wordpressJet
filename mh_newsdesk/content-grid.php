<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<article <?php post_class('mh-col mh-1-4 content-grid'); ?>>
	<div class="content-thumb content-grid-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('content-grid');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content-grid.jpg' . '" alt="No Picture" />';
			} ?>
		</a>
	</div>
	<?php if (!$mh_newsdesk_options['post_meta_cat']) { ?>
		<p class="entry-meta">
			<span><?php echo get_the_category_list(', ', ''); ?></span>
		</p>
	<?php } ?>
	<h3 class="entry-title content-grid-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h3>
</article>
<hr class="mh-separator content-grid-separator">