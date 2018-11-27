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
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/template-two.css'; ?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php 

// Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site page-tmp2">

	<header id="masthead" class="site-header" role="banner">
	
		<div class="web-cs-head">
	<?php if ( get_theme_mod( 'uc_logo' ) && get_theme_mod( 'uc_link_logos' ) ) : ?>
    <div class="logo_clients web-cs-logo" id="each_logo_client">
    <?php

    $get_uc_logo = get_theme_mod('uc_logo');
    $get_uc_link_logo = get_theme_mod('uc_link_logos');
    $count_uc_logo = count($get_uc_logo);
    $make_arr = array();
    $get_arr = array();
    $count_up = 0; 
    $max_logo = 8;
    $c_int = 0;

    foreach ($get_uc_logo as $key => $value) {
        if ($value !== "") :
            $conv_int = (int)uc_get_image_id($value);
            if(!empty($conv_int)):
                $get_image_large = wp_get_attachment_image_src($conv_int, 'large');
                $make_arr[$count_up] = array(
                    'img' => $value,
                    'id' => $conv_int,
                    'large_img' => $get_image_large[0],
                    'idloop' => $key
                );
           endif;
           $count_up++;
        endif;
    }
    $get_arr["data"] = $make_arr;
    $convert_json = json_encode($get_arr, JSON_PRETTY_PRINT);
    $decode_data = json_decode($convert_json, true);
    ?>
    <?php
    foreach ($decode_data["data"] as $key => $value) {
            if($c_int > $max_logo):  // to display just 9 logos.
                break;
              endif;  
            $c_int++;
    ?>
     <a href="<?php echo esc_url($get_uc_link_logo[(int)$value["idloop"]]); ?>" id="link_logo_client" rel="link_rel_logo_client">
            <img src="<?php echo $value["large_img"]; ?>">
        </a>
    <?php
    }
    ?>
    </div>
  <?php endif; ?>
			
			<div class="web-cs-title">
				<div class="site-title"><?php bloginfo( 'name' ); ?></div>
				<?php 
				if ( get_theme_mod( 'bt_head_label' ) && get_theme_mod( 'bt_head_link' ) ) :

					$get_bt_head_label = get_theme_mod('bt_head_label'); 
					$get_bt_head_link = get_theme_mod('bt_head_link');
					echo '<div class="bt-head"><a href="'.esc_url($get_bt_head_link).'" class="template2-df-button">'.$get_bt_head_label.' <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></div>';

				endif;

					?>
				
			</div>
			
		</div>
<?php if ( get_theme_mod( 'uc_nav_color' ) ) : ?>
<nav style="background-color:<?php echo get_theme_mod( 'uc_nav_color' ); ?>!important;" class="navbar navbar-default" role="navigation">
<?php else : ?>			
<nav class="navbar navbar-default" role="navigation">
<?php endif; ?>
  <div class="container-fluid">
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

<!-- 		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?> -->
	</header><!-- #masthead -->
	
	<div id="main" class="wrapper">