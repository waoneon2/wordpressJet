<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'All schools', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php _e( 'All schools', 'firecomps' ); ?></h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
            <?php

				$letters = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
				
				echo '<div class="pagination">';
					$count = 1;
					foreach($letters as $letter) {
						echo '<a href="/schools/?letter='. $letter .'" '. ($_GET['letter'] == $letter ? "class=active" : "") .'>'. $letter .'</a>';
						if($count < count($letters)) {
							echo ' | ';	
						}
						$count++;
					}
					echo ' | <a href="/schools/?letter=all" '. ($_GET['letter'] == $letter ? "class=active" : "") .'>all</a>';
				echo '</div>';

				
				if($_GET['letter'] && $_GET['letter'] != "all") {
					function mam_posts_where ($where) {
					   global $mam_global_where;
					   if ($mam_global_where) $where .= " $mam_global_where";
					   return $where;
					}
					add_filter('posts_where','mam_posts_where');
					$mam_global_where = "AND $wpdb->posts.post_title LIKE '". $_GET['letter'] ."%'";
				}
				
				query_posts($query_string . '&orderby=title&order=ASC&posts_per_page=20'); 
				
            ?>
		<?php if ( have_posts() ) : ?>
            
			<section class="posts-list schools" style="float:left;width:100%;">
            	<ul class="no-style">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post();
				 $source_rating = trim( get_post_meta( get_the_ID(), "school_speech_code_rating", true) );
                if( !empty( $source_rating  ) ) : //checks to see if Speach Code Rating has a rating 
            
                    $field_rating = get_field_object('school_speech_code_rating');
                    $value_rating = get_field('school_speech_code_rating');
                    $label_rating = $field_rating['choices'][ $value_rating ];                     
                    else :
                        $label_rating = 'Undefined'?>
                    <?php endif; ?>            
                <section class="school-info item code-<?php echo $label_rating ?>">
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <p class="category">

                        <a href="<?php the_permalink(); ?>" class="more">&raquo; More on this school</a></p>
                    
                    
                </section>
          

            <?php endwhile; ?>
				</ul>
            </section>
			<?php twentythirteen_paging_nav("schools", "off"); ?>

		<?php else : ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>