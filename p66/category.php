<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package p66
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
			<?php
			if ( have_posts() ) : ?>

			<header class="cat-header entry-header-margin">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );

					$cat = get_category( get_query_var( 'cat' ) );
					$category = $cat->slug;
				?>
			</header><!-- .page-header -->
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'category' );

				endwhile;

				?>
				<div class="pagination">
					<?php
						the_posts_pagination( array(
					        'prev_text' => __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'textdomain' ),
					        'next_text' => __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'textdomain' ),
					        'mid_size' 	=> 5,
					    ) );
					?>
				</div>
				<?php

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
