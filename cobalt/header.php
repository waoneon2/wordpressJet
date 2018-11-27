<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cobalt
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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cobalt' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="container">
				<div class="row">
					<div class="col-md-8 hidden-sm hidden-xs">
						<a href="<?php echo home_url(); ?>"><img src="<?php printHeaderImage() ?>" class="header-image" /></a>
					</div>
					<div class="col-md-4 search-container hidden-sm hidden-xs">
						<form class="search">
				        <div class="form-group">
				           <?php get_search_form(); ?>
				        </div>
		      			</form>
					</div>

					<div class="col-md-12 hidden-lg hidden-xl hidden-md" id="show-logo-on-mobile">
						<a href="<?php echo home_url(); ?>"><img src="<?php printHeaderImage() ?>" class="header-image on-mobile" /></a>
					</div>
				</div>
			</div>


		</div><!-- .site-branding -->

		<!-- nav menu -->
		<nav class="nav navbar navbar-cobalt" role="navigation">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
		    <div class="collapse navbar-collapse no-padding" id="bs-navbar-collapse-1">
			<?php wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 6,
                'container'         => false,
                'menu_class'        => 'nav navbar-nav cobalt-nav',
                'walker'            => new cobalt_walker_nav_menu())

            );; ?>

            <div class="hidden-lg hidden-xl hidden-md">
						<form role="search" method="get" class="navbar-form searchs-form-full search" action="<?php esc_url( home_url( '/' ) ); ?>">
					   	<div class="input-group">
					 		<input type="search" class="form-control searchs-field" placeholder=" " value="" name="s" title="Search for:">
					 		<div class="input-group-btn">
					 			<button type="submit" class="btn btn-default search-submit">GO!</button>
					 		</div>
					 	</div>
					 	</form>
			</div>

            </div>
        </div></nav>
		<!-- End nav menu -->


	</header><!-- #masthead -->

	<div id="content" class="site-content">
