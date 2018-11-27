<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Corporate
 */

// Includes
require_once( 'inc/theme-layout-settings.php' );
require_once( 'inc/color-helper.php' );

// Variables
$header_background_color = get_theme_mod( 'corporate_theme_header_background_color', '#ffffff' );
$body_title_color        = get_theme_mod( 'corporate_theme_body_title_color',        '#13509f' );
$body_link_color         = get_theme_mod( 'corporate_theme_body_link_color',         '#13509f' );
$footer_background_color = get_theme_mod( 'corporate_theme_footer_background_color', '#13509f' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<style>
	.site-content h1,
	.site-content h2,
	.site-content h3,
	.site-content h4,
	.site-content h5,
	.site-content h6 {
		color: <?php
			echo $body_title_color;
		?>;
	}
	.site-content a {
		color: <?php
			echo $body_link_color;
		?>;
	}
	.site-content a:focus,
	.site-content a:hover,
	.site-content a:visited {
		color: #<?php
			echo str_pad(
				dechex(
					1.1 * hexdec(
						substr( $body_link_color, 1 )
					)
				),
				6,
				'0',
				STR_PAD_LEFT
			);
		?>;
	}
	.site-footer,
	.site-footer a,
	.site-footer p,
	.site-footer span {
		color: <?php
			echo get_contrasting_color( $footer_background_color );
		?>;
	}
	@media screen and ( min-width: 760px ) {
		.site-navigation .site-navigation__menu a {
			color: <?php echo get_contrasting_color( $header_background_color ); ?>;
		}
	}
	@media screen and ( min-width: 1000px ) {
		.home.widget-dashboard-layout .site-content .widget-title {
			background-color: <?php echo $body_title_color; ?>;
			color: <?php echo get_contrasting_color( $body_title_color ); ?>;
		}
	}
</style>
</head>

<body <?php body_class( get_theme_layout().'-layout' ); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jetty-corporate-theme' ); ?></a>

	<?php
		$header_style = 'style="background-color:' . $header_background_color . ';"';
	?>
	<header id="masthead" class="site-header" role="banner" <?php echo $header_style; ?>>
		<div class="site-header__top-section">
			<div class="content-wrap">
				<div class="site-header__branding">
					<?php
						$header_image = get_header_image();
						if ( $header_image ) {
							echo
							'<div class="site-header__image-wrapper">' .
								'<img src="' . $header_image . '" alt="Site logo" class="site-header__image">' .
							'</div>';
						}
					?>
					<div class="site-header__title-section">
						<?php
						$header_text_style = 'style="color:#' . get_header_textcolor() . ';"';
						?>
						<h1 class="site-header__title js-site-title" <?php echo $header_text_style; ?>>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<h2 class="site-header__description js-site-description" <?php echo $header_text_style; ?>>
							<?php bloginfo( 'description' ); ?>
						</h2>
					</div>
				</div>

				<aside class="site-header__widgets">
					<section id="search-2" class="widget widget_search">
						<form role="search" method="get" class="search-form" action="/">
							<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
							<button type="submit" class="search-submit fa fa-search"></button>
						</form>
					</section>
					<?php
					if ( is_active_sidebar( 'header-1' ) ) {
						dynamic_sidebar( 'header-1' );
					}
					?>
				</aside>
			</div>
		</div>

		<div class="content-wrap">
			<nav id="site-navigation" class="site-navigation" role="navigation">
				<div class="site-navigation__menu-header-section">
					<?php
						$menu_header_style = 'style="background-color:' . get_theme_mod( 'corporate_theme_mobile_nav_header_color', '#13509f' ) . ';"';
					?>
					<div class="site-navigation__menu-header" <?php echo $menu_header_style; ?>>&nbsp;</div>
					<button class="site-navigation__toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'jetty-corporate-theme' ); ?></button>
				</div>
				<div class="site-navigation__menu">
					<?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'header-menu' ) ); ?>
				</div>
			</nav>
		</div>
	</header>

	<div id="content" class="site-content">
		<div class="content-wrap">
