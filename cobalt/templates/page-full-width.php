<?php
/**
 * Template Name: Page Full Width
 */
?>
<?php get_header(); ?>
    <!-- Content -->
    <div class="container index-front">
    <div class="content-custompage-width">
        <div class="row ">
            <div class="col-md-12">
                <?php if ( have_posts() ) { ?>
                    <?php while ( have_posts() ) { the_post(); ?>
                        <div class="wrap-box">
                            <h1><?php the_title(); ?></h1>
                            <?php the_post_thumbnail(); ?>
                            <?php the_content(); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
<?php get_footer(); ?>

<style type="text/css">
    .index-front h1 {
        font-weight: 700
    }
</style>
