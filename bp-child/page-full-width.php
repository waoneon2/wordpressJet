<?php

//* Template Name: Full Width
get_header(); ?>
<div class="container nav-line bp-bread rows pages-full-width">
    <!-- <div class="large-12 columns"> -->
        <header class="entry-header">
            <h3 class="entry-title"><?php the_title(); ?></h3>
        </header><!-- .entry-header -->
    <!-- </div> -->

    <div class="col-md-9">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
            <?php /* The loop */ ?>
            <?php //while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bp' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'bp' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                </article><!-- #post -->
            <?php //endwhile; ?>
            </main>
        </div>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>