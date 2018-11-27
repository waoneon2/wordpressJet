<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package andeavor
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', 'category' );
				?>
				<div class="list-title">
				<?php
				the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); 
				?>
				</div>
				<?php

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
	</div><!-- #primary -->

<?php
get_footer();
