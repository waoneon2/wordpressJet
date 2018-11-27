<?php /* Loop Template used for archives/search */ ?>
<article <?php post_class('content-list clearfix'); ?>>
	<div class="content-thumb content-list-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('content-list');
			} else {
				echo '<img class="asc-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content-list.jpg' . '" alt="No Picture" />';
			} ?>
		</a>
	</div>
	<header class="content-list-header">
		<?php asc_post_meta(); ?>
		<h3 class="entry-title content-list-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h3>
	</header>
	<div class="content-list-excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
<hr class="asc-separator content-list-separator">