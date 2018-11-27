<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NCOC
 */

get_header('search'); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		global $wp_query;
		if (empty($wp_query->query_vars['s'])):
		get_search_form();
		else:
		get_search_form();
		if ( have_posts() ) : ?>

			<?php

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		the_posts_pagination();
		endif;
		?>
		
		</main><!-- #main -->
	</section><!-- #primary -->
	
	</div><!-- #content -->
	</div><!-- #col-of-content -->
	</div>

<?php
get_footer();
