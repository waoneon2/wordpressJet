<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'alabama-policy-institute' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content container">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'alabama-policy-institute' ),
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
			<div class="md-8" >
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'alabama-policy-institute' ); ?></p>
			</div>
			<div class="md-4" >
				<div class="form-search-none">
				<?php
					get_search_form(); ?>
				</div>
			</div>
			<?php

		else : ?>
			<div class="md-8" >
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'alabama-policy-institute' ); ?></p>
			</div>
			<div class="md-4" >
				<div class="form-search-none">
				<?php
					get_search_form(); ?>
				</div>
			</div>
			<?php

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
