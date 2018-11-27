<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LADWP
 */

get_header(); ?>

  <section id="primary" class="content-area">
    <div id="content" class="content-container container" role="main">
      <div class="row">
        <?php
        if ( have_posts() ) : ?>
        <?php global $wp_query; ?>
        <div class="row clearfix">
          <div class="col-md-12 col titleRow">
            <?php
              the_archive_title( '<h1 class="archive-title">', '</h1>' );
              the_archive_description( '<div class="archive-description">', '</div>' );
             ?>
          </div>
        </div>
        <hr class="thin">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="inner">
            <div class="prPaging">
              <div class="right">
                <?php
                  $big = 999999999; // need an unlikely integer
                  echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages
                  ) );
                ?>
              </div>
              <?php
                $paged    = max( 1, $wp_query->get( 'paged' ) );
                $per_page = $wp_query->get( 'posts_per_page' );
                $total    = $wp_query->found_posts;
                $first    = ( $per_page * $paged ) - $per_page + 1;
                $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

                printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span> Items', '%1$d = first, %2$d = last, %3$d = total', 'exxon' ), $first, $last, $total );
              ?>
            </div>
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content-category', get_post_format() );
            /* END the Loop */
            endwhile; ?>
            <div class="prPaging">
              <div class="right">
                <?php
                  $big = 999999999; // need an unlikely integer
                  echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages
                  ) );
                ?>
              </div>
              <?php
                $paged    = max( 1, $wp_query->get( 'paged' ) );
                $per_page = $wp_query->get( 'posts_per_page' );
                $total    = $wp_query->found_posts;
                $first    = ( $per_page * $paged ) - $per_page + 1;
                $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

                printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span> Items', '%1$d = first, %2$d = last, %3$d = total', 'exxon' ), $first, $last, $total );
              ?>
            </div>
          </div>
        </div>

        <?php
        else : ?>
          <div class="col-md-8 col-sm-8 col-xs-12">
          <?php get_template_part( 'template-parts/content', 'none' ); ?>
          </div>
        <?php endif; ?>
        <div class="col-aside-right col-md-4 col-sm-4 col-xs-12">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div><!-- #content -->
  </section><!-- #primary -->

<style type="text/css">

</style>
<?php

get_footer();
