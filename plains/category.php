<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Plains
 */

get_header(); 
$categories = get_the_category();
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$get_slug_by_url = basename($actual_link);
$categories_by_slug = get_category_by_slug( $get_slug_by_url );
$bol_set_cat = false;

if($categories){
	if($categories_by_slug){
		foreach ($categories as $key => $value) {
			if($value->slug == $get_slug_by_url) {
				$category_id = $value->cat_ID;
			}
		}
		$bol_set_cat = true;
	}
} else {
	if($categories_by_slug){
		$bol_set_cat = true;
		$category_id = $categories_by_slug->cat_ID;
	}
}
if($bol_set_cat){
	$cat_args = array('post_type' => array('attachment','post'), 'cat' => $category_id, 'post_status' => array('inherit','publish'));
	$category_content_list = new WP_Query($cat_args);
}
	
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

		<?php
		if ( $bol_set_cat && $category_content_list->have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<div class="prPaging clearfix">
				<p class="right doc-type-showing">
					<?php
						$big = 999999999; // need an unlikely integer
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $category_content_list->max_num_pages
						) );
					?>
				
				<?php
					$paged    = max( 1, $category_content_list->get( 'paged' ) );
					$per_page = $category_content_list->get( 'posts_per_page' );
					$total    = $category_content_list->found_posts;
					$first    = ( $per_page * $paged ) - $per_page + 1;
					$last     = min( $total, $category_content_list->get( 'posts_per_page' ) * $paged );

					printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span>', '%1$d = first, %2$d = last, %3$d = total', 'plains' ), $first, $last, $total );
				?>
				</p>
			</div>
			<div class="row">
				<?php
				/* Start the Loop */
				while ( $category_content_list->have_posts() ) : $category_content_list->the_post();
				?>
					<div class="col-md-12 clearfix">
						<div class="doc-list-full-item clearfix">
							<div class="col-md-11 col-sm-11">
								<small><?php the_time('F j, Y');?></small>
								<h3 class="entry-title">
									<a href="<?php echo esc_url(get_permalink());?>" rel="bookmark" >
										<?php the_title();?>
									</a>
								</h3>
							</div>							
						</div>
					</div>

					<?php
				endwhile;

				?>
			</div>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );
		endif; 
		wp_reset_postdata();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
