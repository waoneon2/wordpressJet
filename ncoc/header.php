<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NCOC
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site container">
<div class="row" id="row-of-languages">
<div class="col-md-3"></div>
<div class="col-md-9" id="col-of-languages">
	<div class="rPlanguages" style="text-align:left"><?php icl_post_languages(); ?></div>
</div><!-- #col-of-languages -->
</div><!-- #row-of-languages -->
	<div class="row">
	<div class="col-md-3" id="first-col-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ncoc' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<?php 
		function printHeaderImage() {
			$headerImage = get_header_image();
				if ( '' == $headerImage ) {
					$headerImage = get_template_directory_uri() . '/images/logo/ncoc_logo.png';
				}
					echo( $headerImage );
		}
	?>
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php else : ?>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php
			endif;
			?>
				<p style="display:none;" class="site-description"><?php //echo $description; /* WPCS: xss ok. */ ?></p>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
	<nav id="site-navigations" class="main-navigations" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->

	<?php if ( is_active_sidebar( 'sidebar-bottom-menu' ) ): ?>
	<!-- Sidebar on bottom menu -->
	<div class="content-sidebar-bottom-menu" id="site-content-sidebar-bottom-menu">
		<aside id="sidebar-bm" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-bottom-menu' ); ?>
		</aside><!-- #sidebar-bm -->
	</div><!-- #ssite-content-sidebar-bottom-menu -->
	<!-- end -->
	<?php endif; ?>

		</div> <!-- #first-col-header -->
	<div class="col-md-6" id="col-of-content">
	 <?php if ( get_theme_mod( 'ncoc_lk' )) : ?>
		<?php 
			$get_uc_image_slider = get_theme_mod('ncoc_lk');
			$count_img_slider = count($get_uc_image_slider);
			$make_arr   = array();
			$get_arr    = array();
			$count_up   = 0;
				foreach ($get_uc_image_slider as $key => $value) {
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
	<div class="content-image-slider" id="ncoc-img-slider">
		<div class="cycle-slideshow" data-cycle-fx=fadeout data-cycle-timeout=5000 data-cycle-pause-on-hover=true data-cycle-auto-height=container data-cycle-log=false>
			<?php
			foreach ($decode_data["data"] as $key => $value) {
				_e('<img height="468" id="slider-'.$key.'" class="ncoc-content-img-slider" src="'.$value["large_img"].'">','ncoc_slider');
			}
			?>
		</div><!-- .cycle-slideshow -->
	</div><!-- #ncoc-img-slider -->
	<?php endif; ?>
	
	<?php if (get_theme_mod( 'ncoc_logo' )) : ?>
	<div class="content-logo" id="ncoc-logo">
		<?php

	    $get_uc_logo = get_theme_mod('ncoc_logo');
	    $get_uc_link_logo = get_theme_mod('ncoc_link_logos');
	    $count_uc_logo = count($get_uc_logo);
	    $make_arr = array();
	    $get_arr = array();
	    $count_up = 0;

	    foreach ($get_uc_logo as $key => $value) {
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
	    <?php
	    foreach ($decode_data["data"] as $key => $value) {
	    ?>
	     <a href="<?php
	     if($get_uc_link_logo):
	        if(!empty($get_uc_link_logo[(int)$value["idloop"]])):
	            echo esc_url($get_uc_link_logo[(int)$value["idloop"]]);
	        else:
	            echo esc_url('#');
	        endif;
	    endif;
	     ?>" id="<?php echo 'link_logo_'.(int)$value["idloop"]; ?>" rel="link_rel_logo_client">
	            <img src="<?php echo $value["large_img"]; ?>">
	        </a>
	    <?php
	    }
    ?>	
	</div><!-- #ncoc-logo -->
	<?php endif; ?>

	<div id="content" class="site-content">
