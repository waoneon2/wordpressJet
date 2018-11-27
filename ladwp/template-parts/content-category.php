<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LADWP
 */

?>

<article id="clearfix newsBodypost-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if ( is_single() ) :
			the_title( '<p class="bold">', '</p>' );
		else :
			the_title( '<p class="bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
		endif;

		?>
		<div class="entry-meta">
			<p class="small"><?php ladwp_posted_on(); ?></p>
		</div><!-- .entry-meta -->


	<div class="entry-content desc">
		<?php the_excerpt() ?>
		<p><a href="<?php echo esc_url( get_permalink() ) ?>"><i class="fa fa-chevron-circle-right"></i>Read More</a></p>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
<hr class="thin">
