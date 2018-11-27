<?php
/**
 * Template Name: Homepage
 */
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "/path/to/default.png";
  }
  return $first_img;
}


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div class="row innerpagenavigation">
		<div class="col col_primary col-md-8 col-sm-8 col-xs-12">
			<section>
				<?php
				// new release option
					//set the title
					if (get_theme_mod('ladwp_new_release_title')){
						$new_release_title = get_theme_mod('ladwp_new_release_title');
					} else {
						$new_release_title = 'Latest News Releases';
					}
					//set the link text
					if (get_theme_mod('ladwp_new_release_link_text')){
						$new_release_link_text = get_theme_mod('ladwp_new_release_link_text');
					} else {
						$new_release_link_text = 'View All News Releases';
					}
					// set category
				    if (get_theme_mod('ladwp_new_release_category')){
				    	$new_release_cat_id = get_theme_mod('ladwp_new_release_category');
				    } else {
				    	$category_release = 'news';
					    $new_release_cat_id = get_cat_ID( $category_release );
				    }
				    $category_link = get_category_link( $new_release_cat_id );


				?>
				<div class="clearfix">
					<h2 class="pull-left"><?php echo $new_release_title;?></h2>
					<div class="pull-right more-link">
						<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $new_release_link_text;?></a>
					</div>
				</div>
				<div class="row ">
				<?php
				   $args = array('post_type' => 'post', 'cat' => $new_release_cat_id, 'posts_per_page' => '4');
				   $news = new WP_Query($args);

				   if($news->have_posts()) : 
				      while($news->have_posts()) : 
				        $news->the_post();
						// $trimtitlewidget = get_the_title();
						// $shorttitlewidget = wp_trim_words( $trimtitlewidget, $num_words = 5, $more = '… ' );
				?>
					<div class="col col-md-6 col-sm-12 col-xs-12 info-tile news-tile">
						<aside class="tile-content">
							<h4> <?php the_title();?></h4>
      						<p class="small"> <?php the_time( 'F j, Y' ); ?> </p>
							<?php echo "<p>".excerpt(25)."</p>";
								echo('<p><a href="'. get_permalink() . '" target="_blank"><i class="fa fa-chevron-circle-right"></i>' . __('Read More','ladwp') . '</a></p>');
							?>
							
						</aside>
					</div>
				<?php
				      endwhile;
				   endif;
				?>
				</div>
			</section>
			<hr class="thick">
			<section>
				<?php
				// new release option
					//set the title
					if (get_theme_mod('ladwp_new_release_title_2')){
						$new_release_title_2 = get_theme_mod('ladwp_new_release_title_2');
					} else {
						$new_release_title_2 = 'Latest News Releases';
					}
					//set the link text
					if (get_theme_mod('ladwp_new_release_link_text_2')){
						$new_release_link_text_2 = get_theme_mod('ladwp_new_release_link_text_2');
					} else {
						$new_release_link_text_2 = 'View All News Releases';
					}
					// set category
				    if (get_theme_mod('ladwp_new_release_category_2')){
				    	$new_release_cat_id_2 = get_theme_mod('ladwp_new_release_category_2');
				    } else {
				    	$category_release = 'news';
					    $new_release_cat_id_2 = get_cat_ID( $category_release );
				    }
				    $category_link_2 = get_category_link( $new_release_cat_id_2 );


				?>
				<div class="clearfix">
					<h2 class="pull-left"><?php echo $new_release_title_2;?></h2>
					<div class="pull-right more-link">
						<a href="<?php echo esc_url( $category_link_2 ); ?>"><?php echo $new_release_link_text_2;?></a>
					</div>
				</div>
				<div class="row ">
				<?php
				   $args = array('post_type' => 'post', 'cat' => $new_release_cat_id_2, 'posts_per_page' => '2');
				   $news2 = new WP_Query($args);

				   if($news2->have_posts()) : 
				      while($news2->have_posts()) : 
				        $news2->the_post();
						// $trimtitlewidget = get_the_title();
						// $shorttitlewidget = wp_trim_words( $trimtitlewidget, $num_words = 5, $more = '… ' );
				?>
					<div class="col col-md-6 col-sm-12 col-xs-12 info-tile news-tile">
						<aside class="tile-content">
							<h4> <?php the_title();?></h4>
      						<p class="small"> <?php the_time( 'F j, Y' ); ?> </p>
							<?php echo "<p>".excerpt(25)."</p>";
								echo('<p><a href="'. get_permalink() . '" target="_blank"><i class="fa fa-chevron-circle-right"></i>' . __('Read More','ladwp') . '</a></p>');
							?>
							
						</aside>
					</div>
				<?php
				      endwhile;
				   endif;
				?>
				</div>
			</section>
			<hr class="thick">
			<section>
				<div class="clearfix">
					<h2>Latest Video</h2>
				</div>
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12 info-tile tile-type-video">
						<?php
							wp_reset_query();
						   $args_mul = array(
						   		'post_type' => 'post',
						   		);
						   $multimedia = new WP_Query($args_mul);
						   $count=0;
						   if($multimedia->have_posts()) : 
						      while($multimedia->have_posts()) : 
						         $multimedia->the_post();
						     	if ( has_post_format( 'video' ) && $count == 0) {
						     		$count=1;
						?>
							<div class="tile-img-container">
								<a href="<?php echo get_permalink();?>">
									<?php 
									if (has_post_thumbnail()){
										the_post_thumbnail(array('640','252'));
										echo '<img src="'.get_template_directory_uri().'/img/play_video.png" alt="Play Video" class="play-video">';
									} else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder-thumb-xl.jpg">
										<img src="<?php echo get_template_directory_uri(); ?>/img/play_video.png" alt="Play Video" class="play-video">
									<?php } ?>
								</a>
							</div>
							<section class="tile-content tile-top-2">
								<h4><?php the_title();?></h4>
								<?php the_excerpt();?>
								<a href="<?php echo get_post_format_link('video'); ?>"><i class="fa fa-chevron-circle-right"></i> View all videos</a>
							</section>
						<?php
								}
						      endwhile;
						   endif;
						?>
					</div>
				</div>
			</section>
		</div>
		<div class="col col-aside-right col-md-4 col-sm-4 col-xs-12">
		<?php get_sidebar(); ?>
		</div>
	</div>
<?php

get_footer();
