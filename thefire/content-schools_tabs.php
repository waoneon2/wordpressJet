<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if ($_cat): ?>
    <span class="date"><?php echo get_the_date(); ?>  </span>
    </p>
    <?php endif; ?>
	<?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>
