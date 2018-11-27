<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package p66
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="content">
				<div class="search-hero section-bottom-small">
					<h1 class="search-h1 hidden-xs">Search Results</h1>
					<h2 class="search-h2">You searched for</h2>
					<div class="search-bar row" data-spy="affix">
					    <div class="col-lg-12">
					      <!-- GET should likely be a POST, once the backend integration is avialable -->
							<form action="<?php bloginfo('url');?>" method="get" class="contained">
								<input type="text" name="s" placeholder="search phillips66.com">
								<button type="submit" class="btn-primary">search</button>
							</form>
					    </div>
					</div>
				</div>
			</header><!-- .page-header -->

			<div class="container">
				<!-- Form Dropdowns -->
				<div class="row">
					<select class="dropdown search-dropdown">
					    <option value="0" selected disabled>Result Type</option>
					    <option value="1">Option 1</option>
					    <option value="2">Option 2</option>
					    <span class="caret"></span>
					</select>
					<select class="dropdown search-dropdown">
					    <option value="0" selected disabled>Modified Date</option>
					    <option value="1">Option 1</option>
					    <option value="2">Option 2</option>
					    <span class="caret"></span>
					</select>

				</div>

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
				<div class="pagination">
					<?php
						the_posts_pagination( array(
					        'prev_text' => __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'textdomain' ),
					        'next_text' => __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'textdomain' ),
					        'mid_size' 	=> 10,
					    ) );
					?>
				</div>
			</div>
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();


