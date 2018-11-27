<?php
/**
 * Template Name: Image Rotator
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();  ?>

			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<!-- .entry-header -->
				<?php dynamic_sidebar('inside_page'); ?>
				<div class="entry-content img-rotator">
					<?php
						the_content();
					?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->


			<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

