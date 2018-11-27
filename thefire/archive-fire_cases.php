<?php
/**
 * Archive for Fire Cases
 */

get_header();

$limit = isset($_GET['limit']) ? sanitize_text_field($_GET['limit']) : null;

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
                if((isset($limit)) && (null !== $limit) && ("all" === $limit)){
                    query_posts($query_string . '&orderby=title&order=ASC&posts_per_page=-1');
                }
                else{
                    query_posts($query_string . '&orderby=title&order=ASC&posts_per_page=20');
                }
                ?>
                <?php if ( have_posts() ) : ?>
                    <ul class="posts-list">
                        <?php /* The loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content-archive', get_post_format() ); ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php ww_paging_nav_view_all(); ?>

                <?php endif; ?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>