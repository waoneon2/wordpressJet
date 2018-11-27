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
		  <h1><?php _e( 'Search Results', 'exxon' ); ?></h1>
		</div>

		<!-- FORM -->
		<?php echo do_shortcode('[jetty_advance_search]'); ?>
		<!-- END FORM -->

		<?php if ( have_posts() && $_GET['s'] !== '' ) : ?>
		<?php global $wp_query;
		//print_r($wp_query);
		?>
			<div class="row alert alert-info">
				<div class="col-md-8 col-sm-8">
					<?php printf( __( 'Searched for %s', 'twentytwelve' ), '<strong>"' . get_search_query() . '"</strong>' ); ?>
					<?php //print_r(get_search_query()); ?>
				</div>
				<div class="col-md-4 col-sm-4 text-right">
					<?php
						$paged    = max( 1, $wp_query->get( 'paged' ) );
						$per_page = $wp_query->get( 'posts_per_page' );
						$total    = $wp_query->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

       			printf( _x( 'Results %1$d &ndash; %2$d of %3$d', '%1$d = first, %2$d = last, %3$d = total', 'exxon' ), $first, $last, $total );
					 ?>
				</div>
		  </div>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-md-12 search-content">
					<div class="doc-list-full-item clearfix">
						<div class="col-md-10 col-sm-10">
							<small><?php echo get_the_date() ?></small>
							<h3 class="entry-title">
								<a href="<?php echo esc_url(get_permalink());?>" rel="bookmark" >
									<?php the_title();?>
								</a>
							</h3>
						</div>
						<div class="col-md-2 col-sm-2">
						    <div class="pull-right">
						        <span class="label label-warning"><?php the_category( ', ' ); ?></span>
						    </div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="pager search-content">
				<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
				?>
			</div>
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

				<div class="entry-content">
					<p><?php _e( 'Your search did not match any documents.', 'exxon' ); ?></p>
					<p><?php _e( 'Suggestions:', 'exxon' ); ?></p>
					<ul>
						<li><?php _e( 'Make sure all words are spelled correctly', 'exxon' ); ?></li>
						<li><?php _e( 'Try different keywords', 'exxon' ); ?></li>
						<li><?php _e( 'Try more general keywords', 'exxon' ); ?></li>
					</ul>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>


<style type="text/css">
	.alert {
	  background-color: #ECECEC;
	  border-radius: 0;
	  margin-top: 10px;
	  margin-bottom: 10px;
	}
	.alert-info {
	    background-color: transparent;
	    color: #002A5C;
	    background-image: none;
	    border: 0 none;
	}
	.search-content {
		padding-right: 0;
    padding-left: 0;
	}

	.label-warning {
	  background-color: #dddddd;
	}
	.label-warning a{
	  font-weight: 400;
	}
	.search-content a, .search-content a:link, .search-content a:visited {
	    color: #002A5C;
	    transition: all 0.25s ease-out 0s;
	}
	.search-content a:hover {
	    color: #d31145;
	}
	.pager {
	    color: #999999;
	    font-size: .75em;
	    padding: 1em;
	    text-align: center;
	    display: block;
	    clear: both;
	}
</style>
<?php get_footer(); ?>
