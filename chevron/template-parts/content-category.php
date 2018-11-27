<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chevron
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header-cat">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="list-item"><div class="row story-row centered">
			    <div class="col col-sm-12 col-sm-8 col-md-10 left-col">
			    	<?php the_title( sprintf( '<h3 class="headline text-left"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			    	<p class="summary black">
			    		<?php echo excerpt_learnmore(20) ?>
			    	</p>
			        <p class="bottom">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="arrow-link medium-blue ui-link"><span>learn <span class="text-nowrap">more</span><span class="dashicons dashicons-arrow-right-alt2"></span></span></a>        
					</p>
			    </div>
			    <div class="hidden-xs col col-sm-4 col-md-2 black text-right">
			        <p class="date">
			        	<?php echo get_the_time("j/n/Y"); ?>
			        </p>			        
			        <p class="category">
			        	<?php the_category() ?>
			        </p>
			    </div>
			</div></div>
		<?php endif; ?>
	</header><!-- .entry-header -->

</article><!-- #post-## -->


 