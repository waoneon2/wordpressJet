<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" id="title-custom">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<div class="l_nc">
		<?php
			the_content();
		?>
	</div>
		<?php 
		$get_child = get_children_pages_by_page_id(get_the_ID());
		foreach($get_child as $s){
			$page = $s->ID;
	        $content = $s->post_excerpt;
	        $content = apply_filters('the_content',$content);
	        $content = str_replace(']]>', ']]>', $content);
		?>
		<div class="col-md-6" id="content-child">
		<div class="header-title">
			<header class="page-header-child">
				<h1 class="page-title on-child">
					<a href="<?php echo esc_url( get_permalink( $page ) ); ?>">
					<?php _e($s->post_title,"ncoc"); ?>
					</a>
				</h1>
			</header>
			<div class="content-for-child">
			<?php if(has_post_thumbnail($page)) : ?>
				<div class="col-md-4">
					<img src="<?php echo get_the_post_thumbnail_url($page); ?>" class="img-responsive img-thumbnail">
				</div>
				<div class="col-md-8">
					<?php _e($content,"ncoc"); ?>
				</div>
			<?php else: ?>
				<div class="col-md-12">
					<?php _e($content,"ncoc"); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	    </div>
	    <?php
	    }
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						esc_html__( 'Edit %s', 'ncoc' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
