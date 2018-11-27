<?php
/*
Template Name: All Posts
*/


/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php    global $post; 
get_header(); ?>	
	<div class="wrapper clearfix">
        <h1 class="category-title"><?php echo get_the_title(); ?> </h1>

    </div></div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ 
			            $wp_query = new WP_Query( array(
                 
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'nopaging' => false,
                        'orderby' => 'date',
                        'order' => 'DESC' ,
						) );
						
						
		// Display connected pages
			if ( $wp_query->have_posts() ) :
				?>
                <section class="posts-list">
                <ul class="no-style">	
					<?php p2p_type( 'post_schools' )->each_connected( $wp_query ); ?>
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                        <li>
                            <div class="item">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                 <p class="category">Category: 
                                    <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); 
                                    if ($_cat): ?>
                                        <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?>
                                    <?php endif; ?><br />
                                    <span class="date">By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?></span><br />
                                            <?php   if(count($post->connected) > 0) { echo 'Schools:'; }
                                                            foreach ( $post->connected as $post ) : setup_postdata( $post ); ?>
                                                                <a href="<?php the_permalink(); ?>" class="more"><?php the_title(); ?></a>
        
                                                               <?php endforeach;
        
                                                                wp_reset_postdata(); // set $post back to original post
                                                                ?>
                                </p>
                                
                                <?php the_excerpt(); ?>
                                <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
                            </div>
                        </li>
					<?php endwhile; ?>
                </ul>
                </section>
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
					endif;		?>
				<?php //comments_template(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
