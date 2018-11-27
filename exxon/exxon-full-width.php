<?php
/**
 * Template Name: Template Exxon Full width no sidebar
 */

get_header(); ?>

	<div id="primary" class="site-content ex-page-default full-width">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'default' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>