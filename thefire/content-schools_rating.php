<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<?php
		$categories = wp_get_post_categories( $post->ID );
		$cat_names = array();
		foreach( $categories as $cat ){
			$cat_info = get_category( $cat );
			array_push($cat_names, $cat_info->name);
		}

		if (count($cat_names) > 0): ?>
		<p class="category">Speech Code Category: <?php echo implode( ', ', $cat_names ); ?><br>Last updated: <?php the_modified_date(); ?></p>
	<?php else: ?>
	<p class="category">Last updated: <?php the_modified_date(); ?></p>
	<?php endif; ?>
	<?php the_field('regulation_text'); ?>
	<p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>