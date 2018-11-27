<?php
/**
 * Template Name: Sticky Post and Three Widget
 * @package aramco
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php echo get_sticky_post(); ?>

	<!-- 3 column  widget -->
    <div class="row">
        <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 three-column-sidebar align-center">
            <?php dynamic_sidebar( 'sidebar-1-column' ); ?>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 three-column-sidebar align-center">
            <?php dynamic_sidebar( 'sidebar-2-column' ); ?>
        </div>
		<div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 three-column-sidebar align-center">
			<?php dynamic_sidebar( 'sidebar-3-column' ); ?>
		</div>
    </div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
