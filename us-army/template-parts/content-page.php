<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package US_Army
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="page-header <?php if(has_gform()): echo 'on_gravity_form'; endif; ?>">
			<div class="entry-meta">
				<?php us_army_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->
</article><!-- #post-## -->
