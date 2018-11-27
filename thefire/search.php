<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
global $wp_query;
global $query_string;
?>

<div class="search-page-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php printf( __( 'Search Results for:', 'twentythirteen' )); ?></h1>
    </div>
</div>
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php printf( __( 'Search Results for:', 'twentythirteen' )); ?></h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div class="search-keywords"><?php echo get_search_query(); ?></div>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<?php 
		
		//echo "maxnmpage: ". $wp_query->max_num_pages ."<br>";
		//echo "posts: ". $wp_query->found_posts ."<br>";
		//query_posts($query_string . 'posts_per_page=20'); 
		
		

		$query_args = explode("&", $query_string);
		$search_query = array();
		
		foreach($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach
		
		$search = new WP_Query($search_query);
		
		//echo $GLOBALS['wp_query']->request;
		
	//	$sql = "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts WHERE 1=1 AND (((wp_posts.post_title LIKE '%speech%') OR (wp_posts.post_content LIKE '%speech%'))) AND (wp_posts.post_password = '') AND wp_posts.post_type IN ('post', 'page', 'attachment', 'video', 'fire_cases', 'fire_schools', 'fire_speech-codes') AND (wp_posts.post_status = 'publish') ORDER BY wp_posts.post_title LIKE '%speech%' DESC, wp_posts.post_date DESC ";
	//	$schools = $wpdb->get_results($sql, 'OBJECT');
		 //$sql_posts_total = $wpdb->get_var( "SELECT FOUND_ROWS();" );
		
		$sql_posts_total = $search->found_posts;
		
		//echo "<br>totaal: ".$sql_posts_total;
		//echo "<br>page: ".get_query_var('paged');
		//echo '<pre>';
		//print_r($search_query);
		//echo '</pre>';
		
		?>
		<?php if ( $search->have_posts() ) : ?>
        	<section class="posts-list">
            	<ul>
			
			<?php while ( $search->have_posts() ) : $search->the_post(); ?>
				<?php //get_template_part( 'content', 'search_results' ); ?>
                <div class="item">
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <time itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
                    <?php the_excerpt(); ?>
                    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
                </div>
			<?php endwhile; ?>
				</ul>
            </section>
			<?php //twentythirteen_paging_nav(); ?>
			<?php
				//if ($wp_query->max_num_pages > 1) :
				//wp_pagenavi( array( 'query' => $wp_query ) );
				//endif;

				$per_page = 10;
				$page = 1 ;       

				$adjacents = 2; 
				
				$selector			= get_query_var('paged');
				
				$page = ($selector == 0 ? 1 : $selector);  
				$start = ($page - 1) * $per_page;								
				
				$prev = $page - 1;							
				$next = $page + 1;
				$lastpage = ceil($sql_posts_total / $per_page);
				$lpm1 = $lastpage - 1;
				
				$pagination = "";
				if($lastpage > 1)
				{	
					$pagination .= "<div class=\"filterBox\">";
							$pagination .= "<a>$page/$lastpage</a>";
					if ($lastpage < 7 + ($adjacents * 2))
					{	
						for ($counter = 1; $counter <= $lastpage; $counter++)
						{
							
							if ($counter == $page)
								$pagination.= "<a class='active'>$counter</a>";
							else
									$pagination.= "<a href=\"/page/". $counter ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$counter</a>";					
						}
					}
					elseif($lastpage > 5 + ($adjacents * 2))
					{
						if($page < 1 + ($adjacents * 2))		
						{
							for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
							{
								if ($counter == $page)
									$pagination.= "<a class='active'>$counter</a>";
								else
									$pagination.= "<a href=\"/page/". $counter ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$counter</a>";					
							}
							$pagination.= "<a class='dot'>...</a>";
							$pagination.= "<a href=\"/page/". $lpm1 ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$lpm1</a>";
							$pagination.= "<a href=\"/page/". $lastpage ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$lastpage</a>";		
						}
						elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
						{
							$pagination.= "<a href=\"/page/1/?s=". urlencode(stripslashes($_GET['s'])) ."\">1</a>";
									$pagination.= "<a href=\"/page/2/?s=". urlencode(stripslashes($_GET['s'])) ."\">2</a>";
					$pagination.= "<a class='dot'>...</a>";
							for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
							{
								if ($counter == $page)
									$pagination.= "<a class='active'>$counter</a>";
								else
									$pagination.= "<a href=\"/page/". $counter ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$counter</a>";					
							}
							$pagination.= "<a class='dot'>..</a>";
							$pagination.= "<a href=\"/page/". $lpm1 ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$lpm1</a>";
							$pagination.= "<a href=\"/page/". $lastpage ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$lastpage</a>";		
						}
						else
						{
							$pagination.= "<a href=\"/page/1/?s=". urlencode(stripslashes($_GET['s'])) ."\">1</a>";
							$pagination.= "<a href=\"/page/2/?s=". urlencode(stripslashes($_GET['s'])) ."\">2</a>";
							$pagination.= "<a class='dot'>..</a>";
							for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page)
									$pagination.= "<a class='active'>$counter</a>";
								else
									$pagination.= "<a href=\"/page/". $counter ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">$counter</a>";					
							}
						}
					}
					
					if ($page < $counter - 1){ 
						$pagination.= "<a href=\"/page/". $next ."/?s=". urlencode(stripslashes($_GET['s'])) ."\"'>Next</a>";
						$pagination.= "<a href=\"/page/". $lastpage ."/?s=". urlencode(stripslashes($_GET['s'])) ."\">Last</a>";
					}else{
						$pagination.= "<a class='current'>Next</a>";
						$pagination.= "<a class='current'>Last</a>";
					}
					
					$pagination.= "</div>\n";		
				}
			
			
				echo $pagination;

		
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>