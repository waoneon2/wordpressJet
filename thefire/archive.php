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

get_header();
?>
<?php if ( is_day() ) : ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Daily Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Daily Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<?php elseif ( is_month() ) : ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Monthly Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Monthly Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<?php elseif ( is_year() ) : ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Yearly Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo __( 'Yearly Archives:', 'firecomps' ); ?></h1>
    </div>
</div>
<?php elseif ( get_the_ID() ==  59959 || get_the_ID() ==  44691) : ?>
<?php $details = get_field('banner_image', 'category_530'); ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'Cases', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'Cases', 'firecomps' ); ?></h1>
    </div>
</div>
<?php else : ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'All FIRE Cases', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'All FIRE Cases', 'firecomps' ); ?></h1>
    </div>
</div>
<?php endif; ?>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
            <?php
                query_posts($query_string . '&orderby=title&order=ASC&posts_per_page=20');
				//echo $GLOBALS['wp_query']->request;
            ?>
		<?php if ( have_posts() ) : ?>
			<ul class="posts-list">
    			<?php /* The loop */ ?>
    			<?php while ( have_posts() ) : the_post(); ?>
    				<?php get_template_part( 'content-archive', get_post_format() ); ?>
    			<?php endwhile; ?>
            </ul>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>