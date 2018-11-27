<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package andeavor
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php				
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'andeavor' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
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

			$paginate = paginate_links( array(
					'base'		=> str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, absint( get_query_var( 'paged' ) ) ),
					// 'total' 	=> $faq_category->max_num_pages,
					'type' 		=> 'array',
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			<div class="pagination-count">
				<?php if ( ! empty( $paginate ) ) : ?>
					<ul class="pagination">
						<?php foreach ( $paginate as $key => $page_link ) : ?>
							<li class="paginated_link<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
						<?php endforeach ?>
					</ul>
				<?php endif ?>
			</div>
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
