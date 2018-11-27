<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alabama_Policy_Institute
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
	<div class="header-mobile">
		<div class="container">
			<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu.png" alt=""></button></div>
			<div class="menu__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu.png" alt=""></a></div>
		</div>
	</div>

	<aside class="menu open-start">
		<div class="menu__content">
			<div class="menu__top">
				<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu--close.png" alt=""></button></div>
				<?php
				// get custom logo if applicable
				$custom_logo_id = get_theme_mod('custom_logo');
				if ($custom_logo_id):
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
					<div class="menu__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt=""></a></div>
				<?php else: ?>
					<div class="menu__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu.png" alt=""></a></div>
				<?php endif; ?>
			</div>
			<!-- Searh form -->
			<div class="search">
				<button class="search__icon">
					<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--search.png" alt="">
					<img class="search__icon--close" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--search--close.png" alt="">
				</button>
				<form class="search__form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<input class="search__input" type="search" name="s">
					<button class="search__submit" type="submit">Search <img class="search__submit__icon" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--right--white.png" alt=""></button>
				</form>
			</div>

			<nav class="menu__nav">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'	 => 'menu__list',
						'walker'		 => new Alabama_Nav_Walker(),
						'depth'			 => 2 // only allow 2
					) );
				?>
			</nav>
		</div>
		<div class="menu__content--closed">
			<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu.png" alt=""></button></div>
			<div class="menu__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu--closed.png" alt=""></a></div>
		</div>
	</aside>
	<div id="content" class="main-content open-start">
