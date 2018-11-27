<?php
	if(is_page()){
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
	else{
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
	
	if( $layout == 'full' ){
		$container_class = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
		$padding_class = '';
	}
	else{
		$container_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
		$container_class .= ( $layout == 'ls' )? ' pull-right' : '';
		$padding_class = ( $layout == 'ls' )? ' p-left-60' : ' p-right-60';
	}	
	
?>

<div class="blog-page-section division section-main-container">
    <div class="container">
        <div class="row"> 
		<?php if(is_single()){ ?>
			<?php if(has_post_thumbnail()): ?>
			<div class="blog-post-img m-bottom-30">
				<?php uniset_post_thumb( 1200, 800, true, false ); ?>
			</div>
			<?php endif; ?>
        <?php } ?> 
            <div class="<?php echo esc_attr($container_class); ?>">
                <div class="posts-holder<?php echo esc_attr($padding_class); ?>">
					<?php if(!is_page_template( 'page-templates/home-page.php' )): ?>
                    	<?php get_template_part( 'header/banner', '' ); ?>
                    <?php endif; ?>
