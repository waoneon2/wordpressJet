<?php
/**
 * Template Name: Refinary
 */
get_header();
$refinery = get_theme_mod('refinery_archive_page');
$ref_link = get_the_permalink($refinery);


 ?>
<div class="content">

	<?php
	if (is_active_sidebar('jetty-refinery-page-1')) {
	    dynamic_sidebar('jetty-refinery-page-1');
	} ?>

	<?php
	if (is_active_sidebar('jetty-refinery-page-2')) {
	    dynamic_sidebar('jetty-refinery-page-2');
	} ?>

	<div class="contained wide-content">
		<?php
		        while ( have_posts() ) : the_post();?>
					<div class="entry-content">
						<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'p66' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
		        <?php endwhile; // End of the loop. ?>
	</div>

	<?php
	if (is_active_sidebar('jetty-refinery-page-3')) {
	    dynamic_sidebar('jetty-refinery-page-3');
	} ?>

	<?php
	if (is_active_sidebar('jetty-refinery-page-4')) {
	    dynamic_sidebar('jetty-refinery-page-4');
	} ?>

</div>




<?php
get_footer();
