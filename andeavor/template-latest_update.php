<?php
/**
 * Template Name: Latest Update Page
 */

get_header(); ?>
<style>
	.pagination-count {
	    text-align: -webkit-center;
	    text-align: center;
	}
</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
			$cat_latest = (int) get_theme_mod('category_latest_update');
			$bol_cat_latest = false;
			if($cat_latest){
				$bol_cat_latest = true;
				$cat_latest_args = array(
				    'cat' 				=> $cat_latest,
				    'post_type' 		=> array('post','attachment'),
				    'post_status' 		=> 'publish',
				    'posts_per_page' 	=> 10,
				    'nopaging' 			=> false,
				    'paged'          => get_query_var( 'paged' ),
				);
				$latest_category = new WP_Query( $cat_latest_args );
			}

			if($bol_cat_latest){
			?>
			<article id="post-tag-template">
				<header class="entry-header">
					<h1 class="entry-title title-latest"><?php _e(get_the_title(),'andeavor'); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p class="count-showing">
					<?php
						$paged    = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$per_page = $latest_category->get( 'posts_per_page' );
						$total    = $latest_category->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $latest_category->get( 'posts_per_page' ) * $paged );

						printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span>', '%1$d = first, %2$d = last, %3$d = total', 'andeavor' ), $first, $last, $total );
					?>
					</p>
				</div><!-- .entry-content -->

				<div class="content-latest">
					<p><?php echo $post->post_content; ?></p>
				</div>

				<div class="row-list-cat">
					<div class="list-title">
					<?php
						if ( $latest_category->have_posts() ) :
							while ( $latest_category->have_posts() ) :
								$latest_category->the_post();
				    			?>
							    <a href="<?php the_permalink(); ?>" class="content-box">
							        <h3><?php the_title(); echo ' ('.get_the_time('gA l, F n').')' ?></h3>
							    </a>
							<?php
							endwhile;
						endif;
					?>
					</div>
				</div>
			</article>
				<?php
				$paginate = paginate_links( array(
					'base'		=> str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, absint( get_query_var( 'paged' ) ) ),
					'total' 	=> $latest_category->max_num_pages,
					'type' 		=> 'array',
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			<div class="pagination-count">
				<?php if ( ! empty( $paginate ) ) : ?>
					<ul class="pagination">
						<?php foreach ( $paginate as $key => $page_link ) : ?>
							<li class="paginated_link<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
						<?php endforeach ?>
					</ul>
				<?php endif ?>
			</div>
			<?php
				wp_reset_postdata();
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
