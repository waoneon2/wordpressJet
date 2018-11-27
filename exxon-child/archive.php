<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content ex-page-default">
		<div id="content" role="main">




		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Archives', 'twentytwelve' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

				<?php
		            $paged    = max( 1, $wp_query->get( 'paged' ) );
		            $per_page = $wp_query->get( 'posts_per_page' );
		            $total    = $wp_query->found_posts;
		            $first    = ( $per_page * $paged ) - $per_page + 1;
		            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		            if ( 1 == $total ) {
		              _e( '<p class="doctype-showing">Showing the single result</p>', 'exxon' );
		              }  else {
		                printf( _x( '<p class="doctype-showing">Showing %1$d &ndash; %2$d of %3$d </p>', '%1$d = first, %2$d = last, %3$d = total', 'exxon' ), $first, $last, $total );
		              }
		        ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			// twentytwelve_content_nav( 'nav-below' );
			?>
				<?php if (function_exists("exxon_pagination")) { ?>
        <div class="row pagination-container" id="exxon-pagination-link">
	        <?php exxon_pagination(); } ?>
	        
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>