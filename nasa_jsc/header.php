<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nasa_JSC
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nasa_jsc' ); ?></a>
	<?php function printHeaderImage() {
			$headerImage = get_header_image();
			if ( '' == $headerImage ) {
				$headerImage = get_template_directory_uri() . '/img/NASA-Logo.png';
			}
			echo( $headerImage );
	} ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="header-section container row">
			<div class="">
				<div class="header-section-wrap hidden-xs">
					<div class="header-section-lt ">
						<img class="img-responsive" src="<?php printHeaderImage() ?>">
					</div>
					<div class="header-section-rt">
						<h1><?php echo get_bloginfo('description') ?></h1>
					</div>
				</div>
			</div>
			<nav id="site-navigation" class="main-nav navbar navbar-inverse" role="navigation">
				<div class="container no-padding">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-wrap visible-xs">
							<div class="navbar-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php printHeaderImage(); ?>" align="left" src="" alt="logo" border="0"></a>
							</div>
							<div class="navbar-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('description') ?></a>
							</div>
						</div>
					</div>
					<div class="navbar-collapse no-padding collapse" id="primary-nav" aria-expanded="false" style="height: 1px;">
						<?php
						if ( has_nav_menu( 'menu-1' ) ) {
							wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_class' => 'menu1 nav navbar-nav nav-with-js',
							'walker' => new nasa_jsc_walker_nav_menu()) );
						} else {
							esc_html_e( 'Primary Navigation', 'nasa_jsc' );
						}?>
			    </div>
			  </div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
		<?php if(function_exists('nasa_jsc_breadcrumbs')): nasa_jsc_breadcrumbs(false); endif;?>
		<div class="row">
		  <div class="col-md-8 jsc-status">
		  <?php
		  $jscStatusText = "JSC is OPEN";
		  $jscStatusOptions = "enable";
		  $jscStatusDate = current_time('F j, Y');

		  if(get_theme_mod('nasa_jsc_status_setting_text')):
		  	$jscStatusText = get_theme_mod('nasa_jsc_status_setting_text');
		  endif;

		  if(get_theme_mod('nasa_jsc_status_setting_options')):
		  	$jscStatusOptions = get_theme_mod('nasa_jsc_status_setting_options');
		  endif;
		  ?>
		  	<?php if($jscStatusOptions == "enable"): ?>
		    <h2><?php echo $jscStatusDate; ?> - <div id="recentUpdatesBar"><p><?php echo $jscStatusText; ?></p></div></h2>
			<?php endif; ?>
		  </div>
		  <div class="col-md-4 search-wrap">
		    <form class="form-horizontal" role="form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		      <div class="form-group">
		        <div class="col-md-10 col-sm-10 col-xs-10">
		          <input type="text" class="form-control" name="s" placeholder="Enter search term...">
		        </div>
		        <div class="col-md-2 col-sm-2 col-xs-2">
		          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		        </div>
		      </div>
		    </form>
		  </div>
		</div>
