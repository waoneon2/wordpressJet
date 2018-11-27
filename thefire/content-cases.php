<?php 
global $wp_query; 
global $post;
$cat_ID = get_query_var('cat');
$details = get_field('banner_image', 'category_'. $cat_ID .''); 

?>
<div class="category-header" style="background-image: url('<?php if(!empty($details)) { echo $details; } else { echo '/wp-content/uploads/2014/01/default-banner.jpg'; } ?>');">
	<div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>

<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>

<?php firecomps_get_top_posts($cat_ID); ?>

<div class="submit-a-case top-submit-a-case">
	<div class="wrapper">
		<p>Need FIRE's Help?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case or question</a>
    </div>
</div>

<?php firecomps_walk_category($cat_ID); ?>

<div class="submit-a-case bottom-submit-a-case">
	<div class="wrapper">
		<p>Need FIRE's Help?</p>
        <a href="<?php echo home_url( '/resources/submit-a-case' ); ?>">Submit a case or question</a>
    </div>
</div>