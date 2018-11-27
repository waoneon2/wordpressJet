<?php
/*
Template Name: Cases
*/
?>
<?php

/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php global $wp_query; $cat_ID = get_query_var('cat'); ?>
		<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
	<div class="wrapper clearfix">
        <h1 class="category-title"><?php the_title(); ?></h1>

    </div></div>
    
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php the_title(); ?></h1>
    </div>
</div>

    <?php firecomps_get_top_posts_cases(); ?>
    
   <div class="submit-a-case top-submit-a-case">
	<div class="wrapper">
		<p>Need FIRE's Help?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case or question</a>
    </div>
</div>
<?php firecomps_walk_category_cases(); ?>

<div class="submit-a-case bottom-submit-a-case">
	<div class="wrapper">
		<p>Need FIRE's Help?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case or question</a>
    </div>
</div>
<?php  get_footer(); ?>