<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
	<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</hgroup>

	<?php if ( get_theme_mod( 'uc_nav_color' ) ) : ?>
		<nav style="background-color:<?php echo get_theme_mod( 'uc_nav_color' ); ?>" id="site-navigation" class="main-navigation" role="navigation">
	<?php else : ?>	
		<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php endif; ?>
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id' => 'menunav_container_id' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
	<?php if (get_theme_mod( 'uc_logo' )) : ?>
	<div class="logo_container">
		<div class="logo_content">
		    <?php
		    $get_uc_logo = get_theme_mod('uc_logo');
		    $get_uc_link_logo = get_theme_mod('uc_link_logos');
		    $get_uc_title_logo = get_theme_mod('uc_logo_title');
		    $get_uc_alt_logo = get_theme_mod('uc_logo_alt');
		    $title_logo = "";
		    $alt_desc_logo = "";
		    $link_logo = "#";
		    $id_logo = 0;

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

		    if($get_uc_title_logo):
		        if(!empty($get_uc_title_logo[(int)$value["idloop"]])):
		            $title_logo = $get_uc_title_logo[(int)$value["idloop"]];
		        else:
		            $title_logo = "";
		        endif;
		    endif;

		    if($get_uc_alt_logo):
		        if(!empty($get_uc_alt_logo[(int)$value["idloop"]])):
		            $alt_desc_logo = $get_uc_alt_logo[(int)$value["idloop"]];
		        else:
		            $alt_desc_logo =  "";
		        endif;
		    endif;

		    if($get_uc_link_logo):
		        if(!empty($get_uc_link_logo[(int)$value["idloop"]])):
		            $link_logo = $get_uc_link_logo[(int)$value["idloop"]];
		        else:
		            $link_logo = "#";
		        endif;
		    endif;
		    $id_logo +=1;
		    ?>

		     <a href="<?php echo esc_url($link_logo); ?>" id="link_logo_<?php echo $id_logo?>" rel="link_rel_logo_client">
		            <img class="img-responsive" src="<?php echo $value["large_img"]; ?>" <?php if(!empty($title_logo)): ?> title="<?php echo $title_logo; ?>" <?php endif; ?>  <?php if(!empty($alt_desc_logo)): ?> alt="<?php echo $alt_desc_logo; ?>" <?php endif; ?>>
		        </a>
		    <?php
		    }
		    ?>		
		</div>
	</div>
	<?php endif; ?>