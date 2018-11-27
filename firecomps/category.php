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
	if ($cat_ID == 3):
		get_template_part('content', 'cases');
	else: ?>
<div class="category-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/categories/<?php echo $cat_ID; ?>.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
        <?php if ( category_description() ) : // Show an optional category description ?>
            <div class="category-meta"><?php echo category_description(); ?></div>
        <?php endif; ?>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
            <section class="posts-list">
            	<ul>
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