<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

?>

<section class="no-results not-found countainer">
	<header class="page-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'bcbst' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bcbst' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>
		<?php elseif ( is_search() ) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-8" >
						<div id="text-not-found-on-search">
							<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bcbst' ); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div id="search-form-not-found-on-search">
							<?php get_search_form();?>
						</div>
					</div>
				</div>
			</div>
				<?php else : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-8" >
						<div id="text-not-found-on-search">
							<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bcbst' ); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div id="search-form-not-found-on-search">
							<?php get_search_form();?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
