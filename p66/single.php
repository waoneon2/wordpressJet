<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package p66
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					?>
					<div class="story-links">
						<?php the_post_navigation( array(
				            'prev_text'	=> __( '<div class="story-link-text">
				            	<p>More About:</p>
				            	<p>%title</p></div>' ),
				            'next_text'	=> __( '<div class="story-link-text">
				            	<p>Next Story:</p>
				            	<p>%title</p></div>' ),
				        ) ); ?>
					</div>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					/*if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;*/

				endwhile; // End of the loop.
				?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();


?>
