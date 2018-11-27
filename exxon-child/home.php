<?php
/**
 * Template Name: Exxon Home
 * 
 */


get_header(); ?>

<div class="front-exxon-sidebar row"><?php dynamic_sidebar( 'front-sidebar' ); ?></div>
<?php get_footer(); ?>

<script type="text/javascript">
	jQuery('.front-exxon-sidebar  aside').addClass('col col-xs-12 col-sm-6 col-md-6 col-lg-3 clearfix');
</script>