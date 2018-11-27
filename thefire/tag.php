<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
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
	//$the_banner = /?cat=<?php the_field('banner_image');
	
	?>
	<?php $details = get_field('banner_image', 'category_'. $cat_ID .''); ?>

<?php	
	if ($cat_ID == 530):
		//get_template_part('content', 'cases');
	else: ?>

<div class="category-header" style="background-image: url('<?php if( !empty( $details ) ) : //checks to see is federal circuit has a rating          
			echo $details;
       		else : ?>
          	/wp-content/uploads/2014/01/default-banner.jpg
       		<?php endif; ?>');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>

<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
            <section class="posts-list">
            	<ul class="no-style">
			<?php while ( have_posts() ) : the_post(); ?>
				<li><?php get_template_part( 'content', get_post_format() ); ?></li>
			<?php endwhile; ?>
            	</ul>
            </section>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
    <?php endif; ?>
<?php get_footer(); ?>