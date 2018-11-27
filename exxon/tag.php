<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
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
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
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

				/*
				 * Include the post format-specific template for the content. If you want to
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

<?php 
// get_sidebar(); ?>
<?php get_footer(); ?>