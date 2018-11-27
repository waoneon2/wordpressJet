<?php global $wp_query; $cat_ID = get_query_var('cat'); ?>
<div class="category-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/categories/<?php echo $cat_ID; ?>.jpg');">
	<div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
        <?php if ( category_description() ) : // Show an optional category description ?>
        <div class="category-meta"><?php echo category_description(); ?></div>
        <?php endif; ?>
    </div>
</div>

<?php firecomps_get_top_posts($cat_ID); ?>

<div class="submit-a-case top-submit-a-case">
	<div class="wrapper">
		<p>Know of a case that’s not represented by FIRE?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case</a>
    </div>
</div>

<?php firecomps_walk_category($cat_ID); ?>

<div class="submit-a-case bottom-submit-a-case">
	<div class="wrapper">
		<p>Know of a case that’s not represented by FIRE?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case</a>
    </div>
</div>