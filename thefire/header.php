<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
$url = str_replace(get_bloginfo('url') .'/', '', 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$urlParts = explode('/', substr($url, 0, strrpos($url, '/')));

if($urlParts[0] == "article-1") {
	header("Location: ". get_permalink($urlParts[1]));
}
 
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); 

	function get_top_parent_page_id() {

		global $post;
		// Check if page is a child page (any level)
		if ($post->ancestors) {
			//  Grab the ID of top-level page from the tree
			 return end($post->ancestors);
		} else {
			// Page is the top level, so use  it's own id
			return $post->ID;
		}
	}

	$category = get_the_category(); 
	$cat_ID = $category[0]->cat_ID;
	
	if(is_single() && get_the_category()) {
		
		function get_top_parent_category($cat_ID){
			$cat = get_category( $cat_ID );
			$new_cat_id = $cat->category_parent;
		
			if($new_cat_id != "0"){
				return (get_top_parent_category($new_cat_id));
			}
			return $cat_ID;
		}
		
		
		$categories = get_the_category();
		$selectorCAT = 0;
		foreach($categories as $cat){
			
			if($cat->category_parent == 0) {
				$selectorCAT = $cat->term_id;
			}
		}
		?>
		
		<style>
			<?php if($selectorCAT != 0) { ?>
				.sidebar-inner .nav-menu > #menu-item-<?php echo $selectorCAT; ?> {
					display: block;
				}
			<?php } else { ?>
				.sidebar-inner .nav-menu > #menu-item-<?php echo get_top_parent_category($cat_ID); ?> {
					display: block;
				}
			<?php } ?>
		</style>
        
  	<?php 
	} 
	
	if($post->ID == 69885 || $post->ID == 69711) { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/FIREcustom.css">
	<?php
    }
	?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33445722-1', 'thefire.org');
  ga('send', 'pageview');

</script>


</head>

<body <?php body_class(); ?>>

	<?php echo do_shortcode('[show_popup]'); setcookie("popupcookie",($_COOKIE["popupcookie"]+1), time()+102096000, COOKIEPATH, COOKIE_DOMAIN, false); ?>
	
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header clearfix" role="banner">
        	<div class="wrapper clearfix">
                <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </a>
                
                <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                    <a class="mobile">Menu</a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav><!-- #site-navigation -->
                
                <div class="site-search">
                	<?php get_search_form(); ?>
                    
                    <?php //display_search_box(DISPLAY_RESULTS_CUSTOM); ?>

                </div>
                
                <div class="site-subscribe comm100-subscribe-form comm100-status-normal">
                    <?php
if( isset($_SERVER['HTTPS'] )  && $_SERVER['HTTPS'] != 'off' ) {
    // reserved in case there's eventually a way for forcing formstack widgets to respect 100% https via shortcode
   echo do_shortcode('[Formstack id=1673745 viewkey=o8iGLcpnPo]');
}else{
   echo do_shortcode('[Formstack id=1673745 viewkey=o8iGLcpnPo]'); 
}

?>
                </div>
                    
                <div class="site-social-bookmarking">
                    <ul>
                        <li><a href="https://www.facebook.com/thefireorg" class="ico_facebook"></a></li>
                        <li><a href="http://www.youtube.com/thefireorg" class="ico_youtube"></a></li>
                        <li><a href="https://twitter.com/TheFIREorg" class="ico_twitter"></a></li>
                        <li><a href="<?php bloginfo( 'rss2_url' ); ?>" class="ico_rss"></a></li>
                        <li><a href="/donate" class="donate button">Donate</a></li>
                    </ul>
                </div>
            </div>
		</header><!-- #masthead -->

		<div id="main" class="site-main">
