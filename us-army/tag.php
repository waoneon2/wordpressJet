<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package US Army
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="inner-content">
			<?php
			if ( have_posts() ) : ?>

				<header class="page-header with-border">
					<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</header><!-- .page-header -->
				<div class="prPaging clearfix">
					<p class="right doc-type-showing">
					<?php
						$paged    = max( 1, $wp_query->get( 'paged' ) );
						$per_page = $wp_query->get( 'posts_per_page' );
						$total    = $wp_query->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

						printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span>', '%1$d = first, %2$d = last, %3$d = total', 'us-army' ), $first, $last, $total );
					?>
					</p>
				</div>
				<div class="row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'cat-list' );
					endwhile; ?>
				</div>
				<div class="row">
					<div class="col-md-12 category-pagination">
						<?php
						$big = 999999999; // need an unlikely integer
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
						) );
						// the_posts_navigation();
						?>
					</div>
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
