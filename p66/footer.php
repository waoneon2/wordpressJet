<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package p66
 */


$footlink[1]= get_theme_mod('footer_privacy');
$footlink[2]= get_theme_mod('footer_term');
$footlink[3]= get_theme_mod('footer_disclosure');
$flink = array();
for ($l=1; $l <= 3; $l++) {
	if ($footlink[$l]){
		$flink[$l] = get_the_permalink($footlink[$l]);
	} else {$flink[$l] = '#';}
}
?>


		<div class="footer-contain">
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-9  col-lg-10">
						<p>
							<span>© Phillips&nbsp;66 Company.</span> <span>All rights reserved.</span> <a href="<?php echo esc_url($flink[2]);  ?>">Terms&nbsp;and&nbsp;Conditions</a> and <a href="<?php echo esc_url($flink[1]);?>">Privacy Statement.</a> <a href="<?php echo esc_url($flink[3]);  ?>">California Transparency in Supply Chains Disclosure.</a>
						</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 social-contain">
						<ul class="social-icons">
						<?php
						   $media = array (
						        1 => 'facebook',
						        2 => 'twitter',
						        3 => 'instagram',
						        4 => 'youtube'
						    );
						   for ($m=1; $m <=4 ; $m++) :
						   		if (get_theme_mod('footer_media_'.$media[$m])):
						   			$link[$m] = get_theme_mod('footer_media_'.$media[$m]);
						   		?>
						   		<li>
						   			<a class="<?php echo $media[$m];?>" href="<?php echo esc_url($link[$m]); ?>" target="_blank">
						   				<span class="sr-only">
						   					Phillips&nbsp;66 on <?php echo ucwords($media[$m]);?>
						   				</span>
						   			</a>
						   		</li>
						<?php
								endif;
							endfor;
						 ?>
						</ul>
					</div>
				</div>
			</footer><!-- #colophon -->
		</div>
	</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
