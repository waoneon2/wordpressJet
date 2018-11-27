<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_single( 196 ) ) : ?>
		<div class="entry-content">
		    <div class="entry-thumbnail">
		        <?php the_post_thumbnail('full'); ?>
		    </div>
		</div>
    <?php endif; ?>
    
    <span class="entry-header">
		<?php the_title(); ?>
    </span><!-- .entry-header -->
    <p class="category">

         <span class="author">
		 <?php $categories = get_the_category(); if($categories[0]->cat_ID != 532) { ?>By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?><?php } else { ?> <?php } ?><?php echo get_the_date(); ?></span>   
    </p>   
    <div class="entry-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_single( 196 ) ) : ?>
            <?php if ( get_post_meta( get_the_ID(), "source_url", true) || get_post_meta( get_the_ID(), "post-source", true) ) : //Checks to see if it was a post source or a url?>          
                Source: 
                <?php if ( get_post_meta( get_the_ID(), "source_url", true) && ! get_post_meta( get_the_ID(), "post-source", true) ) : //If it just has a Url ?>
                         <a href="<?php echo the_field('source_url') ?>">Visit Website</a>
                <?php elseif (! get_post_meta( get_the_ID(), "source_url", true) && get_post_meta( get_the_ID(), "post-source", true) ) : //If it just has a Source ?>
                         <?php echo the_field('post-source') ?> 
                <?php else : //It it has both a url and a source ?>
                    <a href="<?php echo the_field('source_url') ?>"><?php echo the_field('post-source') ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php the_content(); ?>
        <?php 
		$attachment = get_field('full_text');

        if( get_field('full_text') ):
            ?><a href="<?php echo $attachment['url']; ?>" >Download file "<?php echo $attachment['title']; ?>"</a><?php
        endif;
		?>
        <p class="category">
            <span class="category-item"> 		
                <?php
                    // Find connected pages
                    $connected = new WP_Query( array(
                      'connected_type' => 'post_schools',
                      'connected_items' => get_queried_object(),
                      'nopaging' => true,
                    ) );
                    // Display connected pages
                    if ( $connected->have_posts() ) :
                    ?>
                    Schools:
                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php endwhile; ?>
                    <?php 
                    // Prevent weirdness
                    wp_reset_postdata();
                    endif;
                ?>
            </span>
            <span class="category-item">		
                <?php
                    // Find connected pages
                    $connected = new WP_Query( array(
                      'connected_type' => 'post_cases',
                      'connected_items' => get_queried_object(),
                      'nopaging' => true,
                    ) );
                    // Display connected pages
                    if ( $connected->have_posts() ) :
                    ?>
                    Cases:
                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php endwhile; ?>
                    <?php 
                    // Prevent weirdness
                    wp_reset_postdata();
                    endif;
                ?>
            </span>

            <span class="tags category-item"><?php echo the_tags(); ?> </span>   
        </p>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
<?php else: ?>

<li class="item bullet">
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</li>

<?php endif; ?>