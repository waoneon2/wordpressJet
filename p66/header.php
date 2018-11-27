<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package p66
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="break-check" style="display:none" class=""></div>
<?php function printHeaderImage() {
    $headerImage = get_header_image();
    if ( '' == $headerImage ) {
      $headerImage = get_template_directory_uri() . '/img/logo-desktop.png';
    }
    echo( $headerImage );
}
$head_contact = get_theme_mod('header_contact');
$contact_link = get_the_permalink($head_contact);

$head_careers = get_theme_mod('header_careers');
$careers_link = get_the_permalink($head_careers);
?>

<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'p66' ); ?></a>

  <header id="masthead" class="site-header navbar" role="banner">
    <div class="site-branding row header">

      <div class="col-md-4 col-sm-4 col-lg-4 col-xs-2"></div>

      <div class="col-md-4 col-sm-3 col-lg-4 col-xs-8 logo-container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-top: 15px;"><img src="<?php printHeaderImage() ?>" ></a>
      </div>
      <?php include "search-header.php" ?>

    </div><!-- .site-branding -->
    <nav id="site-navigation" class="nav-container" role="navigation">
      <!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'p66' ); ?></button> -->
      <div class="toggle toggle-main menu-toggle" ><span>Menu</span></div>
      <div class="fixed-container navbar-header row">
        <div style="position:relative" class="subhidehere">
          <div class="submenu-heading hidden-sm hidden-md hidden-lg visually-hidden"> </div>
        </div>
        <div class="toggle toggle-mobile menu-toggle" ><span>Menu</span></div>
        <div class="menu-container">
          <?php
            wp_nav_menu( array(
              'theme_location'  => 'menu-1',
              'menu_id'         => 'primary-menu',
              'menu_class'      => 'menu sized visually-hidden',
              'container_class' => 'multi-container',
              'walker'          => new p66_menu_walker()
            ) );
          ?>
        </div>
        <!-- <div class="menu-footer-container visible-xs-block">
          <div class="row links">
            <div class="col-xs-6"><a href="<?php echo esc_url($contact_link); ?>">Contact</a></div>
            <div class="col-xs-6"><a href="<?php echo esc_url($careers_link); ?>">Careers</a></div>
          </div>
          <div class="row stocks">
            <div class="col-xs-6">
              <p>PSX <img src="<?php echo get_template_directory_uri() . '/img/icon-stock-market-up-arrow-mobile.png' ?>" width="20" height="20" alt="stock up"> <strong>+0.64</strong></p><p>
            </p></div>
            <div class="col-xs-6">
              <p>PSPX <img src="<?php echo get_template_directory_uri() . '/img/icon-stock-market-up-arrow-mobile.png' ?>" width="20" height="20" alt="stock up"> <strong>+0.64</strong></p>
            </div>
          </div>
        </div> -->
      </div>
    </nav><!-- #site-navigation -->

    <div class="mobile-subnav visible-xs">
      <div class="subnav-title" id="p66-subnav-title"><?php echo wp_title('') ?></div>
      <div class="subnav-links" id="subnav-links">
        <div class="submenu-holder show-right-control">
          <div class="submenu-contain">

            <?php
              wp_nav_menu( array(
                'theme_location'  => 'menu-1',
                'menu_id'         => 'p66-mobile-menu',
                'menu_class'      => 'p66-mobile-menu',
                'walker'          => new p66_menu_walker_mobile()
              ) );
            ?>
          </div>
          <div class="left-control"></div>
          <div class="right-control"></div>
        </div>
      </div>
    </div>


  </header><!-- #masthead -->


  <div id="content" class="site-content body">
    <div class="content">
