<?php
	if(is_page()) {
		$layout = get_post_meta( get_the_ID(), 'page_layout', true );
		if($layout != ''){
			$layout = $layout;
		} else {
			$layout = 'full';
		}
	}
	elseif(is_single()){
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'single_layout', 'rs' ) : 'rs';
	}
	else {
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'blog_layout', 'rs' ) : 'rs';
	}
	
	if(is_author()){
		$layout = 'full';
	}
	
	if(is_singular('portfolio')){
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'portfolio_single_layout', 'full' ) : 'full';
	}
	
	if(is_post_type_archive('portfolio')){
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'portfolio_layout', 'full' ) : 'full';
	}

?>
	</div>
</div>

	<?php if( $layout != 'full' ): ?>
    
    <?php get_sidebar(); ?>
    
    <?php endif; // endif ?>
     
    </div>
    
</div>
</div>
<!-- Content Wrap -->