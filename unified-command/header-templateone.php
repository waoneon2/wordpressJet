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
    
	<?php if ( get_theme_mod( 'uc_logo' ) && get_theme_mod( 'uc_link_logos' ) ) : ?>
    <div class="logo_clients" id="each_logo_client">
    <?php
    $get_uc_logo = get_theme_mod('uc_logo');
    $srcget = "";
    
    $get_uc_link_logo = get_theme_mod('uc_link_logos');
    $count_uc_logo = count($get_uc_logo);
    $c_int = 0;
    for ($i=0; $i < $count_uc_logo; $i++) {
        if($get_uc_logo[$i] !== ""):
        // var_dump(uc_get_image_id($get_uc_logo[$i]));
        if(uc_get_image_id($get_uc_logo[$i]) === NULL):
        $srcget = 'http://placehold.it/350x150';
        else :
        $idint = (int)uc_get_image_id($get_uc_logo[$i]);
        $gtimg = wp_get_attachment_image_src($idint, 'large');
        $srcget = $gtimg[0];
        endif;
    ?>
        <a href="<?php echo esc_url($get_uc_link_logo[$i]); ?>" id="link_logo_client" rel="link_rel_logo_client">
            <img src="<?php echo $srcget; ?>">
        </a>
    <?php
            if($c_int === 2):  // to display just 3 logos.
                break;
              endif;  
    $c_int++;
        endif;
    }
    ?>
    </div>
  <?php endif; ?>
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