<?php
/**
 * Template Name: Social Media Page
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
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 5,
			);
			$the_query = new WP_Query( $args );
			?>
			<article id="post-tag-template">
				<header class="entry-header">
					<h1 class="entry-title title-news"><?php _e(get_the_title(),'andeavor'); ?></h1>
				</header><!-- .entry-header -->

				<div class="content-social">
					<h3><?php echo $post->post_content; ?></h3>
				</div>

				<div class="list-social-interest">
				<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 5,
				);
				$the_query = new WP_Query( $args );  // print_r($the_query);
													//print_r($the_query->query['post_type']); //-- show the post

				if ( $the_query->have_posts() )
				{
					while ( $the_query->have_posts() )
					{
						$the_query->the_post();
						echo '<b>' .get_the_title().' </b> ' . get_the_time() .' ';
						echo ' '. the_excerpt().' ';
					}

					/* Restore original Post Data */
					wp_reset_postdata();
				}
				else {
				// no posts found
					}
				?>
				</div>
			</article>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
