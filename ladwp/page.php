<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LADWP
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-container container" role="main">
			<div class="row">
				<div class="row clearfix">
					<div class="col-md-12 col titleRow">
					  <h1 class="entry-title"><?php printf( __( '%s', 'ladwp' ), the_title() ); ?></h1>
					</div>
				</div>
				<hr class="thin">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="inner">
					<?php
					while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'page' );
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
