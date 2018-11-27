<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Alabama_Policy_Institute
 */

get_header();

// Staff
$staff_posts = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'staff'
	)
);
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="featured-img hero hero--small hero--list hero--staff">
				<h2 class="hero__heading">Staff</h2>
				<button type="button" class="hero-list__toggle">STAFF LISTING</button>
				<ul class="hero-list__wrapper">
				<?php if ($staff_posts->have_posts()): ?>
					<?php while ($staff_posts->have_posts()): $staff_posts->the_post(); ?>
					<?php $emp_list_position = get_post_meta(get_the_ID(), 'api_staff_emp_position', true); ?>
						<li class="hero-list__item">
							<a href="<?php echo esc_url(get_the_permalink()); ?>" class="hero-list__link">
								<p class="hero-list__name"><?php the_title(); ?></p>
								<span class="hero-list__position"><?php echo $emp_list_position ?></span>
							</a>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif ?>
				</ul>
			</section>
			<?php

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'staff' );

			endwhile; // End of the loop.

			$emp_authorID = get_post_meta($post->ID, 'api_staff_emp_author', true);
			$emp_author   = get_user_by('ID', $emp_authorID);

			$author_posts = new WP_Query(array(
				'author' => $emp_authorID,
				'posts_per_page' => 4,
				'post_type' => 'post')
			); ?>
			<section>
				<div class="container">
					<h3>Publications by <?php echo $emp_author->data->display_name ?></h3>
					<div class="content__wrapper content__wrapper--padding">
						<?php
							$i = 0;
							$showMore = count($author_posts->posts) > 3;
							if ($author_posts->have_posts()) {
								while ($author_posts->have_posts() && $i < 3): $author_posts->the_post();
									$postexc = get_the_excerpt();
									?>
									<article class="content__box">
										<?php
								            if ( has_post_thumbnail() ) {
												echo '<div class="content__image">';
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
									$i++;
								endwhile;
								wp_reset_postdata();
							}
						?>
						<?php if ($showMore): ?>
							<button type="button" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--show-more" data-page="staff"><?php _e('SHOW MORE', 'alabama-policy-institute'); ?><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--red.png" alt="" class="btn__icon"></button>
						<?php endif ?>
					</div>

				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
