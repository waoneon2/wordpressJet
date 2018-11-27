<?php
/**
 * The sidebar containing the main widget area on category template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LADWP
 */

if ( ! is_active_sidebar( 'sidebar-cat' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-cat' ); ?>
</aside><!-- #secondary -->
