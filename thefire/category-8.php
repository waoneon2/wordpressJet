<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header();

global $wp_query, $query_string;
global $post;
$cat_ID = get_query_var('cat');
$details = get_field('banner_image', 'category_'. $cat_ID .'');
$limit = isset($_GET['limit']) ? sanitize_text_field($_GET['limit']) : null;

if(empty($details)) {
	$details = get_field('banner_image', 'category_'. get_top_parent_category($cat_ID) .''); 
}

function get_top_parent_category($cat_ID){
	$cat = get_category( $cat_ID );
	$new_cat_id = $cat->category_parent;

	if($new_cat_id != "0"){
		return (get_top_parent_category($new_cat_id));
	}
	return $cat_ID;
}

?>
<div class="category-header" style="background-image: url('<?php if(!empty($details)) { echo $details; } else { echo 'http://fire2.eresources.ws/wp-content/uploads/2014/01/default-banner.jpg'; } ?>');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content entry-content " role="main">
        <?php
        if((isset($limit)) && (null !== $limit) && ("all" === $limit)){
            query_posts($query_string . '&posts_per_page=-1');
        }
        ?>
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
            <ul class="posts-list">
							<h4><?php echo ( is_month() ) ? the_time('F Y') : ''; ?><?php echo ( is_year() ) ? the_time('Y') : ''; ?></h4>
							<br>
							
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
					if($_GET['cat']) { ?>
                        <li class="item bullet">
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?>, <?php echo get_the_date(); ?></a></h1>
                        </li>
                    <?php } else { ?>
                  	
                        <div class="item">
                                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                        <div class="entry-thumbnail">
                                            <?php the_post_thumbnail('full'); ?>
                                        </div>
                                     <?php endif; ?>
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <p class="category">
                                
                                <?php if($cat_ID != "532") { ?>
                                <span class="author category-item">
                                    By <?php if(function_exists('coauthors_posts_links') )
                                        coauthors_posts_links();
                                    else
                                        the_author_posts_link(); ?>
                                    
                                    on <?php echo get_the_date(); ?></span> 	
                                <?php } else { ?>
                                <span class="date category-item"><?php echo get_the_date(); ?> </span> 
                                <?php } ?>
                            </p>
                            <?php
							$check = trim(strip_tags(get_field("torch_extra_excerpt")));
							if(empty($check)) {
								ww_my_excerpt(); 
							} else {
								the_field("torch_extra_excerpt");
							}
							?>
                            <span><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></span>
                            <p style="margin: 0;">&nbsp;</p>
                            <p class="category">
                                <!--<span class="tags category-item"><?php echo the_tags(); ?> </span>--> 
                                <span class="category-item"> Category: <?php echo get_the_category_list( __( ', ') );  ?></span>
                                 <?php p2p_type( 'post_schools' )->each_connected( $wp_query ); ?>
								 <?php $source_type = trim( get_post_meta( get_the_ID(), "institution_type", true) );
    
                                                
                                               if(count($post->connected) > 0) { echo 'Schools:'; }
                                                    foreach ( $post->connected as $post ) : setup_postdata( $post ); ?>
                                                        <a href="<?php the_permalink(); ?>" class="more"><?php the_title(); ?></a>
    
                                                       <?php endforeach;
    
                                                        wp_reset_postdata(); // set $post back to original post
                                                        ?>
                                                        
								<?php if($cat_ID == "8") { ?> 
									<?php p2p_type( 'case_material' )->each_connected( $wp_query ); ?>
                                    <?php if(count($post->connected) > 0) { echo '<br>Cases:'; }
                                    foreach ( $post->connected as $post ) : setup_postdata( $post ); ?>
                                    <a href="<?php the_permalink(); ?>" class="more"><?php the_title(); ?></a>
    
                                   	<?php endforeach;
    
                                    wp_reset_postdata(); // set $post back to original post
                                    ?>
    
                                        
								 <?php } ?>
                            </p>
                            <hr class="red-line">
                        </div>        
                	
                    <?php } ?>
                    
			<?php endwhile; ?>
            	</ul>
			<?php
			if($cat_ID == 8 && !is_date()) {
				twentythirteen_paging_nav('', '', 'auto');
			}
			else {
                ww_paging_nav_view_all();
			}
			?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
   
<?php get_footer(); ?>