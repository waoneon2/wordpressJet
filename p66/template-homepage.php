<?php
/**
 * Template Name: Homepage
 */
get_header();

// Customizer data
$feature = get_theme_mod('homepage_feature_cat');
$news = get_theme_mod('homepage_news_release');
$promo = array();
for ($i=1; $i <=3 ; $i++) {
	$promo[$i]=get_theme_mod('homepage_promo_'.$i);
	$promobtn[$i]=get_theme_mod('homepage_promo_button'.$i);
}


$hero = array();
for ($y=1; $y <=4 ; $y++) {
	$hero[$y]=get_theme_mod('homepage_hero_cat_'.$y);
}
?>

	<div id="primary" class="content-area homepage">
		<main id="main" class="site-main" role="main">

		<?php if ($hero) : ?>
			<div class="hero">
				<div class="section-top-m section-bottom-m">
				  <div class="row orange-test">
				      <!-- Wrapper for slides -->
					    <div class="carousel-inner slider-component">
					    	<!-- slide item -->
					    	<?php
					    	$hero_args = array(
							    'cat'  => $hero,
							    'posts_per_page' => 10,
							    'orderby' => 'date',
							    'order'   => 'DESC'
							);
							$quhero = new WP_Query( $hero_args );

							if ( $quhero->have_posts() ) :
								while ( $quhero->have_posts() ) :
									$quhero->the_post();

								//choose type of hero by category
								$categories = get_the_category();
								// var_dump($categories);
								$maincat = esc_html($categories[0]->term_id);
								// echo $maincat;
								switch ($maincat) {
									case $hero[1]:
										$hero_type = 'fully-shaded';
										$text_hero = 'white';
										$hero_col = array(1=>'col-lg-3 col-md-2 col-sm-2',2=>'col-lg-3 col-md-2 col-sm-2');
										break;
									case $hero[2]:
										$hero_type = 'fully-shaded-red';
										$text_hero = 'white';
										$hero_col = array(1=>'col-lg-3 col-md-2 col-sm-2',2=>'col-lg-3 col-md-2 col-sm-2');
										break;
									case $hero[3]:
										$hero_type = 'left-dark-gradient';
										$text_hero = 'white';
										$hero_col = array(1=>'col-lg-1 col-md-1 col-sm-1',2=>'col-lg-5 col-md-3 col-sm-4');
										break;
									case $hero[4]:
										$hero_type = 'left-white-gradient';
										$text_hero = 'black';
										$hero_col = array(1=>'col-lg-1 col-md-1 col-sm-1',2=>'col-lg-5 col-md-3 col-sm-4');
										break;
									default:
										$hero_type = '';
										$text_hero = '';
										$hero_col = array(1 => '',2=>'');
										break;
								}

					    	 ?>
					          <div class="promo-full-width orange-test">
					            <div class="slick-img-wrap">

					               <img src="<?php echo (has_post_thumbnail()) ? the_post_thumbnail_url('promo-full-width') : get_template_directory_uri().'/img/1280x560-placeholder.jpg'; ?>">
					            </div>
					            <div class="row carousel-content-row <?php echo $hero_type; ?>">
					                <div class="<?php echo $hero_col[1]; ?>"></div>
					                <div class="col-lg-6 col-md-8 col-sm-7 hidden-xs desktop-content">
					                    <h1 class="<?php echo $text_hero; ?>"><?php the_title(); ?></h1>
					                    <div>
					                      <div class="<?php echo $text_hero; ?> exc"><?php p66_custom_excerpts(); ?></div>
					                      <a href="<?php the_permalink(); ?>" class="btn btn-primary">get to know us</a>
					                    </div>
					                </div>
					                <div class="<?php echo $hero_col[2]; ?>"></div>
					            </div>
					             <div class="mobile-content visible-xs">
					                <div class="center">
					                  <h1 class="<?php echo $text_hero; ?>"><?php the_title(); ?></h1>
					                  <div class="<?php echo $text_hero; ?> exc">
					                    <p ><?php p66_custom_excerpts(); ?></p>

					                  </div>
					                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">get to know us</a>
					                </div>
					             </div>
					          </div>
					          <?php
								endwhile;
								wp_reset_postdata();
							endif;
					           ?>
					    </div>
				  	</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="row">
			<?php if ($feature) : ?>
				<div class="promo-3-col orange-test">
				  <div class="row">
				    <h2 id="featureStories" class="centered">feature stories</h2>


				    <a href="<?php echo esc_url(get_category_link($feature)); ?>" class="feature view-all">View all</a>
				  </div>
				  <div class="row">
				  	<?php
					  	$feature_args = array(
						    'cat'  => $feature,
						    'posts_per_page' => 3
						);
						$qufeature = new WP_Query( $feature_args );

						if ( $qufeature->have_posts() ) :
							while ( $qufeature->have_posts() ) :
								$qufeature->the_post();
				    ?>
						    <div class="col-lg-4">
						      <img class="img-circle" src="<?php echo (has_post_thumbnail()) ? the_post_thumbnail_url() : get_template_directory_uri().'/img/405x250-placeholder.jpg'; ?>" alt="" width="140" height="140">
						      <a href="<?php the_permalink(); ?>" class="content-box">
						        <h3><?php the_title() ?></h3>
						        <?php p66_custom_excerpts(); ?>
						      </a>
						    </div><!-- /.col-lg-4 -->
					<?php
						endwhile;
						wp_reset_postdata();
					endif;
					 ?>
				  </div>
				  <div class="row">
				    <a href="#featureStories" class="feature btn-load-more btn-tertiary">Load more feature stories</a>
				  </div>

