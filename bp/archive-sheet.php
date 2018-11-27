<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BP
 */

get_header(); ?>
<div class="row content-archive-sheet">
  <div class="large-12 columns">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

            <header class="page-header-sheet">
              <h1><?php _e('Fact Sheets', 'bp'); ?></h1>
            </header><!-- .page-header -->

        <?php
            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $per_page = $wp_query->get( 'posts_per_page' );
            $total    = $wp_query->found_posts;
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( 1 == $total ) {
              _e( '<p class="showing_count">Showing the single result</p>', 'bp_jetty' );
              } elseif ( $total <= $per_page || -1 == $per_page ) {
                printf( __( '<p class="showing_count">Showing all %d results</p>', 'bp_jetty' ), $total );
              } else {
                printf( _x( '<p class="showing_count">Showing %1$d&ndash;%2$d of %3$d </p>', '%1$d = first, %2$d = last, %3$d = total', 'bp_jetty' ), $first, $last, $total );
              }
        ?>

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', 'sheet');

            endwhile;

            //the_posts_navigation();


        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

        <?php if (function_exists("bp_pagination")) { ?>
        <div class="row pagination-container">
        <?php
          bp_pagination();
        } ?>
        </div>



        </main><!-- #main -->
    </div><!-- #primary -->
  </div>

<?php
get_footer();
