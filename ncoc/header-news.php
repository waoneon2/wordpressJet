<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NCOC
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
<div id="page" class="site container">
<div class="row" id="row-of-languages">
<!-- <div class="col-md-3"></div> -->
<div class="col-md-offset-9" id="col-of-languages">
	<div class="rPlanguages" style="text-align:left">
		<?php icl_post_languages(); ?></div>
</div><!-- #col-of-languages -->
</div><!-- #row-of-languages -->

	<div class="row">
	<div class="col-md-3" id="first-col-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ncoc' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<?php 
		function printHeaderImage() {
			$headerImage = get_header_image();
				if ( '' == $headerImage ) {
					$headerImage = get_template_directory_uri() . '/images/logo/ncoc_logo.png';
				}
					echo( $headerImage );
		}
	?>
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php else : ?>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php
			endif;

			//$description = get_bloginfo( 'description', 'display' );
			//if ( $description || is_customize_preview() ) : ?>
				<p style="display:none;" class="site-description"><?php //echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			//endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
	<nav id="site-navigations" class="main-navigations" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ncoc' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->

		</div> <!-- #first-col-header -->
	<div class="col-md-9" id="col-of-content">
	<div class="row" id="header-color">
<!-- <div class="col-md-2"></div> -->
<?php 
$cat_pub = get_the_category();
$status = false;
$img = "";
$cat_desc = "";

for ($i=0; $i < count($cat_pub) ; $i++) { 
	$cat_id = $cat_pub[$i]->term_id;
	$cat_desc = category_description($cat_id);
	$cat_data = get_option("category_$cat_id");
	if(isset($cat_data['img'])){
		$status = true;
		$img = $cat_data['img'];
	}
}

?>
<?php if($status) : ?>
<div class='col-md-6' id='col-header-news-img-color' style='background-image: url(<?php echo $img; ?>) !important;'>
<?php else: ?>
<div class="col-md-6" id="col-header-news-img-color">
<?php endif; ?>
	<div class="ncoc-news-header">
		<h1 class="head-title-news">
			&nbsp;
		</h1>
	</div>
</div><!-- #col-header-news-color -->
<div class="col-md-6" id="col-header-news-color">
	<div class="ncoc-news-header">
		<h1 class="head-title-news">
			<?php _e('News and Events', 'ncoc'); ?>
		</h1>
		<div class="entry-desc">
			<?php echo $cat_desc; ?>
		</div>
	</div>
</div><!-- #col-header-news-color -->
</div><!-- #header-color -->

<div class="row" id="ncoc-breacrumbs">
	<!-- <div class="col-md-2"></div> -->
	<div class="col-md-12" id="col-ncoc-breadcrumbs">
		<?php if(function_exists('ncoc_breadcrumbs')) ncoc_breadcrumbs(); ?>
	</div><!-- #col-ncoc-breadcrumbs -->
</div><!-- #ncoc-breadcrumbs -->

	<div id="content" class="site-content row">
