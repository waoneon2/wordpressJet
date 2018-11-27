<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BP
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	  <div class="container">
	  	<div class="row">
		    <div class="col-md-12 col-sm-12">
		    	<nav id="site-footer-navigation" class="footer-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_id' => 'footer-menu', 'container' => false, 'menu_class' => 'legal pull-right clearfix' ) ); ?>
				</nav>
		    </div>
	    </div>
	 </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
