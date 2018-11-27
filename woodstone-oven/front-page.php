<?php get_header(); ?>

<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-md-8">
			<?php 
				// $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
				if ( get_query_var( 'paged' ) ) { 
					$paged = get_query_var( 'paged' ); 
				}
				elseif ( get_query_var( 'page' ) ) { 
					$paged = get_query_var( 'page' ); 
				}
				else { 
					$paged = 1; 
				}

				$args = array(
		            'post_type' => 'post',
		            'post_status'    => 'publish',
		            'posts_per_page' => '5',
		            'paged'          => $paged
		          );
	          	$the_query = new WP_Query( $args ); 
	        ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

				<?php
				if ( $the_query->have_posts() ) {
				
					while ( $the_query->have_posts() ) 
					{
						$the_query->the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					}

					echo '<div class="alert bg-light text-center">';
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, $paged ),
						'total' => $the_query->max_num_pages
					) );
					echo '</div>';

				}

				else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?> 
		</div>

		<div class="col-md-4">
			 <?php get_sidebar() ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
	    jQuery('.widget > ul').addClass('list-group');
	    jQuery('.widget > ul > li').addClass('list-group-item borderless');
	});
</script>

<?php get_footer(); ?>