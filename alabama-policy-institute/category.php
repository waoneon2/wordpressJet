<?php get_header(); ?>
<?php
	$obj = get_queried_object();
	$current_taxonomy = $obj->taxonomy;
	$terms = get_terms($current_taxonomy, array(
	    'hide_empty' => false,
	) );

	foreach ($terms as $key => $value) {
		$term_list[] = $value->slug;
	}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
				<section class="featured-img hero hero--small hero--list hero--topic-landing" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/backgrounds/bg-topic-detail--hero.jpg')">
					<h2 class="hero__heading"><?php echo $obj->name ?></h2>
					<p class="hero__sub-heading"><?php echo $obj->description ?></p>
					<button type="button" class="hero-list__toggle"><?php _e('Sub topics', 'alabama-policy-institute'); ?></button>
					<ul class="hero-list__wrapper">

						<?php foreach ($terms as $value): ?>
							<li class="hero-list__item">
								<a href="<?php echo get_term_link($value, $current_taxonomy); ?>" class="hero-list__link">
									<p class="hero-list__name"><?php echo $value->name ?> </p>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</section>
				<?php
					$cat_posts = new WP_Query(array(
						'posts_per_page' => 5,
						'cat' => $obj->term_id,
						'post_type' => 'post')
					);
				?>
				<section class="topic">
					<div class="container">
						<div class="topic__wrapper">
							<?php
								if ($cat_posts->have_posts()) {
									$i = 0;
									while ($cat_posts->have_posts()): $cat_posts->the_post();
										$postexc = get_the_excerpt();
										?>
										<?php if ($i==0): ?>
											<?php
									            if ( has_post_thumbnail() ) {
													echo '<div class="topic__img">';
													the_post_thumbnail('alpi-taxonomy-heading');
													echo '</div>';
												} else {
													echo '<div class="topic__img"><img src="';
													echo get_template_directory_uri().'/img/placeholder_880x455.jpg"></div>';
												}
									        ?>
											<div class="topic__info">
												<h1 class="topic__heading"><?php the_title(); ?></h1>
												<p class="topic__date"><?php the_time('M j, Y'); ?></p>
												<p class="topic__content"><?php echo $postexc; ?></p>
												<div class="topic__links">
													<a href="<?php echo esc_url(get_the_permalink()); ?>" class="topic__button btn">Read more
														<svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"><path fill="#ffffff" d="M7.75 6.59l-5.28 5.16a.87.87 0 0 1-1.22 0 .83.83 0 0 1 0-1.19L5.92 6 1.25 1.43a.83.83 0 0 1 0-1.19.9.9 0 0 1 1.22 0L7.75 5.4a.83.83 0 0 1 0 1.19z"/>
														</svg>
													</a>
													<ul class="share-this share-this--buttons">
														<li class="share-this__item "><a class="share-this__link share-this__link--fb" href="#">
															<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#ffffff" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"/></svg>
															Like</a>
														</li>
														<li class="share-this__item "><a class="share-this__link share-this__link--twitter" href="#">
															<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#ffffff" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"/></svg>
															Tweet</a>
														</li>
													</ul>
												</div>
											</div>
										<?php endif ?>
										<?php
										$i++;
									endwhile;
									wp_reset_postdata();
								}

							?>

						</div>
					</div>
				</section>

				<section>
					<div class="container">
						<h3>Recent content</h3>
						<div class="content__wrapper plusone" style="padding: 11px 0 10px;">
							<?php
								$i = 0;
							  	$showMore = count($cat_posts->posts) > 4;
								if ($cat_posts->have_posts()) {
									while ($cat_posts->have_posts() && $i < 4): $cat_posts->the_post();
										$postexc = get_the_excerpt();
										?>
										<?php if ($i!=0): ?>
											<article class="content__box">
												<?php
										            if ( has_post_thumbnail() ) {
														echo '<div class="content__image sa">';
														the_post_thumbnail();
														echo '</div>';
													} else {
														echo '<div class="content__image"><img src="';
														echo get_template_directory_uri().'/img/placeholder.jpg"></div>';
													}
										        ?>
												<div class="content__inner">
													<?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
													<p class="content__date"><?php the_time('M j, Y'); ?></p>
													<p class="content__text"><?php echo $postexc; ?></p>
												</div>
											</article>
										<?php endif ?>
										<?php
										$i++;
									endwhile; ?>
									<?php if ($showMore): ?>
										<button type="button" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--show-more" data-page="category"><?php _e('SHOW MORE', 'alabama-policy-institute'); ?><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--red.png" alt="" class="btn__icon" ></button>
									<?php endif ?>
									<?php
									wp_reset_postdata();
								}

							?>
						</div>

					</div>
				</section>
				<hr>
				<?php
					$terms_multimedia = get_terms('multimedia', array(
					    'hide_empty' => false,
					) );

					foreach ($terms_multimedia as $key => $value) {
						$term_list[] = $value->slug;
					}

					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'ignore_sticky_posts' => true,
						'tax_query' => array(
							array(
								'taxonomy' => 'multimedia',
								'field'    => 'slug',
								'terms'    => $term_list,
								// 'operator' => 'NOT IN',
							),
						),
					);
					$taxonomy_posts = new WP_Query( $args );
				?>
				<section >
					<div class="container">
						<h3>Multimedia</h3>
						<div class="content__wrapper">
							<?php
								if ($taxonomy_posts->have_posts()) {
									$i = 0;
									while ($taxonomy_posts->have_posts()): $taxonomy_posts->the_post();
										$postexc = get_the_excerpt();
										?>
										<?php if ($i==0): ?>
											<article class="content__box content__box--large">
												<?php
										            if(has_post_thumbnail()) {
										            	echo '<div class="content__image"
										            	style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(), 'alpi-full-width') .')"></div>';
										            } else {
										            	echo '<div class="content__image"
										            	style="background-image:url('.get_template_directory_uri().'/img/placeholder_880x455.jpg)"></div>';
										            }
										        ?>
												<div class="content__inner">
													<?php the_title( '<h1 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
													<p class="content__date"><?php the_time('M j, Y'); ?></p>
													<p class="content__text"><?php echo $postexc; ?></p>
													<div class="content__links">
														<a href="<?php echo esc_url(get_the_permalink()); ?>" class="content__button btn btn--decoration btn--dark">Read more
															<svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"><path fill="#4b515b" d="M7.75 6.59l-5.28 5.16a.87.87 0 0 1-1.22 0 .83.83 0 0 1 0-1.19L5.92 6 1.25 1.43a.83.83 0 0 1 0-1.19.9.9 0 0 1 1.22 0L7.75 5.4a.83.83 0 0 1 0 1.19z"/>
															</svg>
														</a>
														<ul class="share-this share-this--text">
															<li class="share-this__item "><a class="share-this__link share-this__link--fb" href="#">
																<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#ffffff" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"/></svg>
																Like</a>
															</li>
															<li class="share-this__item "><a class="share-this__link share-this__link--twitter" href="#">
																<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#ffffff" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"/></svg>
																Tweet</a>
															</li>
														</ul>
													</div>
												</div>
											</article>
										<?php endif ?>
										<?php if ($i!=0): ?>
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
												</div>
											</article>
										<?php endif ?>
										<?php
										$i++;
									endwhile; ?>
									<button type="button" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--show-more"><?php _e('SHOW MORE', 'alabama-policy-institute'); ?><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--red.png" alt="" class="btn__icon"></button>
									<?php
									wp_reset_postdata();
								}
							?>
						</div>

					</div>
				</section>
				<hr>
				<section>
					<div class="container">
						<div class="newsletter-contribute">
							<div class="newsletter-contribute__wrapper">
								<h3>Newsletter</h3>
								<div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Newsletter_Mailbox.png')">
									<h5>Sign up to receive weekly API updates</h5>
									<form class="form form--newsletter" action="" method="get">
										<input type="email" name="email" placeholder="your email address" class="form__input--text">
										<button type="submit" class="btn form__submit">SIGN UP</button>

									</form>
								</div>
							</div>

							<div class="newsletter-contribute__wrapper">
								<h3>Contribute</h3>
								<div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Contribute_Flag.png')">
									<h5>Help API preserve Free Markets, Limited&nbsp;Government and Strong Families.</h5>
									<div class="newsletter-contribute__buttons">
										<a href="#" class="btn newsletter-contribute__btn">$25</a>
										<a href="#" class="btn newsletter-contribute__btn">$50</a>
										<a href="#" class="btn newsletter-contribute__btn">Other</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
