<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chevron
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
			<div class="list-item">
				<div class="row story-row centered">
			    	<?php the_title( sprintf( '<h3 class="headline text-left"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			    	<p class="summary black">
			    		<?php echo excerpt_learnmore(20) ?>
			    	</p>
			    </div>
			</div>
	</header><!-- .entry-header -->

</article><!-- #post-<?php //the_ID(); ?> -->
 