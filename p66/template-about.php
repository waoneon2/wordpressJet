<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

	<div id="primary" class="content-area container-fluid">
		<main id="main" class="site-main" role="main">

      <div class="contained two-column section-top section-bottom">
        <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/content', 'page' );
        endwhile; // End of the loop. ?>
      </div>

      <?php
      if (is_active_sidebar('jetty-about-page')) {
          dynamic_sidebar('jetty-about-page');
      } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

