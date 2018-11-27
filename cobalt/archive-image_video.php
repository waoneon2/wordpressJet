<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cobalt
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<div class="container listing-archive">
			<div class="content-custompage-width">
			<header class="page-header">
				<h1 class="page-title" id="cobalt-media-page-title"><?php _e('Images and Videos', 'cobalt'); ?></h1>
				<?php
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
	            $paged    = max( 1, $wp_query->get( 'paged' ) );
	            $per_page = $wp_query->get( 'posts_per_page' );
	            $total    = $wp_query->found_posts;
	            $first    = ( $per_page * $paged ) - $per_page + 1;
	            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	            if ( 1 == $total ) {
	              _e( '<p class="showing_count">Showing the single result</p>', 'cobalt' );
	              }  else {
	                printf( _x( '<p class="showing_count">Showing %1$d &ndash; %2$d of %3$d </p>', '%1$d = first, %2$d = last, %3$d = total', 'cobalt' ), $first, $last, $total );
	              }
	        ?>

			<?php
			/* Start the Loop */

			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'imagevideo' );
			endwhile;

			//the_posts_navigation();
			// echo "</div>";

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
			</div><!-- .content-archive -->
		</div><!-- .container.listing-archive -->
		 <?php if (function_exists("cobalt_pagination")) { ?>
        <div class="row pagination-container" id="cobalt-pagination-media">
	        <?php cobalt_pagination(); } ?>
        </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();