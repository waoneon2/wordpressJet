<?php
/**
 * Template Name: Homepage
 */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="bodyContent" class="clearfix">
			<div class="headline_wrapper">
			    <h1 class="headline"><?php the_title();?></h1>
			</div>
			<div id="homepageContent" class="clearfix">
				<div id="topDiv" class="homepage-row row clearfix">
					<div id="topDiv_col1" class=" col-md-6 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>Get the Latest Updates</h2>
							</div>
						</div>
						<div class="boxContent clearfix">
							<?php
							$menu_id_latest = get_theme_mod('us_army_get_latest_menu');
							function us_army_menus_latest($id_of_menu) {
								$array_menu = wp_get_nav_menu_items($id_of_menu);
								if(!empty($array_menu)){
									$menu = array();
									foreach ($array_menu as $m) {
										if (empty($m->menu_item_parent)) {
											$menu[$m->ID] = array();
											$menu[$m->ID]['ID']      		=   $m->ID;
											$menu[$m->ID]['title']       	=   $m->title;
											$menu[$m->ID]['url']         	=   $m->url;
											$menu[$m->ID]['children']    	=   array();
										  }
									  }
									  $submenu = array();
									  foreach ($array_menu as $m) {
										  if ($m->menu_item_parent) {
											  $submenu[$m->ID] = array();
											  $submenu[$m->ID]['ID']       =   $m->ID;
											  $submenu[$m->ID]['title']    =   $m->title;
											  $submenu[$m->ID]['url']  =   $m->url;
											  $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
										  }
									  }
									  return $menu;
								} else {
									return false;
								}
								
							 }

							$html_a = '';
							if($menu_id_latest){
								foreach (us_army_menus_latest($menu_id_latest) as $key => $value) {
									if(!empty($value) && !empty($value['title'])){
										if($value['title']){
											$html_a .= '<a id="'.$value['ID'].'-'.str_replace(' ', '-', strtolower($value['title'])).'" href="'.$value['url'].'" class="latest_update">'.$value['title'].'</a>';
										}
									}
								}
							}
							echo '<div class="divWrap clearfix">';
							echo $html_a;
							echo '</div>';
							?>
						</div>
					</div>
					<div id="topDiv_col2" class=" col-md-6 midDiv_col clearfix">
						<?php
						$hot_topic_setting = get_theme_mod('hot_topics_display_setting','show'); // Show Hide Hot topic section
						$hot_topics = "";
						$hot_topic_url_boolean = false;
						$count_all_post = 0;

						// query for latest press
						$hot_topics_cat = get_theme_mod('front_category_dropdown_3');
						if($hot_topics_cat){
							$hot_topics_url = esc_url(get_category_link($hot_topics_cat));
							$hot_topic_url_boolean = true;
						}
						
						if ($hot_topics_cat){
							$hot_arg = array('post_type' => 'post', 'cat' => $hot_topics_cat);
							$hot_topics = new WP_Query($hot_arg);
						}
		  				
						 ?>
						<?php if($hot_topic_setting === 'show'): ?>
						<div id="hotTopics" class="Hot Topics">
							<div class="ht-head">
								<h2 class="">
								<?php 
									if($hot_topic_url_boolean){
								?>
									<a href="<?php echo $hot_topics_url;?>" target="_blank"><?php _e("Hot Topics","us-army"); ?></a>
								<?php
									} else {
								?>
									<a href="#" target="_blank"><?php _e("Hot Topics","us-army"); ?></a>
								<?php
									}
								?>
									
								</h2>
							</div>
								<ul class="ht-body clearfix cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-carousel-vertical="false" data-cycle-slides="li" data-cycle-speed="500" data-cycle-log=false data-cycle-pause-on-hover="true">
								<?php
								if(!empty($hot_topics)){
									$count_all_post = $hot_topics->post_count;
									if($hot_topics->have_posts()) :

										while($hot_topics->have_posts()) :
										$hot_topics->the_post();
									?>
										<li class="documentInfo_wrapperr item">
											<div class="documentInfo">
												<span class="date"> <?php the_time('F j, Y');?></span>
												<a href="<?php the_permalink(); ?>">
													<span class="headline"><?php the_title(); ?></span>
												</a>
											</div>
										</li>
									<?php
										endwhile;
									endif;
									wp_reset_postdata();
								}
								 ?>
								</ul>
							<!-- Counter -->
							<div id="counter">[<span id="counterIndex">&nbsp;</span>/<?php echo $count_all_post; ?>]</div>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div id="midDiv" class="homepage-row row clearfix">
					<div id="midDiv_col1" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>
									<?php
									if(get_theme_mod('front_category_title_1')) {
										echo get_theme_mod('front_category_title_1');
									} else { echo 'Latest Press Release'; }	?>
								</h2>
							</div>
						</div>
						<?php
							// query for latest press
							$latest_press_cat = get_theme_mod('front_category_dropdown_1');
							$latest_press = "";
							if ($latest_press_cat){
								$latest_arg = array('post_type' => 'post', 'cat' => $latest_press_cat, 'posts_per_page' => 1);
								$latest_press = new WP_Query($latest_arg);
							}
						?>
						<div class="boxContent clearfix">
							<div class="divWrap clearfix">
							<?php
							if(!empty($latest_press)){
								if($latest_press->have_posts()) :
									while($latest_press->have_posts()) :
									$latest_press->the_post();
								?>
									<div class="documentInfo">
										<span class="date"> <?php the_time('F j, Y');?> </span>
										<a href="<?php the_permalink(); ?>"><span class="headline"> <?php the_title(); ?> </span></a>
									</div>
									<div class="description">
										<?php the_content(); ?>
									</div>
								<?php
									endwhile;
								endif;
								wp_reset_query();
							}
							 ?>
							</div>
						</div>
					</div>
					<div id="midDiv_col2" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>
									<?php
									if(get_theme_mod('front_category_title_2')) {
										echo get_theme_mod('front_category_title_2');
									} else { echo 'Past Press Release'; }	?>
								</h2>
							</div>
						</div>
						<?php
						$past_press_cat = get_theme_mod('front_category_dropdown_2');
						$past_press = "";
						if ($past_press_cat){
							$past_arg = array('post_type' => 'post', 'cat' => $past_press_cat);
							$past_press = new WP_Query($past_arg);
						}
		  				
						 ?>
						<div class="boxContent clearfix">
							<div  class="divWrap clearfix">
								<ul class="injectedDocumentList clearfix">
								<?php
								if(!empty($past_press)){
									if($past_press->have_posts()) :
										while($past_press->have_posts()) :
										$past_press->the_post();
											?>
										<li class="documentInfo_wrapper">
											<div class="documentInfo">
												<span class="date"><?php the_time('F j, Y');?></span>
												<a href="<?php the_permalink(); ?>">
													<span class="headline"><?php the_title(); ?></span>
												</a>
											</div>
										</li>
									<?php
										endwhile;
									endif;
									wp_reset_query();
								}
								?>
								</ul>
							</div>
						</div>
					</div>
					<div id="midDiv_col3" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>
									<?php
									if(get_theme_mod('front_category_title_6')) {
										echo get_theme_mod('front_category_title_6');
									} else { echo 'Fort Hood Orientation Video'; }	?>
								</h2>
							</div>
						</div>
						<?php
						$or_vid_url = get_theme_mod('video_orentation_file');
						$or_vid_thumb = get_theme_mod('video_orentation_thumbnail');
						 ?>
						<div class="boxContent clearfix">
							<div class="divWrap clearfix">
							<?php
								if ($or_vid_url){
									$vid_url = esc_url($or_vid_url);
									if ($or_vid_thumb){
										$vid_thumb = esc_url($or_vid_thumb);
									} else {
										$vid_thumb = get_bloginfo('template_directory').'/img/placeholder_video.png';
									}
									printf('<a href="%s" target="_blank"><img src="%s"></a>',$vid_url,$vid_thumb);
								} else {
									echo '<span>No Video found!</span>';
								}
							 ?>
							</div>
						</div>
					</div>
				</div>

				<div id="bottomDiv" class="homepage-row row clearfix">
					<div id="bottomDiv_col1" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>
									<?php
									if(get_theme_mod('front_category_title_4')) {
										echo get_theme_mod('front_category_title_4');
									} else { echo 'Fort Hood Sentinel Headlines'; }	?>
								</h2>
							</div>
						</div>
						<?php
						$headlines_cat = get_theme_mod('front_category_dropdown_4');
						$headlines = "";
						if ($headlines_cat){
							$headline_arg = array('post_type' => 'post', 'cat' => $headlines_cat);
							$headlines = new WP_Query($headline_arg);
						}
		  				
						 ?>
						<div class="boxContent clearfix">
							<div class="divWrap clearfix">
								<table class="injectedDocumentList clearfix">
								<?php
								if(!empty($headlines)){
									if($headlines->have_posts()) :
										while($headlines->have_posts()) :
										$headlines->the_post();
											?>
										<tr class="documentInfo_wrapper">
											<td class="headline-image">
												<a href="<?php the_permalink(); ?>">
													<?php
												if ( has_post_thumbnail() ) {
													echo '<div class="img-headline">';
													the_post_thumbnail('us_army_thumbnail');
													echo '</div>';
												} else {
													echo '<div class="img-headline"><img src="';
													echo get_bloginfo('template_directory').'/img/placeholder.png"></div>';
												}

													?>
												</a>
											</td>
											<td class="headline-title">
												<a href="<?php the_permalink(); ?>">
													<h5><?php the_title(); ?></h5>
												</a>
											</td>
										</tr>
									<?php
										endwhile;
									endif;
									wp_reset_query();
								}
								?>
								</table>
							</div>
						</div>
					</div>
					<div id="bottomDiv_col2" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>
									<?php
									if(get_theme_mod('front_category_title_5')) {
										echo get_theme_mod('front_category_title_5');
									} else { echo 'Reporters Toolbox'; }	?>
								</h2>
							</div>
						</div>
						<div class="boxContent clearfix">
							<div id="featuredNews" class="divWrap clearfix">
								<?php
									if(get_theme_mod('us_army_menus_list')):
								    	$val_term_menu = get_theme_mod('us_army_menus_list');

								    	function us_army_menus_array($id_of_menu) {
											$array_menu = wp_get_nav_menu_items($id_of_menu);
											$menu = array();
											foreach ($array_menu as $m) {
										    	if (empty($m->menu_item_parent)) {
										        	$menu[$m->ID] = array();
										        	$menu[$m->ID]['ID']      	=   $m->ID;
										        	$menu[$m->ID]['title']      =   $m->title;
										        	$menu[$m->ID]['url']        =   $m->url;
										        	$menu[$m->ID]['children']   =   array();
										        }
										      }
										      $submenu = array();
										      foreach ($array_menu as $m) {
										          if ($m->menu_item_parent) {
										              $submenu[$m->ID] = array();
										              $submenu[$m->ID]['ID']    =   $m->ID;
										              $submenu[$m->ID]['title'] =   $m->title;
										              $submenu[$m->ID]['url']  	=   $m->url;
										              $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
										          }
										      }
										      return $menu;

										  }

										function render_of_ul_li($content_of_li){
											$html_ul_list = '';
											$html_ul_list .= '<ul class="us_army_rt">';
											$html_ul_list .= $content_of_li;
											$html_ul_list .= '</ul>';
											return $html_ul_list;
										}

									$html_li_list = '';
									$html_child_li_list = '';

									foreach (us_army_menus_array($val_term_menu) as $key => $value) {
										if (!empty($value['title'])){
											$html_li_list .= '<li>';
											$html_li_list .= '<a href="'.$value['url'].'" target="_blank">'.$value['title'].'</a>';
											$html_li_list .= '</li>';
										}
									}



									echo render_of_ul_li($html_li_list);
								 endif;  ?>
							</div>
						</div>
					</div>
					<div id="bottomDiv_col3" class="col-md-4 midDiv_col clearfix">
						<div class="boxHeader clearfix">
							<div class="boxHeader_box">
								<h2>Fort Hood Social Media</h2>
							</div>
						</div>
						<div id="socialWidget" class="boxContent clearfix">
							<div class="asmheader">
								<?php
								//print social link
								function get_social_link($type){
									$sc_link = get_theme_mod('social_media_link_'.$type);
									$link = esc_url($sc_link);
									if ($sc_link){
										printf('<a title="%s" class="%s current" href="%s" target="_blank">',$type,$type,$link);
										echo '<img src="';
										echo bloginfo('template_directory').'/img/social/'.$type.'.png">';
										echo '<span>'.$type.'</span></a>';
									}
								}
								get_social_link('facebook');
								get_social_link('twitter');
								get_social_link('youtube');
								get_social_link('flickr');
								?>
								<a class="asmtext" href="http://www.army.mil/media/socialmedia/" target="_blank">All Army Social Media</a>
							</div>
							<div class="divWrap external-link-wrap clearfix">
								<?php
									//print external link
									$ex_link = get_theme_mod('ex_web_link');
									echo $ex_link;
								 ?>
							</div>
						</div>
					</div>
				</div>

			</div> <!-- #homepageContent -->
		</div> <!-- #bodycontent -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
