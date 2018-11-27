<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row">
						<div class="col-md-12 clearfix">
							<div class="doc-list-full-item clearfix">
							  <div class="col-md-10 col-sm-10">
									<small><?php echo get_the_date() ?></small>
									<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							  </div>
							  <?php if ( is_search() ) : // Only display Excerpts for Search ?>
									<div class="col-md-2 col-sm-2">
									    <div class="pull-right">
									        <span class="label label-warning"><?php the_category( ', ' ); ?></span>
									    </div>
									</div>
								<?php endif; ?>
							</div>
						</div>
				  </div>
	</article><!-- #post -->

<style type="text/css">
	a {
		color: #039;
	}
	.doc-list-full-item {
	    border-bottom: 1px solid #EEEEEE;
	    padding-top: 10px;
	    padding-bottom: 10px;
	}
</style>
