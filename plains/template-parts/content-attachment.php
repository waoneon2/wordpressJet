<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Plains
 */

?>

<article id="post-<?php the_ID(); ?> attachment-display" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php plains_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
    <img class="img-thumbnail img-responsive img-right" src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
    </p>
	<?php else : ?>
    <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html(get_the_title($post->ID)); ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
	<?php endif; ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->
