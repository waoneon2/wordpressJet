<?php
/**
 * Template Name: News of Interest Page
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
			$cat_news = (int) get_theme_mod('category_news_interest');
			$bol_cat_news = false;
			if($cat_news){
				$bol_cat_news = true;
				$cat_news_args = array(
				    'cat' 				=> $cat_news,
				    'post_type' 		=> array('post','attachment'),
				    'post_status' 		=> 'publish',
				    'posts_per_page' 	=> 10,
				    'nopaging' 			=> false,
				    'paged'             => get_query_var( 'paged' ),

				);
				$news_category = new WP_Query( $cat_news_args );
			}

			if($bol_cat_news){
			?>
			<article id="post-tag-template">
				<header class="entry-header">
					<h1 class="entry-title title-news"><?php _e(get_the_title(),'andeavor'); ?></h1>
				</header><!-- .entry-header -->

				<div class="content-news">
					<h3><?php echo $post->post_content; ?></h3>
				</div>

				<div class="list-news-interest">
				<?php
					if ( $news_category->have_posts() ) :
						while ( $news_category->have_posts() ) :
							$news_category->the_post();
			    			?>
						    <a href="<?php the_permalink(); ?>" class="content-box">
						        <h4><?php the_title() ?></h4>
						    </a>
						    <div class="time-news"><?php the_time('F n, Y'); ?></div>
						<?php
						endwhile;
					endif;
				?>
				</div>
			</article>
				<?php
				$paginate = paginate_links( array(
					'base'		=> str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, absint( get_query_var( 'paged' ) ) ),
					'total' 	=> $news_category->max_num_pages,
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
