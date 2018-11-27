<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aral
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="row footer-site">
	<div class="small-12 large-6 columns">
		<!--div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'aral' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'aral' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'aral' ), 'aral', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div--><!-- .site-info -->
		</div>
	<div class="small-12 large-6 columns">
	    	<nav id="site-footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_id' => 'footer-menu' ) ); ?>
		</nav>
	    </div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
