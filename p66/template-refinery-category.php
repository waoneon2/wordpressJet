<?php

/**
 * Template Name: Refinary Archive
 */
get_header();

$args = array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-refinary.php'
        );
$the_query = new WP_Query($args);
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
			<?php
			if ( $the_query->have_posts() ) : ?>
			<h1 class="page-title">All Refinary Page</h1>

			<?php
				/* Start the Loop */
				while ( $the_query->have_posts() ) : $the_query->the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'category' );

				endwhile;

				?>
				<div class="pagination">
					<?php
						the_posts_pagination( array(
					        'prev_text' => __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'textdomain' ),
					        'next_text' => __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'textdomain' ),
					        'mid_size' 	=> 5,
					    ) );
					?>
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