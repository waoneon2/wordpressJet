<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NCOC
 */

?>
<div class="col-md-3" id="col-of-sidebar">
<?php if( is_active_sidebar( 'sidebar-1' ) ): ?>
	<div class="content-sidebar" id="site-content-sidebar">
		<aside id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside><!-- #secondary -->
	</div><!-- #site-content-sidebar -->
<?php endif; ?>
</div><!-- .col-of-sidebar -->
	</div> <!-- .row -->