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
<!-- <div class="col-md-3"></div> -->
<div class="col-md-offset-9" id="col-of-languages">
	<div class="rPlanguages" style="text-align:left">
		<?php icl_post_languages(); ?></div>
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

			//$description = get_bloginfo( 'description', 'display' );
			//if ( $description || is_customize_preview() ) : ?>
				<p style="display:none;" class="site-description"><?php //echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			//endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
	<nav id="site-navigations" class="main-navigations" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ncoc' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->

		</div> <!-- #first-col-header -->
	<div class="col-md-9" id="col-of-content">
	<div class="row" id="header-color">
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12" id="col-header-single-color">
	<div class="ncoc-single-header">
		<?php 
		global $post;
        if ( is_object($post) && metadata_exists( 'post', $post->ID, '_ncoc_swf_file' ) ) {
        	$swf_file = get_post_meta( $post->ID, '_ncoc_swf_file', true );
        	if(!empty($swf_file)):
        ?>
        <object id="cycle-on-parent-page" width="100%" height="330" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0">
        <param name="movie" value="<?php echo $swf_file; ?>">
        <param name="SCALE" value="exactfit">
        <param name="quality" value="high">
        <param name="wmode" value="opaque">
        <embed src="<?php echo $swf_file; ?>" quality="high" wmode="opaque" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" height="330" width="100%"></embed>
        </object>
        <?php
        endif;
        }
        else {
        	echo "&nbsp;";
        }
		?>
	</div>
</div><!-- #col-header-single-color -->
</div><!-- #header-color -->

<div class="row" id="ncoc-breacrumbs">
	<!-- <div class="col-md-2"></div> -->
	<div class="col-md-10" id="col-ncoc-breadcrumbs">
		<?php if(function_exists('ncoc_breadcrumbs')) ncoc_breadcrumbs(); ?>
	</div><!-- #col-ncoc-breadcrumbs -->
</div><!-- #ncoc-breadcrumbs -->

	<div id="content" class="site-content row">
