<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LADWP
 */

get_header();

global $post;
$ca_obj = get_the_category($post->ID);
$category = $ca_obj[0]->name;

?>
	<div id="primary" class="content-area">
		<main id="main" class="content-container container" role="main">
			<div class="row">
				<div class="row clearfix">
					<div class="col-md-12 col titleRow">
					  <h1 class="archive-title"><?php printf( __( '%s', 'ladwp' ), $category ); ?></h1>
					</div>
				</div>
				<hr class="thin">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="inner">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
