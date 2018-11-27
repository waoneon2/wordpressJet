<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Woodstone_Oven
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wso' ); ?></a>
  <?php 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  ?>
  <header id="masthead" class="site-header">

      <div class="site-branding">
        <div class="container">
          <div class="row">
            <div class="logo">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ($image) :?>
                  <img src="<?php echo $image[0]; ?>" alt="logo">
                <?php endif; ?>
              </a>
            </div>
            <div class="logo-title">
              <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
              </h1>
              <p><?php echo get_bloginfo( 'description') ?></p>
            </div>
          </div>
        </div>
      </div><!-- .site-branding -->

      <nav id="site-navigation" class="main-navigation navbar d-none d-md-block container">
        <?php
          wp_nav_menu( array(
            'theme_location'  => 'menu-1',
            'menu_id'         => 'primary-menu',
            'container_class'   => 'nav-container',
            'menu_class'        => 'nav navbar-nav',
            'walker'      => new wso_walker_nav_menu()
          ) );
        ?>
      </nav><!-- #site-navigation -->

      <!-- Show if mobile layout -->
      <div class="on-mobile d-block d-md-none container-fluid">
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
            'theme_location'  => 'menu-1',
            'container'     => 'false',
            'menu_class'        => 'nav navbar-nav clearfix on-mobile-menu',
            'walker'      => new wso_walker_nav_menu()
          ) );
        ?>
        
        </div>
      </div>

  </header><!-- #masthead -->

  <div id="content" class="site-content">
