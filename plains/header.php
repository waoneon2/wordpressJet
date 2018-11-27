<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plains
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'plains' ); ?></a>

	<header id="plaints-header" class="site-header" role="banner">
		<!-- SEARCH BAR -->
		<div id="header-search-bar" class="hidden-xs">
			<div class="container">
			  <div class="row">
			    <div class="col-md-3 col-md-offset-9 spacer">
			      <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			        <div class="input-group">
			          <input type="text" class="form-control" placeholder="Search..." name="s" alt="Search">
			          <div class="input-group-btn">
			            <button class="btn btn-default btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			          </div>
			        </div>
			      </form>
			    </div>
			  </div>
			</div>
		</div>
		<?php function printHeaderImage() {
				$headerImage = get_header_image();
				if ( '' == $headerImage ) {
					$headerImage = get_template_directory_uri() . '/img/logo-default.png';
				}
				echo( $headerImage );
		} ?>
		<!-- HEADER -->
		<div class="site-branding">
			<div class="container">
			  <div class="row">
			    <div class="head-bar hidden-xs">
						<div class="container">
							<div class="row">
								<div style="display: none;" class="col-sm-2 col-md-2 head-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="Plains All American Pipeline Logo" class="img-responsive" src="<?php printHeaderImage(); ?>"></a>
								</div>
								<div class="col-sm-6 col-md-7 col-sm-offset-3	 col-md-offset-2 head-title">
									<h2><?php bloginfo('description') ?></h2>
								</div>
								<div class="col-sm-3 col-md-3 pull-right no-padding btn-space">
								<?php 
									$get_text_one = get_theme_mod('header_button_one_setting_text');
									$get_link_one = get_theme_mod('header_button_one_setting_link');
									$get_text_two = get_theme_mod('header_button_two_setting_text');
									$get_link_two = get_theme_mod('header_button_two_setting_link');

									$default_text_one = 'Ask a Question';
									$default_text_two = 'Claims Information';

									$default_link_one = esc_url('jettyapp.com');
									$default_link_two = esc_url('jettyapp.com');

									if($get_text_one):
										$default_text_one = $get_text_one;
											endif;
									if($get_text_two):
										$default_text_two = $get_text_two;
											endif;
									if($get_link_one):
										$default_link_one = esc_url($get_link_one);
										endif;
									if($get_link_two):
										$default_link_two = esc_url($get_link_two);
										endif;
								?>
									<a type="button" class="btn btn-primary btn-lg btn-block" href="<?php echo $default_link_one; ?>"><?php echo $default_text_one; ?></a> 
									<a type="button" class="btn btn-danger btn-lg btn-block" href="<?php echo $default_link_two; ?>"><?php echo $default_text_two; ?></a>
								</div>
							</div>
						</div>
			    </div>
			  </div>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar navbar-inverse" role="navigation">
			<div class="container no-padding">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
						<span class="sr-only">Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand hidden-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="main-logo-header" src="<?php printHeaderImage(); ?>" alt="<?php bloginfo('name') ?>"></a>
					<div class="navbar-wrap visible-xs">
						<div class="navbar-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php printHeaderImage(); ?>" align="left" src="" alt="logo" border="0"></a>
						</div>
						<div class="navbar-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('description') ?></a>
						</div>
					</div>
				</div>
				<div class="navbar-collapse no-padding collapse" id="top-menu" aria-expanded="false" style="height: 1px;">
					<?php
					if ( has_nav_menu( 'menu-1' ) ) {
						wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id' => 'top-menu',
						'menu_class' => 'menu1 nav navbar-nav clearfix',
						'walker' => new plains_walker_nav_menu()) );
					} else {
						esc_html_e( 'Primary Navigation', 'plains' );
					}?>
					<div class="nav navbar-nav navbar-right col-sm-3 col-md-3 visible-xs">
					  <form class="navbar-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
					    <div class="input-group">
					      <input type="text" class="form-control" placeholder="Search..." name="s" alt="Search">
					      <div class="input-group-btn">
					        <button class="btn btn-default btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					      </div>
					    </div>
					  </form>
					</div>
		    </div>
		  </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->



	<div id="content" class="site-content">
		<div class="container">
			<?php if(function_exists('plains_breadcrumbs')): plains_breadcrumbs(false); endif;?>
