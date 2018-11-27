<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nasa_JSC
 */

?>

	<footer id="colophon" class="site-footer container" role="contentinfo">
    <?php
    if ( has_nav_menu( 'menu-2' ) ) {
      wp_nav_menu( array(
        'theme_location' => 'menu-2',
        'menu_class' => 'nav nav-pills'
      ) );
    } else {
      esc_html_e( 'Footer Navigation', 'nasa_jsc' );
    }?>
    <?php 
    $nasaJscFooterLink = "";
    if(get_theme_mod('footer_info_setting')):
      $nasaJscFooterLink = get_theme_mod('footer_info_setting');
      echo $nasaJscFooterLink;
    else:
      printf('<a href="%s" title="%s" target="_blank"><p>&copy; %s %s</p></a>', 'http://jettyapp.com','Jetty',date("Y"),'Proudly powered by Jetty'); 
    endif;
    ?>
	</footer><!-- #colophon -->

  </div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
