<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */
$ancestors = get_post_ancestors(get_the_ID());
$parent = null;
if(count($ancestors) > 0){
	$root = count($ancestors) - 1;
	$parent = $ancestors[$root];
}

if(!is_null($parent)):
get_header('custom-default'); 
else:
get_header('single');
endif;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$ncoc_query = new WP_Query();
			$all_wp_pages = $ncoc_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));
			$ncoc_get_children = get_page_children( get_the_ID(), $all_wp_pages );
			if(!empty($ncoc_get_children)){
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page-parent' );
				endwhile; // End of the loop.
			} else{
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	</div><!-- #content -->
	</div><!-- #col-of-content -->
	</div>

<?php
get_footer();
