<?php
/*
Template Name: Top Cases
*/
?>
<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<?php 
	global $wp_query; 
	$cat_ID = get_query_var('cat');
	if ($cat_ID == 530):
		get_template_part('content', 'cases');
	else: ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo get_the_title(); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo get_the_title(); ?></h1>
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
		<?php 
		$args = array(
			'post_type' => 'fire_cases',
			'post_status' => 'publish',
			'posts_per_page' => 9, 
			'meta_query' => array(
				array(
				'key' => 'top_cases',
				'value' => '1',
				'compare' => '==' )),
			'orderby' => 'comment_count date',
			'order' => 'DESC',
		);
		$query_popular = new WP_Query($args);
		if ($query_popular->have_posts()): ?>
			<?php /* The loop */ ?>
            <section class="posts-list">
            	<ul class="no-style">
			<?php while ( $query_popular->have_posts() ) : $query_popular->the_post(); ?>
				<li><?php get_template_part( 'template_cases_layout', get_post_format() ); ?></li>
			<?php endwhile; ?>
            	</ul>
            </section>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php //get_sidebar(); ?>
</div>
    <?php endif; ?>
<?php get_footer(); ?>