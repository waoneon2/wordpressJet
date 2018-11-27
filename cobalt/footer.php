<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cobalt
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( esc_html__( '&copy; Copyright %s, %s', 'cobalt' ), date("Y"), 'Cobalt International Energy' ); ?>
			<br />
			<?php printf( '<a href="%s" title="%s">%s</a>', 'http://jettyapp.com','Jetty','Proudly powered by Jetty' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
