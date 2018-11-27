<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		
 		<?php
		if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) : the_post(); ?>

				<div class="banner">
					<div class="banner-img">
						<div class="banner-text-container">
							<div class="banner-text">
								<h1><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						</div>
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
		<?php
			endwhile;
		endif;

      	if (is_active_sidebar('jetty-homepage')) {
          	dynamic_sidebar('jetty-homepage');
      	} ?>
      	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
