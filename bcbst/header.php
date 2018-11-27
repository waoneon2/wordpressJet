<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bcbst' ); ?></a>

	<header id="masthead" class="site-header container">
		<div class="row">
			<div class="site-branding hidden-xs">
				<div class="col-sm-6 bsbc-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php printHeaderImage() ?>" ></a></div>
				<div class="col-sm-6 bsbc-right-header search">
					<form class="navbar-form navbar-right" action="<?php bloginfo('url');?>">
					  <div class="form-group">
					  	<a href="" class="header-print"><span class="glyphicon glyphicon-print"></span></a>
					  	<a href="" class="header-email"><span class="glyphicon glyphicon-envelope"></span></a>
					    <input type="text" class="form-control" name="s" placeholder="Search">
					  </div>
					  <button class="btn btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</form>
				</div>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation navbar hidden-xs">
				<?php
					wp_nav_menu( array(
						'theme_location' 	=> 'menu-1',
						'menu_id'        	=> 'primary-menu',
						'container_class' 	=> 'nav-container',
						'menu_class'      	=> 'nav navbar-nav',
						'walker'			=> new bcbst_walker_nav_menu()
					) );
				?>
			</nav><!-- #site-navigation -->
			<!-- Show if mobile layout -->
			<div class="on-mobile hidden-xl hidden-md hidden-lg hidden-sm container-fluid">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive"  src="<?php printHeaderImage() ?>" ></a>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-mobile-menu" aria-expanded="false">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse navbar-right collapse" id="primary-mobile-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' 	=> 'menu-1',
						'container' 		=> 'false',
						'menu_class'      	=> 'nav navbar-nav clearfix on-mobile-menu',
						'walker'			=> new bcbst_walker_nav_menu()
					) );
				?>
				<div class="hidden-lg hidden-xl hidden-md">
					<form role="search" method="get" class="navbar-form searchs-form-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
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
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
