<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_single( 196 ) ) : ?>
		<div class="entry-content">
		    <div class="entry-thumbnail">
		        <?php the_post_thumbnail('full'); ?>
				<?php
				$credit = get_metadata('post', get_the_ID(), '_photo_credit', true);
				if ( $credit ): ?>
					<p class="credit"><?= $credit ?></p>
				<?php endif; ?>
		    </div>
		</div>
    <?php endif; ?>
    
    <?php 
			
	if ( function_exists( 'sharing_display' ) ) {
		sharing_display( '', true );
	}
	 
	if ( class_exists( 'Jetpack_Likes' ) ) {
		$custom_likes = new Jetpack_Likes;
		echo $custom_likes->post_likes( '' );
	}

	?>
    
    <span class="entry-header">
		<?php the_title(); ?>
    </span><!-- .entry-header -->
    <div class="entry-content">
    	<p class="category">
             <span class="author">
							 <?php
							 $categories = get_the_category();
							 if($categories[0]->cat_ID != 532 &&  $categories[0]->cat_ID != 504) { ?>
							<?php if(!is_attachment()): ?>
								 By <?php if(function_exists('coauthors_posts_links') )
                                        coauthors_posts_links();
                                    else
                                        the_author_posts_link(); ?>
							     <?php endif; ?>
							<?php echo get_the_date(); ?>
							 <?php } else { ?> <?php echo get_the_date(); ?><?php }?>
						 </span>
        </p> 
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

        if( get_field('full_text') ):
						$attachment = get_field('full_text');
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
            
            <?php if($categories[0]->cat_ID == 8 || $categories[0]->cat_ID == 532 || $categories[0]->cat_ID == 533 || $categories[0]->cat_ID == 820 || $categories[0]->cat_ID == 531 || $categories[0]->cat_ID == 504) { ?>
                <span class="category-item">		
                    <?php
                        // Find connected pages
                        $connected = new WP_Query( array(
                          'connected_type' => 'case_material',
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
            <?php } ?>
			<?php 
			$category = get_the_category(); 
			$cat_ID = $category[0]->cat_ID;

			if($cat_ID != 8 && $cat_ID != 532) { ?>
            <span class="tags category-item"><?php echo the_tags(); ?> </span>
            <?php } ?>   
        </p>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
<?php else: 

if(get_the_author_meta( 'ID' ) > 0) { ?>
<!--
<div class="item">
			<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail('full'); ?>
                </div>
             <?php endif; ?>
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <p class="category">
    	<?php if((get_query_var('cat') != 532) && (get_the_author() != "FIRE")) { ?>
        <span class="author category-item">By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?></span> 	
        <?php } else {?>
        <span class="date category-item"><?php echo get_the_date(); ?> </span> 
        <?php } ?>
    </p>
    <?php the_excerpt(); ?>
    <span><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></span>
    <p style="margin: 0;">&nbsp;</p>
    <p class="category">
        <span class="tags category-item"><?php echo the_tags(); ?> </span> 
        <span class="category-item"> Category: <?php echo get_the_category_list( __( ', ') ); ?></span>
         <?php $source_type = trim( get_post_meta( get_the_ID(), "institution_type", true) );

                        
                       if(count($post->connected) > 0) { echo 'Schools:'; }
                            foreach ( $post->connected as $post ) : setup_postdata( $post ); ?>
                                <a href="<?php the_permalink(); ?>" class="more"><?php the_title(); ?></a>

                               <?php endforeach;

                                wp_reset_postdata(); // set $post back to original post
                                ?>

    </p>
    <hr class="red-line">
</div>
-->

<li class="item bullet">
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?>, <?php echo get_the_date(); ?></a></h1>
</li>

<?php } else { ?>

<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if ($_cat): ?>
    <p class="category">
    <span class="author category-item"><?php if((get_query_var('cat') == 504) && (get_the_author() != "FIRE")) { ?>By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?><?php } ?></span>
    <span class="date category-item"><?php if(get_query_var('cat') != 504) { ?><?php echo get_the_date(); ?><?php } ?></span>
    Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?>
    </p>
    <?php endif; ?>
	<?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>

<?php } ?>

<?php endif; ?>