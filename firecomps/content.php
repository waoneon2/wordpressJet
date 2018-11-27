<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(); ?>
    </header><!-- .entry-header -->
    
    <div class="entry-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php endif; ?>
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
<?php else: ?>
<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if ($_cat): ?>
    <p class="category">Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?></p>
    <?php endif; ?>
	<?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; View Full Policy</a></p>
</div>
<?php endif; ?>