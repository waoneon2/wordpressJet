<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Corporate
 */

?>
		</div><!-- .content-wrap -->
	</div><!-- #content -->

	<?php
		$footer_style = 'style="background-color:' . get_theme_mod( 'corporate_theme_footer_background_color', '#13509f' ) . ';"';
	?>
	<footer id="colophon" class="site-footer" role="contentinfo" <?php echo $footer_style; ?>>
		<div class="content-wrap">
			<div class="site-info">
				<div class="site-footer__menu">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
				</div>
				
				<p class="site-footer__credits">
					<?php echo get_theme_mod( 'corporate_theme_footer_credits', 'Another awesome Jetty site' ); ?>
				</p>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
