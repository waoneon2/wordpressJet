<?php $author = get_the_author(); ?>


<div class="item">
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div><?php the_time('F d, Y'); ?> | <a href="<?php the_permalink(); ?>">&raquo; Read More</a></div>
</div>