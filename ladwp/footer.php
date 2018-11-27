<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LADWP
 */

?>

	</div><!-- #content -->
		</div><!-- #ladwp_container_content -->
			</div><!-- #ladwp_row_content -->
<?php
	function printFooterImage() {
		$image = get_header_image();
		if ( '' == $image ) {
			$image = get_template_directory_uri() . '/img/ladwp_logo_footer.png';
		}
		echo( $image );
	}
?>
<div class="container footer-container" id="ladwp_container_footer">
	<div class="row" id="ladwp_row_footer">
	<footer id="colophon" class="site-footer wrapper" role="contentinfo">
		<div class="footer-links wrapper">
				<div class="col col-md-3 col-xs-12 powered-by hidden-xs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="Life. Powered by Edison." class="cq-dd-image" src="<?php printFooterImage() ?>" title="Life. Powered by Edison."></a>
				</div>
				<div class="col col-md-6 col-xs-12 footer-section visit">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-1',
							'menu_id' => 'other_dwp_sites_footer',
							'container_class' => 'dwp_sites clearfix hidden-xs',
							'walker' => new ladwp_mobile_walker_nav_menu()
						)
					) ?>
					<nav  class="mobile-navigation hidden-lg hidden-md hidden-sm" role="navigation" >
						<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-1',
							'menu_id' => 'other_dwp_sites_footer_mobile',
							'container_class' => 'dwp_sites clearfix',
							'walker' => new ladwp_mobile_walker_nav_menu()
						)) ?>
					</nav>
				</div>
				<div class="col col-md-3 col-xs-12 footer-section connect">
					<h2 >CONNECT WITH US</h2>
					<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-2',
							'menu_id' => 'social_footer',
							'container_class' => 'social-icons clearfix',
							'walker' => new ladwp_social_nav()
						)
					) ?>
				</div>
		</div>
		<div class="footer-nav">
				<div class="list-links">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-3',
							'menu_id' => 'list-links',
							'container_class' => 'cont-list-links',
							'walker' => new ladwp_mobile_walker_nav_menu()
						)
					) ?>
				</div>
				<div class="copyright">
				<?php
					$get_link = get_theme_mod('ladwp_setting_copyright_footer');
					$get_link_url = get_theme_mod('ladwp_setting_link_copyright_footer');

					if(!empty($get_link)):
						if(!empty($get_link_url)):
							printf('<a href="%s" target="_blank"><p>%s</p></a>', esc_url($get_link_url), $get_link);
							else :
								printf('<p>%s</p>', $get_link);
								endif;
					else:
						printf('<a href="%s" title="%s" target="_blank"><p>&copy; %s %s</p></a>', 'http://jettyapp.com','Jetty',date("Y"),'Proudly powered by Jetty');
					endif;
				?>
				</div>
		</div>
	</footer><!-- #colophon -->
	</div><!-- #ladwp_container_footer -->
</div><!-- #ladwp_row_footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<style type="text/css">

</style>
