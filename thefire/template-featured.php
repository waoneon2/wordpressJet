<?php
/*
Template Name: Featured Posts 
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
<?php get_header(); ?>	

<?php $source = trim( get_post_meta($post->ID, "banner_image", true) );
if( !empty( $source ) ) : ?>
	<div class="category-header" style="background-image: url('<?php //the_field('banner_image');  ?>/wp-content/uploads/2014/01/default-banner.jpg');">
<?php else :?>
  	<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
<?php endif; ?>
	
	<div class="wrapper clearfix">
        <h1 class="category-title">Featured Content</h1>

    </div></div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title">Featured Content</h1>
    </div>
</div>

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
			<?php /* The loop */ 
			            $connected = new WP_Query( array(
                 
                        'post_type' => 'post',
                        'nopaging' => true,
                        'orderby' => 'date',
                        'order' => 'DESC' ,
						'meta_query' => array( 
										array(
							'key' => 'include_on_homepage',
							'value' => '1',
							'compare' => '=='
						)
					)
						) );
						
						
		// Display connected pages
			if ( $connected->have_posts() ) :
				?>
                <section class="posts-list">
                <ul class="no-style">	
					<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
				<li>
                    <div class="item">
                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if ($_cat): ?>
                        <p class="category">
                        	<span class="author category-item">By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?></span> 	
                        	Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?>
                        </p>
                        <?php endif; ?>
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