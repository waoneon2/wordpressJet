<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cobalt
 */

?>


<div class="listing-post-archive">
	<div class="date"><?php the_time('F d, Y'); ?></div>
    <div class="head-link">
    	<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );?>
    </div>
</div>