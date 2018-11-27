<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php if ( is_day() ) : ?>
<div class="archives-page-header">
    <div class="wrapper clearfix">
        <h1 class="archives-label"><?php echo __( 'Daily Archives:', 'firecomps' ); ?></h1>
        <div class="archives-date"><?php echo get_the_date(); ?></div>
    </div>
</div>
<?php elseif ( is_month() ) : ?>
<div class="archives-page-header">
    <div class="wrapper clearfix">
        <h1 class="archives-label"><?php echo __( 'Monthly Archives:', 'firecomps' ); ?></h1>
        <div class="archives-date"><?php echo get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ); ?></div>
    </div>
</div>
<?php elseif ( is_year() ) : ?>
<div class="archives-page-header">
    <div class="wrapper clearfix">
        <h1 class="archives-label"><?php echo __( 'Yearly Archives:', 'firecomps' ); ?></h1>
        <div class="archives-date"><?php echo get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ); ?></div>
    </div>
</div>
<?php else : ?>
<div class="category-header">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'Archives', 'firecomps' ); ?></h1>
    </div>
</div>
<?php endif; ?>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<section class="posts-list">
            	<ul>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
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
<?php get_footer(); ?>