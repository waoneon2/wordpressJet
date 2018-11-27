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
                    	<?php printf(__('Copyright 2013. <a href="%s" title="%s">%s</a>. All Rights Reserved.', 'firecomps'), esc_url( home_url( '/' ) ), esc_attr( get_bloginfo( 'name', 'display' ) ), get_bloginfo( 'name', 'display' )); ?>
                    </p>
                    <ul class="site-social-bookmarking2">
                        <li><a href="#" class="ico_facebook"></a></li>
                        <li><a href="#" class="ico_googleplus"></a></li>
                        <li><a href="#" class="ico_twitter"></a></li>
                        <li><a href="#" class="ico_printest"></a></li>
                        <li><a href="<?php bloginfo( 'rss2_url' ); ?>" class="ico_rss"></a></li>
                    </ul>
                </div>
            </div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>