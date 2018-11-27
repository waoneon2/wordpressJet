<?php
/**
 * Template Name: Homepage
 */
get_header();

$locations = get_nav_menu_locations();
if(!empty($locations['menu-3']) || isset($locations['menu-3'])){
	$menu3_id = $locations[ 'menu-3' ];
	$menu_3 = wp_get_nav_menu_object($menu3_id);
}

if(!empty($locations['menu-4']) || isset($locations['menu-4'])){
	$menu4_id = $locations[ 'menu-4' ];
	$menu_4 = wp_get_nav_menu_object($menu4_id);
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

			<!-- Column 1 -->
			<div class="col-md-3 col-sm-3 hidden-xs">
				<div class="hide-date quick-btns">
					<?php
					if ( has_nav_menu( 'menu-3' ) ) {
						_e( '<h3>'.$menu_3->name.'</h3>', 'nasa_jsc' );
						wp_nav_menu( array(
						'theme_location' => 'menu-3',
						'menu_class' => 'a-info nav navbar-nav',
						/*	*/) );
					} ?>
				</div>
<!--
				<div class="weather-widget">
					<div id="weather"><p>Could not retrieve weather due to an invalid location.</p></div>
				</div>
-->
				
				<?php 
				if ( is_active_sidebar( 'home_left_1' ) ) : 
				?>
					<div id="weather" class="primary-sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'home_left_1' ); ?>
					</div><!-- #primary-sidebar -->
				<?php 
				endif; 
				?>				
				
				<div class="hide-date related-links">
					<?php
					if ( has_nav_menu( 'menu-4' ) ) {
						_e( '<h3>'.$menu_4->name.'</h3>', 'nasa_jsc' );
						wp_nav_menu( array(
						'theme_location' => 'menu-4',
						'menu_class' => 'r-link nav navbar-nav',
						/*	*/) );
					} ?>
				</div>
			</div>
			<!-- End Column 1 -->

			<!-- Column 2 -->
			<?php
			$category_customize = get_theme_mod('nasa_jsc_new_release_category');
			if ($category_customize) {
				$cat_id = $category_customize;
			} else {
				$cat_id = 1;
			}
			$cat_obj = get_category( $cat_id );
			$args = array('post_type' => 'post', 'cat' => $cat_id);
			$category_list = new WP_Query($args);
			?>
			<div class="col-md-5 col-sm-5">
				<?php echo set_img_slider(); ?>
				<div class="container latest-news">
					<h3><?php echo ucwords($cat_obj->name) ?></h3>
				</div>
				<div class="container latest-news">
					<?php if ( $category_list->have_posts() ) {
						while ( $category_list->have_posts() ) {
							$category_list->the_post();
								$post_title = get_the_title(); ?>
								<small class="doc-date clearfix"><?php echo the_time( 'F j, Y' ); ?></small>
								<h4><?php echo $post_title ?></h4>
								<p>
									<?php  echo wp_trim_words( get_the_content(), 30, '...' ) ?>
									<a href="<?php echo get_permalink() ?>">More »</a>
								</p>


						<?php }
					wp_reset_postdata();
					} ?>
					<a href="<?php echo get_site_url()."/"."category/".$cat_obj->slug ?>"><button type="button" class="btn btn-primary">Read All <?php echo $cat_obj->name ?> »</button></a>
				</div>
			</div>
			<!-- End Column 2 -->

			<!-- Column 3 -->
			<div class="col-md-4 col-sm-4">
				<?php get_sidebar() ?>
				<?php
					$facebookUrl = "http://www.facebook.com/NASAJSC";
					$twitterUrl = "http://twitter.com/JSCSOS";
					$arrSoc = array();
					if(get_theme_mod('nasa_jsc_social_setting')):
						$arrSoc = get_theme_mod('nasa_jsc_social_setting');
						if(!empty($arrSoc['facebook'])):
							$facebookUrl = esc_url($arrSoc['facebook']);
						endif;

						if(!empty($arrSoc['twitter'])):
							$twitterUrl = esc_url($arrSoc['twitter']);
						endif;
					endif;

				?>
				<div class="social-links">
					<a target="_blank" href="<?php echo $facebookUrl; ?>">
						<img alt="facebook" src="<?php echo get_template_directory_uri() . '/img/FacebookIcon.png' ?>" height="64" width="64">
					</a>
					<a target="_blank" href="<?php echo $twitterUrl; ?>">
						<img alt="twitter" src="<?php echo get_template_directory_uri() . '/img/TwitterIcon.png' ?>" height="64" width="64">
					</a>
				</div>
			</div>
			<!-- End Column 3 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

