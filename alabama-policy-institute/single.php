<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Alabama_Policy_Institute
 */

get_header(); ?>

	<div id="primary" class="content-area ">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			/*if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/

		endwhile; // End of the loop.
		?>

		<?php
			$categories = get_the_category();
			$cat = '';
			foreach ($categories as $key => $value) {
				$cat .= $value->slug.', ';
			}

			$cat_posts = new WP_Query(array(
				'category_name' => $cat,
				'posts_per_page' => 3,
				'post_type' => 'post')
			);

		 ?>
		<section>
			<div class="container">
				<h3>MORE ON <?php the_category(', ') ?></h3>
				<div class="content__wrapper content__wrapper--padding">
				<?php
					if ($cat_posts->have_posts()) {
						while ($cat_posts->have_posts()): $cat_posts->the_post();
							$postexc = get_the_excerpt();
							?>
							<article class="content__box">
								<?php
						            if ( has_post_thumbnail() ) {
										echo '<div class="content__image sa">';
										the_post_thumbnail();
										echo '</div>';
									} else {
										echo '<div class="content__image"><img src="';
										echo get_bloginfo('template_directory').'/img/placeholder.jpg"></div>';
									}
						        ?>
								<div class="content__inner">
									<?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
									<p class="content__date"><?php the_time('M j, Y'); ?></p>
									<p class="content__text"><?php echo $postexc; ?></p>
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					}

				?>
				</div>
			</div>
		</section>

		<?php
			$author_posts = new WP_Query(array(
				'author' => $post->post_author,
				'posts_per_page' => 3,
				'post_type' => 'post')
			);
		?>

		<section>
			<div class="container">
				<h3 class="no-top-margin">MORE FROM THE AUTHOR</h3>
				<div class="content__wrapper content__wrapper--padding">
				<?php
					if ($author_posts->have_posts()) {
						while ($author_posts->have_posts()): $author_posts->the_post();
							$postexc = get_the_excerpt();
							?>
							<article class="content__box">
								<?php
						            if ( has_post_thumbnail() ) {
										echo '<div class="content__image as">';
										the_post_thumbnail();
										echo '</div>';
									} else {
										echo '<div class="content__image"><img src="';
										echo get_bloginfo('template_directory').'/img/placeholder.jpg"></div>';
									}
						        ?>
								<div class="content__inner">
									<?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
									<p class="content__date"><?php the_time('M j, Y'); ?></p>
									<p class="content__text"><?php echo $postexc; ?></p>
									<!-- <p><?php the_author(); ?></p> -->
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					}
				?>
				</div>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
