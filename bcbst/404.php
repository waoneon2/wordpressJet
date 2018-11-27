<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="entry-title"><?php esc_html_e( '404 ', 'bcbst' ) ?><i class="fa fa-warning"></i> </h1>
					<h3 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bcbst' ); ?></h3>
				</header><!-- .page-header -->
				<div class="container">
					<div class="row">
						<div class="col-md-8" >
							<div id="text-not-found-404">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bcbst' ); ?></p>
							</div>
						</div>
						<div class="col-md-4">
							<div id="search-form-404">
								<?php get_search_form();?>
							</div>
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer(); ?>
