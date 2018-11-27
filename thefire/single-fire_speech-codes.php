<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php 
			
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			 
			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}
		
			?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<span class="entry-header">
							<?php the_title(); ?>
					    </span><!-- .entry-header -->
					    <p class="category">
                        
						        <!--<span class="author category-item"><?php the_author_posts_link(); ?></span>-->	
                      			<!--<span class="date category-item"><?php echo get_the_date(); ?> </span>-->
                                <span class="tags category-item"><?php echo the_tags(); ?> </span> 
                                <span class="category-item"> Category: <?php echo get_the_category_list( __( ', ') ); ?></span>
								<span class="category-item">School: 		
									<?php 
										// Find connected pages
										$connected = new WP_Query( array(
										  'connected_type' => 'statement_schools',
										  'connected_items' => get_queried_object_id(),
										  'nopaging' => true,
										) );
										// Display connected pages
										if ( $connected->have_posts() ) :
										?>
										<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<?php endwhile; ?>
										<?php 
										// Prevent weirdness
										wp_reset_postdata();
										endif;
									?></span>
									<?php $source_rating2 = trim( get_post_meta( get_the_ID(), "speech_code_rating", true) );

									if( !empty( $source_rating2  ) ) : //checks to see if Speach Code Rating has a rating 
									?>
										<span class="category-item">Statement Rating: 
											<?php echo get_speech_rating( (int) $source_rating2); ?></span> 

									<?php  else : ?>
										<span class="category-item">Statement Rating: Not Rated</span> 
									<?php endif; ?>  

					<span class="category-item">Last updated: <?php the_modified_date(); ?></span>
					    </p>   
					    <div class="entry-content">
							<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_single( 196 ) ) : ?>
					        <div class="entry-thumbnail">
					            <?php the_post_thumbnail('full'); ?>
					        </div>
					        <?php endif; ?>
					        <?php //the_content(); ?>
					        
					        <?php if ( get_field('regulation_text') ) : ?>
							<p><strong>Relevant excerpt</strong></p>
							<p><?php the_field('regulation_text'); ?></p>
							<?php endif; ?>
					  
							<?php if( get_field('full_text') ): ?>
							    <p><a href="<?php echo wp_get_attachment_url( get_field('full_text') ); ?>" >Download full policy</a></p>
							<?php endif; ?>


					        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					    </div><!-- .entry-content -->

					    <footer class="entry-meta">
					        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					    </footer><!-- .entry-meta -->
					</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>