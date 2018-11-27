<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package staytohelp
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-info">
				<?php 
				$fl = defaultAssetsImage('footer-setting');
					if (get_theme_mod('footer_logo') || !empty(get_theme_mod('footer_logo'))){
						$fl = get_theme_mod('footer_logo', defaultAssetsImage('footer-setting'));
					}
					echo '<div class="footer-icon"><a href='.esc_url( home_url( "/" ) ).'>';
					echo '<img src="'.$fl.'">';
					echo '</a></div>';
				 ?>
				<p class="footer-copyright">
					<?php 
					echo (get_theme_mod('footer_copyright')) ? get_theme_mod('footer_copyright').' ' : '© EasyBookingSite.com ';
					echo date('Y').'. All Rights Reserved.';
					?>
				</p>
				<?php 
					$media = array (
				        1 => 'facebook',
				        2 => 'twitter',
				        3 => 'google-plus',
				    );
				    $footer_media_social = array (
				    	1 => 'https://www.facebook.com/ezbookingsite/',
				        2 => 'https://twitter.com/ezbookingsite',
				        3 => 'https://plus.google.com/u/0/b/117233358843403602864/117233358843403602864'
				    	);
				 ?>
				<p class="social-list">
					<?php 
						for ($x=1; $x <=3 ; $x++) {
							$social = (get_theme_mod('footer_media_'.$media[$x])) ? get_theme_mod('footer_media_'.$media[$x]) : $footer_media_social[$x];
							if ($social) {
								echo '<a href="'.esc_url($social).'" target="blank"><i class="fa fa-'.$media[$x].' fa-fw"></i></a>';
							}
						}

					 ?>
                </p>
<?php echo get_theme_mod('sample_footer'); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
