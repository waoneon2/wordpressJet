<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<time itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
	<?php the_excerpt(); ?>
	<p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>