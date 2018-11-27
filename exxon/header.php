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

<?php

// Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page-wrapper-first" class="hfeed sites page-tmp2">

	<header id="masthead" role="banner">
    <div class="top-bar">
        <div class="row">
            <div class="col-md-12 text-right">
            <?php if(get_theme_mod('exxon_external_link_text') != 'External Link') : ?>
                <?php if(get_theme_mod('exxon_external_link_url') != 'corporate.exxonmobil.com') : ?>
                <a href="<?php echo esc_url(get_theme_mod('exxon_external_link_url')); ?>" target="_blank">
            <?php else : ?>
                <a href="http://corporate.exxonmobil.com/" target="_blank">
            <?php endif; ?>
                <span class="divider"></span>
            <?php if(get_theme_mod('exxon_external_link_logo') != 'fa-globe') : ?>
                <i class="fa <?php echo get_theme_mod('exxon_external_link_logo'); ?>" id="logo-external-link"></i>
            <?php else : ?>
                <i class="fa fa-globe" id="logo-external-link"></i>
            <?php endif; ?>
                <span class="select-country"><?php echo get_theme_mod('exxon_external_link_text'); ?></span>
                </a>
            <?php else : ?>
                <a href="http://corporate.exxonmobil.com/" target="_blank">
                <span class="divider"></span>
                <i class="fa fa-globe" id="logo-external-link"></i>
                <span class="select-country">External link</span>
                </a>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <nav id="main-nav" class="navbar navbar-default">
        <div class="container-fluid no-padding">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="menu-text">Menu</span>
              </button>

              <button class="search-wrapper mobile-search visible-xs">
                <i class="fa fa-search"></i>
                <span class="search-text">Search</span>
              </button>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <span class="navbar-logo"><?php bloginfo('name'); ?></span>
                <span class="navbar-title"><?php bloginfo('description'); ?></span>
            </a>
            </div>

            <div class="navbar-collapse navbar-right collapse" id="bs-navbar-collapse-1">
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 4,
                        'container'         => false,
                        'menu_class'        => 'nav navbar-nav clearfix',
                        'walker'            => new exxon_walker_nav_menu())
                    );
                ?>

                <button class="search-wrapper hidden-xs">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </nav>

	</header><!-- #masthead -->
	<div class="header-site-search-wrapper">
		<?php get_search_form(); ?>
	</div>
    <div class="site-cover"></div>
	<div id="content" class="container-fluid">
    <?php if(function_exists('exxon_breadcrumbs')): exxon_breadcrumbs(false); endif;?>
    <article>
        <div class="container-fluid" id="second-container">
        <?php if(is_front_page()) :?>
            <div id="home-slideshow" class="row">
                <div class="slideshow-wrap">
                <?php if( get_theme_mod('exxon_lk') ) : ?>
                <?php
                    $get_exxon_image_slider = get_theme_mod('exxon_lk');
                    $make_arr   = array();
                    $get_arr    = array();
                    $count_up   = 0;

                    foreach ($get_exxon_image_slider as $key => $value) {
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
                    <div id="slideshow-photos" class="cycle-slideshow" data-cycle-fx="fade" data-cycle-timeout="3000" data-cycle-auto-height="calc" data-cycle-log=false>


                    <div class="cycle-overlay custom"></div>

                    <?php foreach ($decode_data["data"] as $key => $value) { ?>
                        <img id="slider-<?php echo $key; ?>" src="<?php echo $value["large_img"]; ?>" class="img-responsive homepage" data-title="<?php
                        if(get_theme_mod('exxon_title_overlay')):
                            $title = array();
                            $title = get_theme_mod('exxon_title_overlay');
                           if(!empty($title[$value['idloop']])):
                            echo $title[$value['idloop']];
                           endif;
                        endif;
                        ?>" data-cycle-desc="<?php
                        if(get_theme_mod('exxon_desc_overlay')):
                            $desc = array();
                            $desc = get_theme_mod('exxon_desc_overlay');
                           if(!empty($desc[$value['idloop']])):
                            echo $desc[$value['idloop']];
                           endif;
                        endif;
                        ?>" data-link="<?php
                        if(get_theme_mod('exxon_link_overlay')):
                           $link = array();
                           $link = get_theme_mod('exxon_link_overlay');
                           if(!empty($link[$value['idloop']])):
                            echo esc_url($link[$value['idloop']]);
                           endif;
                        endif;
                        ?>" data-textlink="<?php
                        if(get_theme_mod('exxon_text_link_overlay')):
                           $textlink = array();
                           $textlink = get_theme_mod('exxon_text_link_overlay');
                           if(!empty($textlink[$value['idloop']])):
                            echo $textlink[$value['idloop']];
                           else:
                            echo "Read more";
                           endif;
                        endif;
                        ?>">
                    <?php } ?>

                    </div>
                <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
