<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chevron
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'chevron' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding container centered width-1280">

		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo('title', 'display'); ?>  </a></p>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar navbar-default centered">
			<div class="container-fluid">
				<div class="navbar-header centered">
					<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
					<div class="hamburger-mobile pull-left hidden-sm hidden-md hidden-lg dropdown dropdown-mobile">
					    <a href="#" class="dropdown-toggle pull-left"  aria-expanded="false">
					        <span class="glyphicon glyphicon-menu-hamburger black burger-icon" aria-hidden="true"></span>
					    </a>
					    <div class="navbar-mobile dropdown-menu dropdown-menu-mobile row hidden-sm hidden-md hidden-lg font-gotham" id="navbar-brand-mobile" style="display: none;">

					        <div class="mobile-nav-container">
					            <div class="nav navbar-nav primary">
												<!-- Loop Nav Header -->
												<?php
												$locations_h = get_nav_menu_locations();
												$menu_id1 = (isset($locations_h[ 'menu-1' ])) ? $locations_h[ 'menu-1' ] : '';
												$menu_id2 = (isset($locations_h[ 'menu-2' ])) ? $locations_h[ 'menu-2' ] : '';

												if ($menu_id1 && $menu_id2) :
													$menu_left_array =  wp_get_nav_menu_items($menu_id1);
													$menu_right_array =  wp_get_nav_menu_items($menu_id2);

													$menu_array = array_merge($menu_left_array,$menu_right_array);
													foreach ($menu_array as $key => $value) :
														$parentID = $value->ID;
														$parent = ($value->menu_item_parent == 0) ? 1 : 0;
														if ($parent): ?>
													    <div class="offcanvas menu-hover clearfix offcanvas-toggle clickable theme-bg-light-blue" data-toggle="offcanvas">
													        <a class="offcanvas-link vertical-align ie10-flex-start" href="#"><span class="link-text"><?php echo $value->title; ?></span></a>
													        <div class="row row-offcanvas row-offcanvas-right">
													            <div class="col-xs-12 col-sm-12 sidebar-offcanvas" role="navigation">
													                <div class="main-menu-link clearfix offcanvas-toggle pull-left" data-toggle="offcanvas-hide">
													                    <a href="#" class="pull-left clearfix"><span class="glyphicon glyphicon-menu-left"></span><span>back to main menu</span> </a>
													                </div>
													                <div class="sub-menu clear-both">

													                    <div class="nav-header-2"><?php echo $value->title; ?></div>

													                    <div class="secondary menu-hover clearfix">
													                        <a href="<?php echo $value->url ?>" target=""></span><span class="link-text">overview</span></a>
													                    </div>
													                    <?php foreach ($menu_array as $key => $cvalue): ?>
													                    	<?php $child = ($cvalue->menu_item_parent == $parentID) ? 1 : 0; ?>
													                    	<?php if ($child): ?>
													                      	<div class="secondary menu-hover clearfix">
													                      	    <a href="<?php echo $cvalue->url ?>" target=""></span><span class="link-text"><?php echo $cvalue->title ?></span></a>
													                      	</div>
													                    	<?php endif ?>
													                    <?php endforeach ?>
													                </div>
													                <hr class="divider divider-width-1920 bottom-divider theme-bg-color">
													            </div>
													        </div>
													    </div>
													  <?php endif ?>
													<?php endforeach ?>
												<?php endif ?>
												<!-- End Loop Nav Header -->
					            </div>

					            <div class="search-bar font-gotham bg-offwhite">
					                <div class="width-1280 centered">
					                    <form action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get" class="contained">
					                      <div class="input-group input-group-lg search-bar-container" id="cludo-search-meganav" role="search">
					                          <span class="input-group-addon glyphicon glyphicon-search"></span>
					                          <label class="placeholder font-gotham-narrow" for="cludo-search-meganav-input">what can we help you finds?</label>
					                          <input id="cludo-search-meganav-input" name="s" type="text" class="form-control search-input font-gotham-narrow" placeholder="what can we help you find?">
					                          <a href="javascript:void(0)" class="input-group-addon clear-search-link clear-button cludo-search-query-clear cludo-hidden">
					                            <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
					                            <span class="clear-search">clear</span>
					                          </a>
					                          <div class="buttons pull-right">
					                              <button class="input-group-addon search-button" type="submit" title="search">
					                                <span class="dashicons dashicons-arrow-right-alt">
					                                  <span class="sr-only">search</span>
					                                </span>
					                              </button>
					                          </div>
					                      </div>
					                    </form>
					                </div>
					            </div>

					            <hr class="divider divider-width-1920 bottom-divider bg-light-blue">
					        </div>
					        <div class="mobile-nav-backdrop"></div>
					        <!-- <div class="mobile-nav-backdrop" style="height: 7690px;"></div> -->

					    </div>
					</div>
					<div class="navbar-brand navbar-brand-centered visible-xs">
						<a class="hallmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Chevron">
							<img alt="Chevron" src="<?php echo printHeaderImage() ?>" width="45" height="50">
						</a>
					</div>
					<div class="search search-mobile pull-right hidden-sm hidden-md hidden-lg dropdown dropdown-mobile open">
						<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" aria-expanded="true">
							<span class="glyphicon glyphicon-search black lop-icon" aria-hidden="true"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-mobile search-container" style="display: none;">
							<div class="search-bar font-gotham bg-offwhite">
								<div class="width-1280 centered">
								 	<form action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get" class="contained">
										<div class="input-group input-group-lg search-bar-container" id="cludo-search-navright-mobile" role="search">
											<span class="input-group-addon glyphicon glyphicon-search"></span>
											<label class="placeholder font-gotham-narrow" for="cludo-search-navright-mobile-input">what can we help you find?</label>
											<input id="cludo-search-navright-mobile-input" name="s" type="text" class="form-control search-input font-gotham-narrow" placeholder="what can we help you find?">
											<a href="javascript:void(0)" class="input-group-addon clear-search-link clear-button cludo-search-query-clear cludo-hidden">
												<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
												<span class="clear-search">clear</span>
											</a>
											<div class="buttons pull-right">
												<button class="input-group-addon search-button" type="submit" title="search">
													<span class="dashicons dashicons-arrow-right-alt">
														<span class="sr-only">search</span>
													</span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
					<div class="collapse navbar-collapse js-navbar-collapse centered row hidden-xs font-gotham">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'chevron' ); ?></button>
						<?php
						if ( has_nav_menu( 'menu-1' ) ) {
							wp_nav_menu( array(
								'theme_location'    => 'menu-1',
								'menu_class'        => 'nav navbar-nav navbar-left',
								'container'         => false,
								'walker'            => new chevron_walker_nav_menu())
							);

						} else {
							echo '<div class="nav navbar-nav navbar-left">please set the "Primary left"</div>';
						}
						?>
						<div class="navbar-brand navbar-brand-centered">
						    <a class="hallmark" href="/" title="Chevron">
						    	<img alt="Chevron" src="<?php echo printHeaderImage() ?>" width="45" height="50">
						    </a>
						</div>
						<?php

						if ( has_nav_menu( 'menu-2' ) ) {
							wp_nav_menu( array(
								'theme_location'    => 'menu-2',
								'menu_class'        => 'nav navbar-nav navbar-right',
								'container'         => false,
								'walker'            => new chevron_walker_nav_menu())
							);
						} else {
							echo '<div class="nav navbar-nav navbar-right">please set the "Primary right"</div>';
						}
						?>
					</div>
				</div>
		</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

	<style type="text/css">


			/*mobile search*/


	</style>

