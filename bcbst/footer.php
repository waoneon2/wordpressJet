<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlueCross_BlueShield_of_Tennessee
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container">
		<div class="row">

			<?php if (trim(get_theme_mod('footer_contact_us'))): ?>
				<div class="col-md-3 footer-margin">
					<p>We're Here to Help</p>
					<a target="blank" href="<?php echo (get_theme_mod('footer_contact_us'))? esc_url(get_theme_mod('footer_contact_us')) : '#'; ?>"><h1>Contact Us</h1></a>
				</div>
				<?php if (trim(get_theme_mod('footer_media_facebook')) || trim(get_theme_mod('footer_media_twitter')) || trim(get_theme_mod('footer_media_youtube'))): ?>
					<?php $footer_nav_col = 'col-md-7 border-right border-left'; ?>
				<?php else: ?>
					<?php $footer_nav_col = 'col-md-9 border-left'; ?>
				<?php endif ?>
			<?php else: ?>
				<?php if (trim(get_theme_mod('footer_media_facebook')) || trim(get_theme_mod('footer_media_twitter')) || trim(get_theme_mod('footer_media_youtube'))): ?>
					<?php $footer_nav_col = 'col-md-10 border-right'; ?>
				<?php else: ?>
					<?php $footer_nav_col = 'col-md-12'; ?>
				<?php endif ?>
			<?php endif ?>

			<div class="<?php echo $footer_nav_col ?> footer-margin">
				<?php
					if (has_nav_menu( 'menu-2' )) {
						wp_nav_menu( array(
							'theme_location' 	=> 'menu-2',
							'menu_id'        	=> 'footer-menu',
							'container_class' 	=> 'nav-container',
							'menu_class'      	=> 'nav navbar-nav',
						) );
					} else {
						?> <ul><li>footer nav</li></ul> <?php
					}
				?>
				<small>
					<?php if (trim(get_theme_mod('footer_text'))): ?>
						<?php
							echo date('Y').' '.get_theme_mod('footer_text');
						?>
					<?php endif ?>
				</small>
			</div>
			<div class="col-md-2 footer-margin">
				<?php if (trim(get_theme_mod('footer_media_facebook')) || trim(get_theme_mod('footer_media_twitter')) || trim(get_theme_mod('footer_media_youtube'))): ?>
					<p>Follow Us On:</p>
				<?php endif ?>
				<?php
					$media = array (
				        1 => 'facebook',
				        2 => 'twitter',
				        3 => 'youtube',
				    );
				    $footer_media_social = array (
				    	1 => 'https://www.facebook.com/',
				        2 => 'https://twitter.com/',
				        3 => 'https://youtube.com/'
				    	);
				 ?>
				<p class="social-list">
					<?php
						for ($x=1; $x <=3 ; $x++) {
							$customize_social = get_theme_mod('footer_media_'.$media[$x]);
							$social = (get_theme_mod('footer_media_'.$media[$x])) ? get_theme_mod('footer_media_'.$media[$x]) : $footer_media_social[$x];
							if ($social && trim($customize_social)) {
								echo '<a class="social-footer" href="'.esc_url($social).'" target="blank"><img src="'.get_template_directory_uri().'/img/so-'.$media[$x].'.png"></a>';
							}
						}

					 ?>
                </p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
