<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package US_Army
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="row">
      <div class="col-md-12 bottom_links">
        <?php
        if ( has_nav_menu( 'menu-2' ) ) {
          wp_nav_menu( array(
          'theme_location' => 'menu-2',
          'menu_class' => 'footer-nav',
          ));
        } else {
          esc_html_e( 'Primary Navigation', 'us-army' );
        }?>
      </div>
      <div class="col-md-12 copyrightNotice">
      <?php if(!get_theme_mod('footer_info_setting')): ?>
        © The Fort Hood Press Center is provided as a public service by Fort Hood and III Corps Public Affairs in coordination with Army Public Affairs.
        <span class="powered_by_jetty">
          <?php printf('<a href="%s" title="%s" target="_blank"><p>&copy; %s %s</p></a>', 'http://jettyapp.com','Jetty',date("Y"),'Proudly powered by Jetty'); ?>
        </span>
      <?php else: ?>
        <?php echo get_theme_mod('footer_info_setting'); ?>
      <?php endif; ?>
      </div>
    </div>
	</footer><!-- #colophon -->
	</div><!-- #page-container -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>