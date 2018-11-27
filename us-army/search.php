<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="inner-content">
					<!-- FORM -->
					<div class="army-advance-search">
						<div class="col-md-7 army-col">
							<?php echo do_shortcode('[jetty_advance_search]'); ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- END FORM -->

					<?php if ( have_posts() && $_GET['s'] !== '') : ?>
					<?php global $wp_query;
					//print_r($wp_query);
					?>
						<div class="row searchInfoBar">
							<div class="col-md-8 col-sm-8 col-xs-6">
								<?php printf( __( 'Searched for %s', 'us-army' ), '<strong>"' . get_search_query() . '"</strong>' ); ?>
								<?php //print_r(get_search_query()); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-6 text-right">
								<?php
									$paged    = max( 1, $wp_query->get( 'paged' ) );
									$per_page = $wp_query->get( 'posts_per_page' );
									$total    = $wp_query->found_posts;
									$first    = ( $per_page * $paged ) - $per_page + 1;
									$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

			       			printf( _x( 'Results %s &ndash; %s of %s', 'us-army' ), '<strong>'.$first.'</strong>', '<strong>'.$last.'</strong>', '<strong>'.$total.'</strong>' );
								 ?>
							</div>
					  </div>
					  <div class="row">
						<?php while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'cat-list' );
						endwhile; ?>
						</div>
						<div class="pager search-content">
							<?php
								$big = 999999999; // need an unlikely integer
								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $wp_query->max_num_pages,
									'prev_text'=> __('Previous'),
									'next_text'=> __('Next'),
									'show_all' => true
								) );
							?>
						</div>
					<?php else : ?>

						<article id="post-0" class="post no-results not-found army-advance-search">

							<div class="entry-content">
								<p><?php _e( 'Your search did not match any documents.', 'us-army' ); ?></p>
								<p><?php _e( 'Suggestions:', 'us-army' ); ?></p>
								<ul>
									<li><?php _e( 'Make sure all words are spelled correctly', 'us-army' ); ?></li>
									<li><?php _e( 'Try different keywords', 'us-army' ); ?></li>
									<li><?php _e( 'Try more general keywords', 'us-army' ); ?></li>
								</ul>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

					<?php endif; ?>
		</div>
	</main>
</div>

<?php get_footer(); ?>
