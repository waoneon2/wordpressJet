<li class="item bullet">
    <h1><a href="<?php the_permalink(); ?>"><i><?php if($publicationName = get_field('publication_name')) : ?> <?php echo $publicationName . ','; endif; ?></i> <?php echo get_the_date(); ?></a><span style="font-weight: normal">,</span> <a href="<?php the_permalink(); ?>" class="blue-link"><?php the_title(); ?></a>
    </h1>
</li>