<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andeavor
 */

?>

	</div><!-- #content -->

		<footer id="colophon" class="footer">
			<div class="site-info container">
				<div class="copyright">
					<?php
						_e('©'.date(' Y '), 'andeavor');
						_e((get_theme_mod('footer_copyright')) ? get_theme_mod('footer_copyright').' ' : 'Andeavor Corporation.', 'andeavor');
						_e(' All rights reserved.','andeavor');
					?>
				</div>
				<div class="global-links">
					<?php
					$locations = get_nav_menu_locations();
					if(!empty($locations[ 'menu-2' ])){
						$menu = $locations[ 'menu-2' ] ;
						$menu_footer_array =  wp_get_nav_menu_items($menu);
						foreach ($menu_footer_array as $key => $value) :
							echo '<a href="'.$value->url.'">'.$value->title.'</a>';
						endforeach;
					}
					?>
				</div>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->

	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<style type="text/css">

</style>