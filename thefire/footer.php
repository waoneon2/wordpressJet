<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
        	<div class="wrapper clearfix">
                <nav id="site-links" class="navigation supp-navigation" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-supp' ) ); ?>
                </nav><!-- #site-links -->
            </div>
            <div class="site-info">
            	<div class="wrapper clearfix">
                    <?php //do_action( 'twentythirteen_credits' ); ?>
                    <p class="site-copyright">
                    	<a href="http://www.eresources.com"><img src="<?php echo get_template_directory_uri(); ?>/images/eRes_Brand_White.png" style="margin: 0 20px -5px 0;" /></a>
                    	<?php printf(__('Copyright 2015. <a href="%s" title="%s">%s</a>. All Rights Reserved. | <a href="/about-us/privacy-policy/" title="Privacy policy">Privacy policy</a>', 'firecomps'), esc_url( home_url( '/' ) ), esc_attr( get_bloginfo( 'name', 'display' ) ), get_bloginfo( 'name', 'display' )); ?>
                    </p>
                    <ul class="site-social-bookmarking2">
                        <li><a href="https://www.facebook.com/thefireorg" class="ico_facebook"></a></li>
                        <li><a href="http://www.youtube.com/thefireorg" class="ico_youtube"></a></li>
                        <li><a href="https://twitter.com/TheFIREorg" class="ico_twitter"></a></li>
                        <li><a href="<?php bloginfo( 'rss2_url' ); ?>" class="ico_rss"></a></li>
                    </ul>
                </div>
            </div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
	
    <?php
	  //echo '<pre>';
	  //var_dump( wp_footer() );
	  //echo '</pre>';
	  //var_dump( $wp_styles );
	  ?>
</body>
</html>