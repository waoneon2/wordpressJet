<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		if ( have_posts() && get_query_var('s')) : ?>


			<header class="page-header">
				<div class="row">
					<div class="col-md-8">
						<h1 class="entry-title"><?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'bcbst' ), '<span>' . get_search_query() . '</span>' );
						?></h1>
					</div>
					<div class="col-md-4 search">
						<?php get_search_form(); ?>
					</div>
				</div>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			?>
			<div style="text-align: center;">
				<?php the_posts_pagination(); ?>
			</div>
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();?>
