<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oil_Spill_101
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container container">
		<div class="site-info">
			<?php printf( 'Copyright %d by %s', date('Y'), 'Oil Spill 101.wa.gov' ); ?>
		</div>
		<nav class="footer-menu">
			<div><a href="https://jettyapp.com">Powered by JETTY</a></div>
			<?php wp_nav_menu( array( 'menu' => 'Footer Nav','theme_location' => 'footer-menu' ) ); ?>
		</nav>
		</div> <!-- footer container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
