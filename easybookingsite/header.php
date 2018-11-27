<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package staytohelp
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
<style>
.navbar-small .navbar-toggle {
    border-color: #ddd;
    margin-top: 8px;
    margin-bottom: 8px;
}
p.social-list a {
    padding: 3px;
}
</style>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#header-navbar" data-offset="51">
<div id="page-container" class="site fade">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sth' ); ?></a>

	<header id="header" class="site-header header navbar navbar-transparent navbar-fixed-top" style="z-index: 5000;">
		<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
		<div class="hidden-sm hidden-xs">
		<a class="header-title navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="padding: 0px; padding-top: 3px;">
			<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
		</a>
		</div>
		<div class="hidden-md hidden-lg">
		<a class="header-title navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="padding: 0px; padding-top: 3px;">
			<img style="max-width: 275px;" class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
		</a>
		</div>
		</div>

			<div class="collapse navbar-collapse" id="header-navbar">
			<?php
				wp_nav_menu( array(
					'theme_location'    => 'primary',
					'depth'             => 4,
					'container'         => false,
					'menu_class'        => 'menu1 nav navbar-nav navbar-right',
					'walker'            => new sth_walker_nav_menu())
				);
			?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
