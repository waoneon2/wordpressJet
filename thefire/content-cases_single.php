<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="entry-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php endif; ?>
    </div>
    
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
		
         <p class="category">Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?> <br />
            <span class="category-item"> 		
                <?php
                    // Find connected pages
                    $connected = new WP_Query( array(
                      'connected_type' => 'school_cases',
                      'connected_items' => get_queried_object(),
                      'nopaging' => true,
                    ) );
                    // Display connected pages
                    if ( $connected->have_posts() ) :
                    ?>
                    Schools:
                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php endwhile; ?>
                    <?php 
                    // Prevent weirdness
                    wp_reset_postdata();
                    endif;
                ?>
            </span>
         </p>
           <?php the_content(); ?>       
        
			<div id="tabs">
			      <ul>
			        <li><a href="#tabs-1">Case Materials</a></li>
			        <li><a href="#tabs-2">Media Coverage</a></li>
			        <li><a href="#tabs-3">Commentary</a></li>
			      </ul>
			      <div id="tabs-1">
							<section class="posts-list">
						 <?php		
						$connected = new WP_Query( array(
						'connected_type' => 'case_material',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
						'orderby' => 'date',
						'order' => 'DESC'

						) );	
						
						$countCases = 0;
							
						// Display connected pages
						if ( $connected->have_posts() ) {
							?>
			               
								<?php while ( $connected->have_posts() ) : $connected->the_post(); 
                                    $currentID = get_the_ID();
                                    $categories = get_the_category($currentID);
									
									$selector = 0;
									
									foreach($categories as $cat){
										
										if($cat->term_id == 531 || $cat->term_id == 532 || $cat->term_id == 533 || $cat->term_id == 820) {
											$selector++;
										}
									}
            
                                    if($selector > 0) {
                                    ?>
                                        <li><?php get_template_part( 'content', 'case_tabs_cases' ); ?></li><hr>
                                        <?php 
                                        $countCases++;
                                    }
								endwhile; ?>
							
			                
							<?php 
							// Prevent weirdness
							wp_reset_postdata();
						} 
						
						if($countCases == 0) {
							print 'Currently there are no Case Materials at this time.';
						}		
						?> 
			                
			                </section>
				  </div>
			      <div id="tabs-2">
							<section class="posts-list">
			      			            <?php
						$connected = new WP_Query( array(
						'connected_type' => 'case_material',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
						'orderby' => 'date',
						'order' => 'DESC'

						) );	
						
						$countMedia = 0;
								
						// Display connected pages
						if ( $connected->have_posts() ) {
							?>
			                <ul class="no-style">
								<?php while ( $connected->have_posts() ) : $connected->the_post(); 
									$currentID = get_the_ID();
                                    $categories = get_the_category($currentID);
									
									$selector = 0;
									
									foreach($categories as $cat){
										
										if($cat->term_id == 504) {
											$selector++;
										}
									}
            
                                    if($selector > 0) {
                                    ?>
                                        <li><?php get_template_part( 'content', 'cases_tabs' ); ?></li> <hr>
                                        <?php 
                                        $countMedia++;
                                    }
								endwhile; ?>
			                </ul>
							<?php 
							// Prevent weirdness
							wp_reset_postdata();
						}
						
						if($countMedia == 0) {
							print 'There is currently no media coverage for this case.';
						}		
						?> 
			                </section>
				  </div>
			      <div id="tabs-3">
							<section class="posts-list">
			 			 <?php		
						$connected = new WP_Query( array(
						'connected_type' => 'case_material',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
						'orderby' => 'date',
						'order' => 'DESC'

						) );	
						
						$countCommentary = 0;
								
						// Display connected pages
						if ( $connected->have_posts() ) {
							?>
			                <ul class="no-style">
								<?php while ( $connected->have_posts() ) : $connected->the_post();
									$currentID = get_the_ID();
                  					$categories = get_the_category($currentID);

									$sub_categories = array();
									
									$selector = 0;
									
									//Subcategories
									foreach($categories as $cat){
										//If the category ID is not The Torch
										if($cat->term_id != 8){
											$cat_ancestors = get_ancestors( $cat->term_id, 'category' );
											//Add to sub_categories array if the parent of the category is The Torch
											if(in_array(8, $cat_ancestors)){
												array_push($sub_categories, $cat->term_id);
											}
										}
										
										if($cat->term_id == 8) {
											$selector++;
										}
									}

									if($selector > 0 || in_array($categories[0]->cat_ID, $sub_categories)) {
										?>
										<li><?php get_template_part( 'content-cases_tabs', get_post_format() ); //echo "<pre>"; print_r($categories); echo "<pre>"; ?></li> <hr>
										<?php
										$countCommentary++;
									}
								endwhile; ?>
							
			                </ul>
							<?php 
							// Prevent weirdness
							wp_reset_postdata();
						}
						
						if($countCommentary == 0) {
							print 'There is currently no commentary for this case.';
						}		
						?> 
			                </section>
				  </div>
		    </div>
       
       
       
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
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>
<?php endif; ?>