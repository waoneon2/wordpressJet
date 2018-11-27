<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package chevron
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container">

			<section class="error-404 not-found container-fluid">

				<header class="page-header">
					<h2 class="page-title"><p><?php _e( 'sorry, the page you tried <br> can\'t be found.', 'chevron' ); ?></p></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					<p class="pc-one"><?php _e( 'It is possible you typed the address incorrectly, <br> or that the page has been moved or removed from the site.', 'chevron' ); ?></p>
					<p class="pc-two"><?php printf(__( '<strong>Please try a search on <a href="%1$s">%2$s</a>.</strong>', 'chevron' ), esc_url(get_home_url()), chevron_get_home_url(get_bloginfo( 'url' ))); ?></p>

				</div><!-- .page-content -->

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();