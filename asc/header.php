<?php $asc_options = asc_theme_options(); ?>
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
	<div class="header-top">
		<div class="wrapper-inner clearfix">
			<aside class="asc-col asc-1-3 top-header-search">
				<?php get_search_form(); ?>
			</aside>
		</div>
	</div>

<?php  //if img background is set full width
if (get_theme_mod('img_back_opt') == 1 && get_theme_mod('img_back')) {
	?>
<div class="full-img-back-wrapper">
	<header class="asc-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="header-wrap clearfix">
			<div class="new-wrapper-full-img-back no-back" >
				<?php is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
				<div class="asc-col asc-1-3<?php echo $logo_class; ?>">
					<?php asc_logo(); ?>
				</div>
				<?php dynamic_sidebar('header-ad'); ?>
			</div>
		</div>

			<div class="new-wrapper-full-img-back header-menu clearfix" style="padding-bottom: 30px;">
				<nav class="main-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
				</nav>
				<div class="header-sub clearfix">
					<?php if ($asc_options['show_ticker']) { ?>
						<?php get_template_part('content', 'news-ticker'); ?>
					<?php } ?>
					<aside class="asc-col asc-1-3 header-search">
						<?php get_search_form(); ?>
					</aside>
				</div>
			</div>

	</header>
</div>
<div id="asc-wrapper">

	<?php
} else {

	?> 

<div id="asc-wrapper">
<header class="asc-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="header-wrap clearfix">
		<?php is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
		<div class="asc-col asc-1-3<?php echo $logo_class; ?>">
			<?php asc_logo(); ?>
		</div>
		<?php dynamic_sidebar('header-ad'); ?>
	</div>
	<div class="header-menu clearfix">
		<nav class="main-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
		<div class="header-sub clearfix">
			<?php if ($asc_options['show_ticker']) { ?>
				<?php get_template_part('content', 'news-ticker'); ?>
			<?php } ?>
			<aside class="asc-col asc-1-3 header-search">
				<?php get_search_form(); ?>
			</aside>
		</div>
	</div>
</header>
<?php } ?>