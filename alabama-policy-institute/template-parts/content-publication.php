<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(['content__box']); ?>>
	<?php alabama_policy_institute_post_thumbnail(); ?>
	<div class="content__inner">
		<?php if (get_post_type() === 'post'):

		endif; ?>
		<?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="content__date">
				<?php echo get_the_date(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="content__text">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
