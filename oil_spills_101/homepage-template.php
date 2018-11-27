<?php
/**
 * Template Name: Homepage
 */

function get_custom_front_sidebar($no_id){
	$title = get_theme_mod('cfw'.$no_id.'-title');
	$image = get_theme_mod('cfw'.$no_id.'-image');
	$excerpt = get_theme_mod('cfw'.$no_id.'-excerpt');
	$learn_more = get_theme_mod('cfw'.$no_id.'-url');
	$bt_text = get_theme_mod('cfw'.$no_id.'-button-text');
	$bt_link = get_theme_mod('cfw'.$no_id.'-button-link');


	if ($title) {

		echo '<div class="front-sidebar custom-widget col col-xs-12 col-sm-6 col-md-6 col-lg-3 col-centered clearfix box">';

		echo ' <div class="widget-section"> ';
		if ($image) {
			echo ' 	<div class="image"><img class="" src="'.$image.'"></div> ';
		}
		echo ' 	<div class="title"><h2>'.$title.'</h2></div> ';
		echo '  <div class="widget-content">';
		echo ' 		<div class="excerpt">'.$excerpt.'</div> ';
		if ($bt_text && $bt_link) {
			echo ' 	<div > ';
			echo ' 		<a href="'.esc_url($bt_link).'" class="btn" target="_blank" ><div><span>'.$bt_text.'</span></div></a> ';
			echo ' 	</div> ';
		}
		if ($learn_more) {
			printf(
				' <div style="text-align: right;">	<span class="learn-more"><a href="%1$s" target="_blank">%2$s</a><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></span> </div>'
				, esc_url($learn_more)
				, esc_html__('Learn more', 'oilspill')
				);
		}
		echo ' </div></div></div> ';
	}

};



get_header(); ?>

	<div id="primary" class="content-area">

	</div><!-- #primary -->

	<div class="widget-container container">
		<div class="row row-centered" id="row-content-widget">
		<?php if ( is_active_sidebar( 'front-sidebar' ) ):?>
			<div class="front-sidebar default-widget col col-xs-12 col-sm-6 col-md-6 col-lg-3 col-centered clearfix box">
				<?php dynamic_sidebar('front-sidebar'); ?>
			</div>
		<?php endif;?>
				<?php get_custom_front_sidebar(1); ?>
				<?php get_custom_front_sidebar(2); ?>
				<?php get_custom_front_sidebar(3); ?>
		</div>
	</div>

<?php

get_footer();
