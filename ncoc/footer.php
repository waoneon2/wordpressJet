<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NCOC
 */

?>
<div class="row" id="row-of-footer">
<div class="col-md-3"></div>
<div class="col-md-9" id="col-of-footer">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php wp_nav_menu(
			array (
			'theme_location' => 'footer-menu',
			'menu' => 'footer-menu',
			'container' => 'div',
			'container_class' => 'site-info', 
			'container_id' => 'ncoc-footer-menu', 
			'depth' => 1,
			'items_wrap' => '%3$s',
			'walker' => new Footer_menu_Walker()
			)
		); ?>
	</footer><!-- #colophon -->
</div><!-- #col-of-footer -->
</div><!-- #row-of-footer -->

<div class="row" id="row-of-copyright">
	<div class="col-md-offset-9">
		<div class="rPlanguages"><?php _e("© North Caspian Operating Company","ncoc_copyright"); ?></div>
	</div>
</div><!-- #row-of-copyright -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
