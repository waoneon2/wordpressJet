<?php
/**
 * Template Name: Index Front
 */
?>
<?php get_header(); ?>
    <!-- Content -->
    <div class="container index-front">
        <div class="row ">
            <div class="col-md-3"><?php get_sidebar( 'left' ); ?></div>
            <div class="col-md-6">
                <?php if ( have_posts() ) { ?>
                    <?php while ( have_posts() ) { the_post(); ?>
                        <div class="wrap-box">
                            <?php if (!is_front_page()): ?>
                                <h1><?php the_title(); ?></h1>
                            <?php else : ?>
                                <div style="margin-top: 20px"></div>
                            <?php endif ?>
                            <?php the_post_thumbnail(); ?>
                            <?php the_content(); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-3"><?php get_sidebar( 'right' ); ?></div>
        </div>
    </div>
<?php get_footer(); ?>

<style type="text/css">
    .index-front h1 {
        font-weight: 700
    }
</style>