<!-- 				  <div class="row">
				    <a href="examplepage.html?page=feature-stories-view-all" class="view-all-full-width btn-tertiary">View all</a>
				  </div> -->
				</div><!-- /.row -->
			<?php endif; ?>

			<?php
			$promotes = new WP_Query(array('post__in' => array_values($promo), 'post_type' => 'page'));
			$_promotes = $promotes->posts;
			for ($i = 1; $i <= 3; $i++) {
				$post = p66_array_first($_promotes, function ($item) use ($promo, $i) {
					return $item->ID == $promo[$i];
				});
				if (!$post) continue;
				$postexc = $post->post_excerpt;
				$btntext = ($promobtn[$i]) ? $promobtn[$i] : 'Detail';
				?>
				<div class="promo-full-width section-top-m section-bottom-m orange-test promo-home">
				  <img src="<?php echo (get_the_post_thumbnail_url($post, 'promo-full-width')) ? get_the_post_thumbnail_url($post, 'promo-full-width') : get_template_directory_uri().'/img/1280x560-placeholder.jpg'; ?>">

				  <div class="row promo-full-width-row">
				  	<?php
				  		if ($i == 2) {
				  			echo '<div class="col-sm-push-1 col-lg-8 col-md-8 col-sm-7 hidden-xs desktop-content">';
				  		} else {
				  			echo '<div class="col-lg-push-6 col-md-push-6 col-sm-push-5 col-lg-5 col-md-5 col-sm-6 hidden-xs desktop-content text-right">';
				  		}
				  	?>

				       <h1 class="white"><?php echo get_the_title($post); ?></h1>
				       <?php echo ($postexc) ? '<div class="white"><p>'.$postexc.'</p></div>':''; ?>
				       <a href="<?php echo get_the_permalink($post); ?>" class="btn btn-primary"><div><?php echo $btntext; ?></div></a>
				   </div>
				   <div class="col-lg-3 col-md-3 col-sm-3"></div>
				 </div>
				 <div class="mobile-content visible-xs">
				 		<div class="center">
						<h1 class="white"><?php echo get_the_title($post); ?></h1>
					       <div>
						       <p class="white"><?php echo $postexc; ?></p>
						       <a href="<?php echo get_the_permalink($post); ?>" class="btn btn-primary"><div><?php echo $btntext; ?></div></a>
					       </div>
					    </div>
				 </div>
				</div>
				<?php
			}
			if ($news) : ?>
				<div class="news-releases orange-test">
				  <div class="row">
				    <h2 id="newsReleases" class="centered">News Releases</h2>
				    <a href="<?php echo esc_url(get_category_link($news)); ?>" class="news view-all">View all</a>
				  </div>
				  <div class="row">
					<?php
			    	$news_args = array(
					    'cat'  => $news,
					    'posts_per_page' => 4
					);
					$qunews = new WP_Query( $news_args );

					if ( $qunews->have_posts() ) :
						while ( $qunews->have_posts() ) :
							$qunews->the_post();
						?>
					    <div class="col-lg-3 col-sm-3 col-xs-12">
					      <a href="<?php the_permalink();?>" class="content-box">
					        <span class="release-date"><?php the_time('F j, Y'); ?></span>
					        <span class="news-icon">news</span>
					        <h3><?php the_title();?></h3>
					      </a>
					    </div><!-- /.col-lg-3 -->
						<?php
						endwhile;
						wp_reset_postdata();
					endif;
					 ?>
				  </div>
				  <div class="row">
				    <a href="#newsReleases" class="news btn-load-more btn-tertiary">load more news releases</a>
				  </div>
<!-- 				  <div class="row">
				    <a href="#newsPage" class="view-all-full-width btn-tertiary">view all</a>
				  </div> -->
				</div><!-- /.row -->
			<?php endif; ?>

		</div><!--  row -->
		</main><!-- #main -->
	</div><!-- #primary -->


<?php

get_footer();

