<?php
define( 'LAYOUT_BLOG',      'blog' );
define( 'LAYOUT_DASHBOARD', 'widget-dashboard' );
define( 'LAYOUT_DEFAULT',   LAYOUT_BLOG );

function get_theme_layout() {
	return get_theme_mod( 'corporate_theme_layout', LAYOUT_DEFAULT );
}
?>
