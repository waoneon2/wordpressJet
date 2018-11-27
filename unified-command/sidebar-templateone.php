<?php
/**
 * The sidebar containing the template#1
 *
 * If no active widgets are in either sidebar, hide them completely.
 */
if ( ! is_active_sidebar( 'sidebar-templateone' ) )
	return;

// If we get this far, we have widgets. Let do this.
?>
<div id="secondary" class="widget-area templateone" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-templateone' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-templateone' ); ?>
	<?php endif; ?>
</div><!-- #secondary -->