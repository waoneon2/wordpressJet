<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<?php if(defined('ICL_LANGUAGE_CODE')) : if(ICL_LANGUAGE_CODE=='ar') {  ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()."/child-rtl.css" ?>" type="text/css" >
<?php } endif; ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<div class="site-branding">
	<div class="container">
		<div class="row">
			 <div class="col-md-3 col-md-offset-9 search-area hidden-xs hidden-sm" id="search-menu-top">
			   	<form role="search" method="get" class="navbar-form searchs-form-full" action="<?php esc_url( home_url( '/' ) ); ?>">
			   	<div class="input-group">
			 			<input type="search" class="form-control searchs-field" placeholder=" " value="" name="s" title="Search for:">
			 		<div class="input-group-btn">
			 		<button type="submit" class="btn btn-default search-submit"><span class="fa fa-search"></span></button>
			 		</div>
			 	</div>
			 	</form>
				 <nav id="site-header-navigation" class="header-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'header-menu' ) ); ?>
				</nav>
			 </div>
		</div>
		<div class="row">
			  <div class="col-md-12 banner-bar" id="logo-title-header">
				<?php
				function printHeaderImage() {
					$headerImage = get_header_image();
					if ( '' == $headerImage ) {
						$headerImage = get_template_directory_uri() . '/images/site-header.gif';
					}
					echo( $headerImage );
				}
				if ( is_front_page() && is_home() ) : ?>
					<div class="container">
					<div class="row" id="header-logo-bp">
						<div class="col-md-1 logo">
							<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
							</a>
						</div>
					

				<?php else : ?>
					<div class="container">
					<div class="row" id="header-logo-bp">
						<div class="col-md-1 logo">
							<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
						    </a>
						</div>
					
				<?php
				endif;
				?>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
				<div class="col-md-9 text-left title-text hidden-xs">
					<h3 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h3>
				</div>
				<div class="col-md-9 text-left title-text hidden-xl hidden-lg hidden-md hidden-sm">
					<h4 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h4>
				</div>
					</div>
					</div>
				<?php
				endif; ?>
			 </div>
			 </div>
	</div>
	</div><!-- .site-branding -->
	</header><!-- #masthead -->
	<div class="container-bp" id="menu-nav-bp">
		<div class="row-bp">
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </button>
				</div>
				<div class="collapse navbar-collapse no-padding" id="bs-navbar-collapse-1">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'menu_class' => 'menu1 nav navbar-nav' , 'walker' => new custom_walker_nav_menu()) ); ?>
					<div class="hidden-lg hidden-xl hidden-md">
						<form role="search" method="get" class="navbar-form searchs-form-full" action="<?php esc_url( home_url( '/' ) ); ?>">
					   	<div class="input-group">
					 		<input type="search" class="form-control searchs-field" placeholder=" " value="" name="s" title="Search for:">
					 		<div class="input-group-btn">
					 			<button type="submit" class="btn btn-default search-submit"><span class="fa fa-search"></span></button>
					 		</div>
					 	</div>
					 	</form>
					</div>
				</div>
			</div>
			</nav>
		</div>
	</div>
	<div class="container bp-banner hidden-xs"></div>
	<div class="container" id="breadcumb_nav">
    <?php custom_breadcrumbs(); ?>
	</div>
			<?php global $user_ID; if( $user_ID ) : ?>
			<?php if( current_user_can('level_0') ) : ?>
			<div class="container">
		      <div class="message">
					<?php $current_user = get_user_by( 'id', get_current_user_id() );
						printf(esc_html__('Welcome back %1$s | If you are not %1$s %2$s.', 'bp'), $current_user->user_login, '<a class="message_not_have_me" href="'. wp_logout_url( home_url() ) .'">' . esc_html__('click here', 'bp') . '</a>'); ?>
			  </div>
	        </div>
			<?php else : ?>
			<?php endif; ?>
			<?php endif; ?>

	<div id="content" class="site-content">
