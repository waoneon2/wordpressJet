<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package chevron
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		
		<div class="bc-line width-1280 centered">
			<?php get_breadcrumb(); ?>
		</div>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );
		?>
		<div class="container width-1280 centered" id="single-navigation">
			<div class="row">
			
				<div class="col-xs-12 col-sm-6" id="prev-nav">
					<p class="link">
				<?php
					previous_post_link( '%link', '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> previous: %title', TRUE );
				?>
					</p>
				</div>
				<div class="col-xs-12 col-sm-6" id="next-nav">
					<div class="pull-right">
					<p class="link">
				<?php
					next_post_link( '%link', 'next: %title <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', TRUE );
				?>
					</p>
					</div>
				</div>
			</div>
		</div>
		<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer(); 