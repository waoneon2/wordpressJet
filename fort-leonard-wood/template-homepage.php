<?php
/**
 * Template Name: Homepage
 */
get_header();
$locations = get_nav_menu_locations();
if(isset($locations[ 'menu-3' ]) || !empty($locations[ 'menu-3' ])){
	$menu3_id = $locations[ 'menu-3' ];
	$menu_3 = wp_get_nav_menu_object($menu3_id);
}

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="bodyContent" class="clearfix">
			<div id="homepageContent" class="clearfix">
			<?php echo slider_image(); ?>
				<div id="contentHome" class="homepage-row row clearfix">
					<div class="col-md-7 left-area">
							<div class="row">
								<h1 class="headline"><?php echo get_theme_mod('front_category_title_4', 'Fort Leonard Wood') ?></h1>
								<?php
									$cat = get_theme_mod('front_category_dropdown_4', '');
									$args = array(
										'cat' => $cat
									);
									$query = new WP_Query( $args );
									while ( $query->have_posts() ) : $query->the_post(); ?>
										<div class="col-md-12 article-block">
											<div class="row">
													<div class="thumb">
														<a href="<?php echo esc_url(get_permalink());?>" rel="bookmark" >
															<?php
																if ( has_post_thumbnail() ) {
																	the_post_thumbnail('fl_thumb');
																}
															?>
														</a>
													</div>
													<div class="article-wrap-top">
														<h3 class="doc-head"><?php the_title() ?></h3>
														<?php the_excerpt() ?>
														<a href="<?php echo esc_url(get_permalink());?>">read more »</a>
													</div>
											</div>
										</div>

									<?php endwhile; // End of the loop.
								?>
							</div>
					</div>
					<div class="col-md-5 right-area">
						<div  id="bottomDiv_col2">
							<!--  hot topic -->
							<?php
							$hot_topic_setting = get_theme_mod('hot_topics_display_setting','show'); // Show Hide Hot topic section

							// query for latest press
							$hot_topics_cat = get_theme_mod('front_category_dropdown_3');
							$hot_topics_url = esc_url(get_category_link($hot_topics_cat));
							if ($hot_topics_cat){
								$hot_arg = array('post_type' => 'post', 'cat' => $hot_topics_cat);

								$hot_topics = new WP_Query($hot_arg); ?>
								<?php if($hot_topic_setting === 'show'): ?>
								<div class="boxHeader clearfix">
									<div class="boxHeader_box">
										<h2>Hot Topic</h2>
									</div>
									<div class="boxContent clearfix">
										<div id="featuredNews" class="divWrap clearfix">
											<ul class="us_army_rt">
													<?php
													$count_all_post = $hot_topics->post_count;
													if($hot_topics->have_posts()) :
														while($hot_topics->have_posts()) :
														$hot_topics->the_post(); ?>
														<li>
																<a href="<?php the_permalink(); ?>">
																	<?php the_title(); ?>
																</a>
														</li>
														<?php
														endwhile;
													endif;
													wp_reset_postdata();
													?>
											</ul>
										</div>
									</div>
								</div>
								<?php endif; ?>
							<?php } ?>
							<!-- end of hot topic -->
						</div>
						<div class="clearfix"></div>
						<?php include('fl_social_link.php'); ?>

						<div class="bottom-link">
							<?php for ($count=1; $count <= 2 ; $count++) { ?>
								<a href="<?php echo esc_url(get_theme_mod('bottom_link_url'.$count)) ?>">
									<img src="<?php echo get_theme_mod('bottom_link_image'.$count) ?>" target="_blank" alt="soundoff newspaper">
								</a>
							<?php } ?>
						</div>

						<div class="middle-link">
							<a href="<?php echo esc_url(get_theme_mod('middle_link_url')) ?>">
								<img src="<?php echo get_theme_mod('middle_link_image') ?>" alt="virtual press kit">
							</a>
						</div>
					</div>
				</div>
			</div> <!-- #homepageContent -->
		</div> <!-- #bodycontent -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>

