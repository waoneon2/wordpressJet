<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package US_Army
 */

if ( ! is_active_sidebar( 'sidebar-column-page' ) ) {
	return;
}
?>


<?php dynamic_sidebar( 'sidebar-column-page' ); ?>

