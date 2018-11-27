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
<div id="page" class="hfeed sites page-tmp2">

	<header id="masthead" role="banner">
    <div class="banner-bar hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 banner-logo">
                        <?php if ( get_theme_mod( 'uc_logo' )) : ?>
                            <div class="logo_clients web-cs-logo" id="each_logo_client">
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
                          <?php endif; ?>
                </div>
            </div>
            <div class="row sep-line">
                <div class="col-md-8 col-sm-12 hidden-sm banner-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h2 class="site-title"><?php bloginfo( 'name' ); ?></h2></a>
                </div>
                <div class="col-md-8 col-sm-12 hidden-md hidden-lg hidden-xl banner-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h3 class="site-title"><?php bloginfo( 'name' ); ?></h3></a>
                </div>
                <div class="col-md-2 hidden-sm">
                    <?php
                    if (get_theme_mod( 'bt_head_label' )) :

                        $get_bt_head_label = get_theme_mod('bt_head_label');
                        $get_bt_head_link = get_theme_mod('bt_head_link');
                            if($get_bt_head_link):
                                echo '<a href="'.esc_url($get_bt_head_link).'" class="btn btn-default red-buttons">'.$get_bt_head_label.' <span class="fa fa-chevron-circle-right"></span></a>';
                            else:
                                echo '<a href="'.home_url().'" class="btn btn-default red-buttons">'.$get_bt_head_label.' <span class="fa fa-chevron-circle-right"></span></a>';
                            endif;
                    endif;

                    ?>
                </div>
            </div>
        </div>
    </div>
	</header><!-- #masthead -->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container no-padding">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
            </a>
    </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 3,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>
	<div id="main" class="wrapper container">
    <article>