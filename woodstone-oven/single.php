<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Woodstone_Oven
 */

get_header();
?>
	<div class="container" style="margin-top: 25px; margin-bottom: 25px;">
		<div class="row">
			<div class="col-md-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation();
					?>

<!-- 					<div class="card">
						<div class="card-body"> -->
							<?php	
								// if ( comments_open() || get_comments_number() ) :
								// 	 comments_template();
								// endif;
							?>
<!-- 						</div>
					</div> -->
					
					<?php endwhile; ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>
<?php
get_footer();