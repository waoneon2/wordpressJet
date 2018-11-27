<?php $houston_uasi_options = houston_uasi_theme_options(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if (is_singular() && pings_open(get_queried_object())) : ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php if (has_nav_menu('header_nav') || has_nav_menu('social_nav')) { ?>
	<div class="header-top">
		<div class="wrapper-inner clearfix">
			<?php if (has_nav_menu('header_nav')) { ?>
				<nav class="header-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'header_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php } ?>
			<?php if (has_nav_menu('social_nav')) { ?>
				<nav class="social-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-houston-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<?php  //if img background is set full width
if (get_theme_mod('img_back_opt') == 1 && get_theme_mod('img_back')) {
	?>
<div class="full-img-back-wrapper">
	<header class="houston-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="header-wrap clearfix">
			<div class="new-wrapper-full-img-back no-back" >
				<?php is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
				<div class="houston-col houston-1-3<?php echo $logo_class; ?>">
					<?php houston_uasi_logo(); ?>
				</div>
				<?php dynamic_sidebar('header-ad'); ?>
			</div>
		</div>

			<div class="new-wrapper-full-img-back header-menu clearfix" style="padding-bottom: 30px;">
				<nav class="main-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
				</nav>
				<div class="header-sub clearfix">
					<?php if ($houston_uasi_options['show_ticker']) { ?>
						<?php get_template_part('content', 'news-ticker'); ?>
					<?php } ?>
					<aside class="houston-col houston-1-3 header-search">
						<?php get_search_form(); ?>
					</aside>
				</div>
			</div>

	</header>
</div>
<div id="houston-wrapper">

	<?php
} else {

	?> 

<div id="houston-wrapper">
<header class="houston-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="header-wrap clearfix">
		<?php is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
		<div class="houston-col houston-1-3<?php echo $logo_class; ?>">
			<?php houston_uasi_logo(); ?>
		</div>
		<?php dynamic_sidebar('header-ad'); ?>
	</div>
	<div class="header-menu clearfix">
		<nav class="main-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
		<div class="header-sub clearfix">
			<?php if ($houston_uasi_options['show_ticker']) { ?>
				<?php get_template_part('content', 'news-ticker'); ?>
			<?php } ?>
			<aside class="houston-col houston-1-3 header-search">
				<?php get_search_form(); ?>
			</aside>
		</div>
	</div>
</header>
<?php } ?>