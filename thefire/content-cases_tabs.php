         <?php $author = get_the_author(); ?>
           

<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
     
    <p class="category">
      <!--<span class="author">By Author: <?php the_author_posts_link(); ?></span><br />-->
      <span><?php echo get_the_date(); ?> </span>
    </p>

     
	<?php the_excerpt(); ?>
    <span><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></span>
</div>
