<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plains
 */

?>
    </div><!--.container-->
	</div><!-- #content -->

	<footer>
		<div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php
            if ( has_nav_menu( 'menu-2' ) ) {
              wp_nav_menu( array(
             'theme_location' => 'menu-2',
             'menu_id' => 'footer-menu',
             'menu_class' => 'list-unstyled list-inline text-left',
             'walker' => new plains_walker_nav_menu()) );
            } else {
              esc_html_e( 'Footer Navigation', 'plains' );
            }?>
          </div>
        </div>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
