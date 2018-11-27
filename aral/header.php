<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aral
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aral' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<a class="header-title-logo-mobile" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<div class="logo-mobile">
			
		</div>
	</a>
	<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		  		<span class="sr-only">Toggle navigation</span>
		  		<span class="icon-bar"></span>
		  		<span class="icon-bar"></span>
		  		<span class="icon-bar"></span>
			</button>
			<div class="row primary-menu-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		<div class="header-search-mobile">
		  	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="label-search-mobile">
					<span class="screen-reader-text"><?php __('Search for: ')?></span>
					<input type="search" class="search-field" placeholder=" " value="" name="s" title="Search for:">
				</label>
				<!-- <input type="submit" class="search-submit" value=" "><i class="fa fa-search"></i> -->
				<button type="submit" class="search-submit"><span class="fa fa-search"></span></button>
			</form>
		  </div>
	</nav><!-- #site-navigation -->

   	<div class="row search-header">
			  <div class="header-search search_wrapper">
		  	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="label-search-mobile">
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder=" " value="" name="s" title="Search for:">
				</label>
				<button type="submit" class="search-submit"><span class="fa fa-search"></span></button>
			</form>
		  </div>
    </div>

	<div class="site-branding">
		<div class="row header-site-branding">
			<div class="small-12 medium-12 large-12 columns">
			<?php
			function printHeaderImage() {
				$headerImage = get_header_image();
				if ( '' == $headerImage ) {
					$headerImage = get_template_directory_uri() . '/images/site-header.png';
				}
				echo( $headerImage );
			}
			if ( is_front_page() && is_home() ) : ?>
				<!-- <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> -->
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="header-image" src="<?php printHeaderImage() ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php else : ?>
				<!-- <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p> -->
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="header-image" src="<?php printHeaderImage() ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
			    </a>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			</div>
		</div>
	</div><!-- .site-branding -->


	</header><!-- #masthead -->

	<div class="row breadcumbs-row" id="breadcumb_nav">
    	<?php custom_breadcrumbs(); ?>
	</div>

	<?php global $user_ID; if( $user_ID ) : ?>
			<?php if( current_user_can('level_0') ) : ?>
			<div class="row welcome_message">
		      <div class="message">
			    <?php $current_user = get_user_by( 'id', get_current_user_id() );
					printf(esc_html__('Welcome back %1$s | If you are not %1$s %2$s.', 'aral'), $current_user->user_login, '<a class="message_not_have_me" href="'. wp_logout_url( home_url() ) .'">' . esc_html__('click here', 'aral') . '</a>'); ?>
			  </div>
	        </div>
			<?php else : ?>
			<?php endif; ?>
			<?php endif; ?>

	<div id="content" class="site-content">
