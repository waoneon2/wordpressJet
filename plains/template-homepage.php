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

			<!-- SLIDER SECTION -->
			<div id="homepage-slider" class="row">
			<?php
				$sticky = get_option('sticky_posts');
				if (!empty($sticky)) {
					rsort($sticky);
					$args = array(
						'posts_per_page'   => 1,
					    'post__in' => $sticky,
					    'ignore_sticky_posts' => 1
					);
					$query = new WP_Query( $args );
					query_posts($args);
			?>
				<div class="col-md-8">
				 <?php if (get_theme_mod( 'plains_his' )) : ?>
			     <?php
			        $get_plains_image_slider = get_theme_mod('plains_his');
			        $count_img_slider = count($get_plains_image_slider);
			        $make_arr   = array();
			        $get_arr    = array();
			        $count_up   = 0;
			        foreach ($get_plains_image_slider as $key => $value) {
			            if ($value !== "") :
			                $make_arr[$count_up] = array(
			                    'large_img' => $value,
			                    'idloop' => $key
			                );
			                $count_up++;
			            endif;
			        }
			        $get_arr["data"] = $make_arr;
			        $convert_json = json_encode($get_arr, JSON_PRETTY_PRINT);
			        $decode_data = json_decode($convert_json, true);
			        ?>
					<div class="cycle-slideshow home-slides">
			        <div class="cycle-slideshow" id="plains-img-slider" data-cycle-swipe="true" data-cycle-swipe-fx="scrollHorz" data-cycle-fx="fadeout" data-cycle-timeout="5000" data-cycle-pause-on-hover="true" data-cycle-auto-height="calc" data-cycle-caption-plugin="caption2" data-cycle-overlay-fx-out="fadeOut" data-cycle-overlay-fx-in="fadeIn" data-cycle-log=false>
			        <div class="cycle-prev glyphicon glyphicon-arrow-left"></div>
			        <div class="cycle-next glyphicon glyphicon-arrow-right"></div>
			                <?php
			                foreach ($decode_data["data"] as $key => $value) {
			                ?>
			                    <img id="slider-<?php echo $key; ?>" class="header-images img-responsive" src="<?php echo $value["large_img"]; ?>" data-cycle-title="<?php echo basename($value["large_img"]); ?>" data-cycle-desc="">
			                <?php
			                }
			                ?>
			            </div></div>
			        <?php endif; ?>
				</div>
				<div class="col-md-4 main-text">

				      <?php
				      if(get_theme_mod('plains_setting_sticky_dropdown')):
				      	$id_post = get_theme_mod('plains_setting_sticky_dropdown');
				      	if(is_sticky($id_post)):
				      		$get_post_of_sticky = get_post($id_post);
							$pst = $get_post_of_sticky->post_content;
							$sticky_title = $get_post_of_sticky->post_title;
							$cut_pst = wp_trim_words( $pst, 75, '-...' );
							$cut_sticky_title = wp_trim_words( $sticky_title, 5, '' );
							echo '<h3 class="doc-head">'.$cut_sticky_title.'</h3>';
							echo '<p>'.$cut_pst.'</p>';
							echo button_read_more($id_post);
				      		else :
				      			while (have_posts()) {
							         the_post();
							         echo '<h3 class="doc-head">'.wp_trim_words( get_the_title(), 5, '' ).'</h3>';
							         echo '<p>'.wp_trim_words( get_the_content(), 75, '-...' ).'</p>';
							         echo '<p><a class="btn btn-default" href="'.esc_url(get_permalink()).'">Read More »</a></p>';
							    }
				      	endif;
				      	else :
				      		while (have_posts()) {
					         the_post();
					         echo '<h3 class="doc-head">'.wp_trim_words( get_the_title(), 5, '' ).'</h3>';
					         echo '<p>'.wp_trim_words( get_the_content(), 75, '-...' ).'</p>';
					         echo '<p><a class="btn btn-default" href="'.esc_url(get_permalink()).'">Read More »</a></p>';
					    	}
				      endif;

				      ?>

				</div>
				<?php
				} else {
				?>
				<div class="col-md-12">
				 <?php if (get_theme_mod( 'plains_his' )) : ?>
			     <?php
			        $get_plains_image_slider = get_theme_mod('plains_his');
			        $count_img_slider = count($get_plains_image_slider);
			        $make_arr   = array();
			        $get_arr    = array();
			        $count_up   = 0;
			        foreach ($get_plains_image_slider as $key => $value) {
			            if ($value !== "") :
			                $make_arr[$count_up] = array(
			                    'large_img' => $value,
			                    'idloop' => $key
			                );
			                $count_up++;
			            endif;
			        }
			        $get_arr["data"] = $make_arr;
			        $convert_json = json_encode($get_arr, JSON_PRETTY_PRINT);
			        $decode_data = json_decode($convert_json, true);
			        ?>
					<div class="cycle-slideshow home-slides">
			        <div class="cycle-slideshow" id="plains-img-slider" data-cycle-swipe="true" data-cycle-swipe-fx="scrollHorz" data-cycle-fx="fadeout" data-cycle-timeout="5000" data-cycle-pause-on-hover="true" data-cycle-auto-height="calc" data-cycle-caption-plugin="caption2" data-cycle-overlay-fx-out="fadeOut" data-cycle-overlay-fx-in="fadeIn" data-cycle-log=false>
			        <div class="cycle-prev glyphicon glyphicon-arrow-left"></div>
			        <div class="cycle-next glyphicon glyphicon-arrow-right"></div>
			                <?php
			                foreach ($decode_data["data"] as $key => $value) {
			                ?>
			                    <img id="slider-<?php echo $key; ?>" class="header-images img-responsive" src="<?php echo $value["large_img"]; ?>" data-cycle-title="<?php echo basename($value["large_img"]); ?>" data-cycle-desc="">
			                <?php
			                }
			                ?>
			            </div></div>
			        <?php endif; ?>
				</div>
				<?php
				}
				?>
			</div>
			<!-- END SLIDER SECTION -->

			<!-- BUTTON SECTION -->
			<div class="row hidden-md hidden-lg hidden-xl">
			<?php 
				$get_text_one = get_theme_mod('header_button_one_setting_text');
				$get_link_one = get_theme_mod('header_button_one_setting_link');
				$get_text_two = get_theme_mod('header_button_two_setting_text');
				$get_link_two = get_theme_mod('header_button_two_setting_link');

				$span_for_button = array();
				$span_for_button['one'] = '<span class="fa fa-chevron-right"></span>';
				$span_for_button['two'] = '<span class="fa fa-chevron-right"></span>';
				$default_text_one = 'Ask a Question';
				$default_text_two = 'Claims Information';

				$default_link_one = esc_url('jettyapp.com');
				$default_link_two = esc_url('jettyapp.com');

				if($get_text_one):
					$default_text_one = $get_text_one;
						endif;
				if($get_text_two):
					$default_text_two = $get_text_two;
						endif;
				if($get_link_one):
					$default_link_one = esc_url($get_link_one);
					endif;
				if($get_text_two):
					$default_link_two = esc_url($get_link_two);
					endif;
			?>
				<a href="<?php echo $default_link_one; ?>" class="btn btn-primary btn-lg btn-block no-radius"><?php echo $default_text_one.' '.$span_for_button['one']; ?></a>
				<a href="<?php echo $default_link_two; ?>" class="btn btn-danger btn-lg btn-block no-radius"><?php echo $default_text_two.' '.$span_for_button['two']; ?></a>
			</div>
			<!-- END BUTTON SECTION -->

			<!-- FILE CLAIM SECTION -->
			<?php 
				$middle_title = "";
				$middle_content = "";
				$middle_image = "";
				$middle_link = "";
				$middle_text_link = "";

				if(get_theme_mod('plains_title_middle_setting_sections')):
					$middle_title = get_theme_mod('plains_title_middle_setting_sections');
					endif;
				if(get_theme_mod('plains_content_middle_setting_sections')):
					$middle_content = get_theme_mod('plains_content_middle_setting_sections');
					endif;
				if(get_theme_mod('plains_link_middle_setting_sections')):
					$middle_link = get_theme_mod('plains_link_middle_setting_sections');
					endif;
				if(get_theme_mod('plains_text_link_middle_setting_sections')):
					$middle_text_link = get_theme_mod('plains_text_link_middle_setting_sections');
					endif;
				if(get_theme_mod('plains_image_middle_setting_sections')):
					$middle_image = get_theme_mod('plains_image_middle_setting_sections');
					endif;
				?>
				<div id="file-claim" class="row hidden-xs">
					<div class="col-md-12">
						<div class="alert clearfix">
							<div class="alert-info">
								<div class="alert-text pull-left">
								<?php if(!empty($middle_title)) : ?>
									<h4 class="alert-head"><strong><?php echo $middle_title; ?></strong></h4>
								<?php endif; ?>

								<?php if(!empty($middle_content)): ?>
									<p><?php echo $middle_content; ?></p>
								<?php endif; ?>

								<?php if(!empty($middle_text_link)): ?>
									<?php 
									if(!empty($middle_link)):
										echo button_middle_learn_more($middle_link, $middle_text_link);
										else:
											echo button_middle_learn_more($middle_link, "Learn More »");
											endif;
									?>
								<?php endif; ?>

								</div>
								<?php
								if (!empty($middle_image)):
									$image = $middle_image;
								?>
								<div class="alert-img pull-right" style="background-image: url(<?php echo $image; ?>)"></div>
								<?php
								else:
									?>
								<div class="alert-img pull-right"></div>
								<?php
								endif;
								?>

							</div>
						</div>
					</div>
				</div>
				<!-- END FILE CLAIM SECTION -->

			<!-- HOME CATEGORY SECTION -->
			<div  id="home-category" class="row">
				<?php
					for ($t=1; $t < 4; $t++) {
						if (get_theme_mod('front_category_dropdown_'.$t)) {
							$cat_id = get_theme_mod('front_category_dropdown_'.$t);
							$cat_name = get_cat_name( $cat_id );
								if (get_theme_mod('front_category_title_'.$t)){
									$front_cat_title= get_theme_mod('front_category_title_'.$t);
								} else {
									$front_cat_title= $cat_name;
								}
							$cat_link = get_category_link( $cat_id );

							$front_short_title = wp_trim_words( $front_cat_title, $num_words = 5, $more = '… ' );
							echo '<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">';
							printf('<h2 class="box-cat-title">%s</h2>',$front_short_title);
							if(get_theme_mod('category_view_all_link_'.$t)){
								$cat_link = get_theme_mod('category_view_all_link_'.$t);
							}
							printf('<div class="view-more-btn clearfix"><a href="%s">view all »</a></div>',esc_url($cat_link));
							echo '<div class="list-group"><div class="list-wrap">';

							$args = array('post_type' => array('attachment','post'), 'cat' => $cat_id, 'post_status' => array('inherit','publish'));
			  				$category_list = new WP_Query($args);
								if ( $category_list->have_posts() ) {
									while ( $category_list->have_posts() ) {
										$category_list->the_post();
											$post_link 		= get_permalink();
											$post_title 	= get_the_title();
											echo '<div class="list-group-item"><article>';
											echo '<small class="doc-date">';
											the_time( 'F j, Y' );
											echo '</small>';
											printf('<a href="%s"><h4 class="list-group-item-heading">%s</h4></a>',$post_link,$post_title);
											echo '</article></div>';
									}
									wp_reset_postdata();
								}
							echo '</div></div></div>';
						}
					}
				?>

			</div>
			<!-- END HOME CATEGORY SECTION -->

			<!-- BOX LINK NAV SECTION -->
			<div id="box-link-wrap" class="row">
				<?php
				if ( has_nav_menu( 'menu-3' ) ) {
				  wp_nav_menu( array(
				  'theme_location' => 'menu-3',
				  'menu_id' => 'box-link-nav',
				  'menu_class' => 'box-link-wrap-class',
				  'walker' => new plains_walker_nav_menu_link()));
				} else {
				  esc_html_e( 'Box Link Navigation', 'plains' );
				}?>
			</div>
			<!-- END BOX LINK NAV SECTION -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

