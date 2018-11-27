<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Woodstone_Oven
 */

get_header();
?>

	<section id="primary" class="content-area">
		<div class="container" style="margin-top: 40px;">
			<main id="main" class="site-main">

			<?php 
				$s_val = true;
				if (is_search()) {
					$s_val = (isset($_GET['s']) && $_GET['s']) ? true : false;
				} 
			?>
			
			<?php if ( have_posts() && $s_val) : ?>

				<header class="page-header">
					<div class="alert alert-success" role="alert">
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'wso' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</div>

				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
		</div>
	</section><!-- #primary -->

<?php
// get_sidebar();
get_footer();
