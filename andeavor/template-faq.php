<?php
/**
 * Template Name: FAQ Page
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
			$cat_faq = (int) get_theme_mod('category_faq');
			$bol_cat_faq = false;
			if($cat_faq){
				$bol_cat_faq = true;
				$cat_faq_args = array(
				    'cat' 				=> $cat_faq,
				    'post_type' 		=> array('post','attachment'),
				    'post_status' 		=> 'publish',
				    'posts_per_page' 	=> 10,
				    'nopaging' 			=> false,
				    'paged'          	=> get_query_var( 'paged' ),
				);
				$faq_category = new WP_Query( $cat_faq_args );
			}

			if($bol_cat_faq){
			?>
			<article id="post-tag-template">
				<header class="entry-header">
					<h1 class="entry-title title-faq"><?php _e(get_the_title(),'andeavor'); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p class="count-showing">
					<?php
						$paged    = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$per_page = $faq_category->get( 'posts_per_page' );
						$total    = $faq_category->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $faq_category->get( 'posts_per_page' ) * $paged );

						printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span>', '%1$d = first, %2$d = last, %3$d = total', 'andeavor' ), $first, $last, $total );
					?>
					</p>
				</div><!-- .entry-content -->

				<div class="content-faq">
					<p><?php echo $post->post_content; ?></p>
				</div>

				<div class="row-list-cat">
					<div class="list-title">
					<?php
						if ( $faq_category->have_posts() ) :
							while ( $faq_category->have_posts() ) :
								$faq_category->the_post();
				    			?>
							    <a href="<?php the_permalink(); ?>" class="content-box">
							        <h3><?php the_title() ?></h3>
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
					'total' 	=> $faq_category->max_num_pages,
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
