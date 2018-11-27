<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php $source = trim( get_post_meta($post->ID, "banner_image", true) );
if( !empty( $source ) ) : ?>
	<div class="category-header" style="background-image: url('<?php the_field('banner_image');  ?>');">
<?php else :?>
  	<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
<?php endif; ?>

	
	<div class="wrapper clearfix">
        <h1 class="category-title">Cases</h1>

    </div></div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title">Cases</h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content-cases_single', get_post_format() ); ?>
				<?php //twentythirteen_post_nav(); ?>
				<?php //comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>