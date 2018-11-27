<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


		<div class="page-header">
		  <h1><?php _e( 'Search Results', 'nasa_jsc' ); ?></h1>
		</div>

		<!-- FORM -->
		<?php echo do_shortcode('[jetty_advance_search]'); ?>
		<!-- END FORM -->

		<?php if ( have_posts() && $_GET['s'] !== '' ) : ?>
		<?php global $wp_query;

		?>
			<div class="row alert alert-info">
				<div class="col-md-8 col-sm-8 col-xs-6">
					<?php printf( __( 'Searched for %s', 'nasa_jsc' ), '<strong>"' . get_search_query() . '"</strong>' ); ?>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 text-right">
					<?php
						$paged    = max( 1, $wp_query->get( 'paged' ) );
						$per_page = $wp_query->get( 'posts_per_page' );
						$total    = $wp_query->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

       			printf( _x( 'Results %s &ndash; %s of %s', 'nasa_jsc' ), '<strong>'.$first.'</strong>', '<strong>'.$last.'</strong>', '<strong>'.$total.'</strong>' );
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
					$big = 999999999; 
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

			<article id="post-0" class="post no-results not-found">

				<div class="entry-content">
					<p><?php _e( 'Your search did not match any documents.', 'nasa_jsc' ); ?></p>
					<p><?php _e( 'Suggestions:', 'nasa_jsc' ); ?></p>
					<ul>
						<li><?php _e( 'Make sure all words are spelled correctly', 'nasa_jsc' ); ?></li>
						<li><?php _e( 'Try different keywords', 'nasa_jsc' ); ?></li>
						<li><?php _e( 'Try more general keywords', 'nasa_jsc' ); ?></li>
					</ul>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

<?php get_footer(); ?>
