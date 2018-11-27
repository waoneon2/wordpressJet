<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Alabama_Policy_Institute
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="entry-title"><?php esc_html_e( '404','alabama-policy-institute') ?></h1>
					<h3 class="page-title"><?php esc_html_e( 'Page not found.','alabama-policy-institute'); ?></h3>
				</header><!-- .page-header -->
				<div class="container">
						<div class="md-8" >
							<div id="text-not-found-404">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?','alabama-policy-institute' ); ?></p>
							</div>
						</div>
						<div class="md-4">
							<div id="search-form-404">
								<?php get_search_form();?>
							</div>
						</div>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

 <?php get_footer(); ?>