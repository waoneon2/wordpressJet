<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
			
	if ( function_exists( 'sharing_display' ) ) {
		sharing_display( '', true );
	}
	 
	if ( class_exists( 'Jetpack_Likes' ) ) {
		$custom_likes = new Jetpack_Likes;
		echo $custom_likes->post_likes( '' );
	}

	?>
    <span class="entry-header">
		<?php the_title(); ?>
    </span><!-- .entry-header -->
    
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
     <?php $author = get_the_author();?>
    <p class="category">
    
         <?php if( !empty( $author ) && get_query_var('cat') != 16 && get_query_var('cat') != 529 && get_query_var('cat') != 19 && get_query_var('cat') != 18 && get_query_var('cat') != 504 ) : // Checks Insititutions if it has a type.   ?>     
			By <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?><br />
         <?php  else :?>
			<?php echo get_the_date(); ?> <br />
         <?php  endif; ?>
    
    
     
    Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?></p>
    <?php endif; ?>
	<?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>
<?php endif; ?>