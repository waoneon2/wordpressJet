<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
	<?php $blog_style = (function_exists('ot_get_option'))? ot_get_option( 'blog_style', 'default' ) : 'default';
		$blog_layout = (function_exists('ot_get_option'))? ot_get_option( 'blog_layout', 'rs' ) : 'rs';
	$width = 1200;
	$height = 800;
	$class = '';
	$class2 = '';
	$class3 = '';
	if($blog_style == 'grid_view'):
		if(!is_single()):
			if($blog_layout == 'full'):
				$class = ' col-md-4 grid-view';
			else:
				$class = ' col-md-6 grid-view';
			endif;
		endif;
	elseif($blog_style == 'list_view'):
		if(!is_single()):
			$class = ' row';
			if($blog_layout == 'full'):
				$class2 = ' col-md-3';
				$class3 = ' col-md-9';
			else:
				$class2 = ' col-md-5';
				$class3 = ' col-md-7';
			endif;
			$width = 400;
			$height = 400;
		endif;	
	else:
		$class = '';
	endif;
	?>
    <div class="blog-post">	
    	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>  
            <div class="post-meta sticky-posts text-center">                
                <?php $sticky_post_text = (function_exists('ot_get_option'))? ot_get_option( 'sticky_post_text', 'Featured' ) : esc_html__('Featured', 'uniset'); ?>                
                <div class="sticky-content"><?php printf( '<span class="sticky-post">%s</span>', $sticky_post_text ); ?></div>                
            </div>            
        <?php endif; ?>			 			
        <?php if(!is_single()){ ?>
        <?php if(has_post_thumbnail()): ?>
        <!-- BLOG POST IMAGE -->
        <div class="blog-post-img m-bottom-30">
        	<?php if(!is_single()): ?>
                <a href="<?php esc_url(the_permalink()); ?>">
                <?php uniset_post_thumb( $width, $height, true, false ); ?>
                </a>
            <?php else: ?>
            	<?php uniset_post_thumb( $width, $height, true, false ); ?>
            <?php endif; ?>
        </div><!-- end media -->
        <?php endif; ?>
        <?php } ?>

        <!-- BLOG POST TEXT -->
        <div class="blog-post-txt m-bottom-10">

            <!-- Post Data -->
            <div class="posts-meta">
            <?php if(!is_single()): ?>
            <a class="post-date" href="<?php esc_url(the_permalink()); ?>"><span><?php echo get_the_date(); ?></span></a>
            <?php else: ?>
            <span> <?php echo get_the_date(); ?></span>
            <?php endif; ?>
            <span><?php echo esc_html__('in', 'uniset'); ?> <?php the_category(', '); ?></span>
            </div>

            <!-- Post Title -->
            <?php if(!is_single()): ?>
            <h4 class="h4-lg"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
            <?php else: ?>
            <h4 class="h4-lg"><?php the_title(); ?></h4>
            <?php endif; ?>

            <!-- Post Text -->
            <?php if ( is_search()) : ?>                
            <p><?php the_excerpt(); ?></p>                        
			<?php else : ?>                    
                <?php the_content(sprintf(esc_html__( 'More Details', 'uniset' ) ) ); ?>                        
            <?php endif; ?>
        </div>
        
        <?php
		if(is_single()):							
			$tags_list = get_the_tag_list('<ul class="list-inline cat_list"><li>','</li><li>','</li></ul>');					
			if ( $tags_list ): ?>					
				<div class="blog-tags">				
					<?php echo wp_kses( 							
					  $tags_list,							  
					  // Only allow a tag							  
					  array(
					  'ul' => array(								
						  'class' => array()								  
						),
						'li' => array(								
						  'class' => array()							  
						),								
						'a' => array(								
						  'href' => array()								  
						),								
					  )							  
					); ?>						
				</div>						
			<?php					 
			endif;
			?>
            <?php if(function_exists('uniset_social_share')): ?>
            <?php uniset_social_share(); ?>
            <?php endif; ?>
            <?php				
		endif;				
		?>

        <hr />
                    
        <!-- BLOG POST META -->
        <div class="blog-post-meta text-right">
            <?php if(function_exists('pvc_get_post_views')): ?>
            <a href="<?php esc_url(the_permalink()); ?>"><span><i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo wp_kses(pvc_get_post_views( get_the_ID() ), array('span'=>array())); ?></span></a>
            <?php endif; ?>
            <a href="<?php esc_url(comments_link()); ?>"><span><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0','1','%'); ?></span></a>
            <a class="post-avatar" href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"> <?php the_author(); ?> <?php echo get_avatar( get_the_ID(), 30 ); ?> </a>
        </div>
        
        <?php
		if(is_single()):
			wp_link_pages( array(				
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'uniset' ) . '</span>',					
				'after'       => '</div>',					
				'link_before' => '<span>',					
				'link_after'  => '</span>',					
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'uniset' ) . ' </span>%',					
				'separator'   => '<span class="screen-reader-text">, </span>',					
			) );				
		endif;				
		?>

    </div>                        
	<!-- end blog-item -->
</div><!-- end content -->