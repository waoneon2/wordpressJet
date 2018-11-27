<?php
/**
 * Template Name: Homepage
 * The template for Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php $tag 		= get_term_by('id',get_theme_mod('select_tag'),'post_tag'); ?>
			<?php $tag_id 	= get_theme_mod('select_tag'); ?>
			<?php $num_post = get_theme_mod('number_post_show') ? get_theme_mod('number_post_show') : 3; ?>
			<?php $lexc = get_theme_mod('length_excerpt') ? get_theme_mod('length_excerpt') : 35; ?>
			<!-- Page Title -->
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			<?php endwhile; // End of the loop. ?>
			<!-- End Page Title -->

			<?php
			$args = array(
				'posts_per_page' => $num_post
			);

			if ($tag) {
				$args['tag_id'] = $tag_id;
			} 
			$query = new WP_Query( $args ); ?>
			<div class="sticky-post blue">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php if ( $query->have_posts() ) {
							$i = 0;
							while ( $query->have_posts() ) : $query->the_post(); ?>
								<!-- Wrapper for slides -->
								<div class="item <?php echo ($i == 0) ? 'active' : '' ?>">
									<div class="col-lg-5 col-md-5 row sticky-image">
										<?php if (has_post_thumbnail()): ?>
										 	<?php the_post_thumbnail('sticky-post'); ?>
										<?php else: ?>
											<img src="<?php echo get_template_directory_uri() . '/img/sticky-placeholder.jpg'; ?>">
										<?php endif ?>
									</div>
									<div class="col-lg-7 col-md-7 sticky-content">
										<?php the_title( '<h2>', '</h2>' ) ?>
										<?php bcbst_custom_excerpts($lexc) ?>
										<p class="viewall"><a href="<?php echo esc_url( get_permalink() ) ?>">read more</a></p>
									</div>
								</div>
							<?php $i++; endwhile; // End of the loop.
							wp_reset_postdata();
						} else {
							echo " No post ";
						} ?>
					</div>
					<!-- Indicators -->
					<?php if ($query->post_count > 1): ?>					
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<?php for ($i=1; $i < $query->post_count; $i++) { ?>
							<li data-target="#myCarousel" data-slide-to="<?php echo $i ?>"></li>
						<?php } ?>
					</ol>
					<?php endif ?>
				</div>
			</div>

			<div class="three-col-content row">
				<div class="col-md-4 tc-one border-right">
					<?php if ( is_active_sidebar( 'widget-area-left' ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'widget-area-left' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>

				<div class="col-md-4 tc-two border-right">
					<?php if ( is_active_sidebar( 'widget-area-middle' ) ) : ?>
						<div class="mobile-border"></div>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'widget-area-middle' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>

				<div class="col-md-4 tc-three ">
					<?php if ( is_active_sidebar( 'widget-area-right' ) ) : ?>
						<div class="mobile-border"></div>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'widget-area-right' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>

			</div>
			<div class="two-col-button row">
				<?php if (!get_theme_mod('tg_left_btn')): ?>
					<div class="col-md-6">
						<div class="darkblue two-button">
							<?php bcbst_homepage_button_link(get_theme_mod('ask_a_question'), get_theme_mod('ask_a_question_label'), 'ASK A QUESTION') ?>
						</div>
					</div>
				<?php endif ?>

				<?php if (!get_theme_mod('tg_right_btn')): ?>
					<div class="col-md-6">
						<div class="darkblue two-button">
							<?php bcbst_homepage_button_link(get_theme_mod('register_updates'), get_theme_mod('register_updates_label'), 'REGISTER FOR UPDATES') ?>
						</div>
					</div>
				<?php endif ?>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
