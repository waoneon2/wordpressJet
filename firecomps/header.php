<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header clearfix" role="banner">
        	<div class="wrapper clearfix">
                <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </a>
                
                <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav><!-- #site-navigation -->
                
                <div class="site-search">
                	<?php get_search_form(); ?>
                </div>
                
                <div class="site-subscribe comm100-subscribe-form comm100-status-normal">
                    <div class="comm100-normal">
                        <div class="comm100-field comm100-field-email">
                            <span><span class="comm100-validation-message">Please enter a valid email address.</span></span>
                            <div>
                                <input class="comm100-control" type="text" name="email" value="Subscribe by email" />
                                <input class="comm100-field-id" type="hidden" value="4952"/>
                            </div>
                        </div>
                        <div class="comm100-button-subscribe">
                            <input class="comm100-site-id" type="hidden" value="174698"/>
                            <input class="comm100-maillinglist" type="hidden" value="200"/>
                            <input type="button" value="SUBSCRIBE" onclick="comm100_subscribe(this.parentNode.parentNode.parentNode);" />
                        </div>
                    </div>
                    <div class="comm100-submitting">
                        <span class="comm100-icon comm100-icon-loading"></span> <span>Submitting...</span>
                    </div>
                </div>
                    
                <div class="site-social-bookmarking">
                    <ul>
                        <li><a href="#" class="ico_facebook"></a></li>
                        <li><a href="#" class="ico_googleplus"></a></li>
                        <li><a href="#" class="ico_twitter"></a></li>
                        <li><a href="<?php bloginfo( 'rss2_url' ); ?>" class="ico_rss"></a></li>
                        <li><a href="/donate" class="donate button">Donate</a></li>
                    </ul>
                </div>
            </div>
		</header><!-- #masthead -->

		<div id="main" class="site-main">
