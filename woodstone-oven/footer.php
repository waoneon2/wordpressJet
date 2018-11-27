<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Woodstone_Oven
 */

?>

	</div><!-- #content -->

<div class="container-fluid bg-light" style="margin-top: 160px;">
	<!-- #colophon -->

	<footer id="colophon" class="site-footer" >	
		<div class="page-footer font-small ">
			  <div class="footer-copyright text-center py-3">
			  	<div class="site-info">
						<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'wso' ), 'wso', '<a href="http://mossyrock.us">Mossyrock</a>' );
						?>
						<span class="sep"> / </span>
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wso' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'wso' ), 'WordPress' );
							?>
						</a>
					</div><!-- .site-info -->
			  </div>
		</div>
	</footer>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
