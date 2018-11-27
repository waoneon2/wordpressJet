<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */

$default_permalink = esc_url( get_permalink() );
$url_file = esc_url(jetty_get_the_excerpt(get_the_ID()));
$link_validation = parse_url($url_file);
if(count($link_validation) >= 3){
	$default_permalink = $url_file;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', $default_permalink ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ncoc_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php ncoc_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
