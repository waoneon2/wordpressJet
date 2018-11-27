<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LADWP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<div class="container" id="ladwp_container_header">
	<div class="row" id="ladwp_row_header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ladwp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<?php
		function printHeaderImage() {
			$headerImage = get_header_image();
				if ( '' == $headerImage ) {
					$headerImage = get_template_directory_uri() . '/img/jetty-logo-black.png';
				}
					echo( $headerImage );
		}
	?>
		<div class="site-branding">
		<div class="col-md-6 col-sm-8 col-xs-12">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title" style="display: none;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php else : ?>
				<p class="site-title" style="display: none;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<a class="header-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php printHeaderImage(); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				</a>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description" style="display: none;"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			</div>
			<div class="col-md-6 col-sm-4 hidden-xs">
				<div class="col-md-offset-6">
					<form method="get" class="top-header-search" action="<?php echo home_url( '/' ); ?>">
			          <label class="screen-reader-text" for="search_field">Search</label>
			          <input type="text" class="search-text" name="s" placeholder="Search" id="search_field">
			          <button class="search-submit" value="submit"><i class="fa fa-search resize-search" aria-hidden="true"></i></button>
			        </form>
				</div>
			</div>
		</div><!-- .site-branding -->
		<!-- mobile nav -->
		<input class="btn menu-button showing" type="button" value="Menu">
		<div class="main-mobile-navigation" style="display: none">
			<div class="col site-search hidden-sm hidden-md hidden-lg" role="search" style="display: block;">
				<form method="get" action="<?php echo home_url( '/' ); ?>">
					<label class="screen" for="search_field">Search</label>
					<input type="text" class="search-text" name="s" placeholder="Search" id="search_field">
					<button class="search-submit" value="submit">Submit</button>
				</form>
			</div>
			<nav  id="mainnav" class="mobile-navigation" role="navigation" style="display: none;">
				<?php wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'primary-nav-mobile',
					'container_class' => 'primaryNavigationList',
					'walker' => new ladwp_mobile_walker_nav_menu()
				)) ?>
			</nav>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php //wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				<?php wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id' => 'primary-nav',
							'container_class' => 'primaryNavigationList',
							'walker' => new ladwp_walker_nav_menu()
						)) ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<script type="text/javascript">
		jQuery('document').ready(function($){

			// prevent cliking menu
			$('.mobile-navigation .menu-item-has-children').on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					console.log('click');
					var jk = $(this).find('ul.sub-menu:visible');
					if(jk.length !== 1){
						$(this).addClass('opened');
					} else {
						$(this).removeClass('opened');
					}
					$(this).find('.sub-menu').slideToggle();
			});

			$('.mobile-navigation ul.sub-menu li').on('click', function(e) {
				if (!e) {
				  e = window.event;
				}
				e.cancelBubble = true;
				if (e.stopPropagation) {
				  e.stopPropagation();
				}
			});
			// MEGA MENU
			$("#primary-nav").children().hover(function () {
			  $(this).addClass('hovering');
			}, function() {
			  $(this).removeClass('hovering');
			});

			$(".subnav ul li").hover(function () {
			  var tabid = $(this).data('tabid');
			  $(this).addClass('ui-state-active');
			  $(this).addClass('ui-tab-active');
			  $(this).addClass('ui-tab-hover');
			  $("#our-"+tabid).show();
			}, function() {
				var tabid = $(this).data('tabid');
			  $(this).removeClass('ui-state-active');
			  $(this).removeClass('ui-tab-active');
			  $(this).removeClass('ui-tab-hover');
			  $("#our-"+tabid).hide();
			});

			$(".subnav .ladwp-tab-content").hover(function () {
			  var tabid = $(this).data('tabid');
			 	$('.subnav ul li[data-tabid="'+tabid+'"]').addClass('ui-state-active');
			 	$('.subnav ul li[data-tabid="'+tabid+'"]').addClass('ui-tab-active');
			 	$(this).show();
			}, function() {
				var tabid = $(this).data('tabid');
			  $('.subnav ul li[data-tabid="'+tabid+'"]').removeClass('ui-state-active');
			 	$('.subnav ul li[data-tabid="'+tabid+'"]').removeClass('ui-tab-active');
			  $(this).hide();
			});

			// Mobile menu
			$('.menu-button').on('click', function() {
				var value = $(this).val();
				if(value == 'Menu') {
					$(this).val('Close');
					$('.main-mobile-navigation').toggle();
				} else {
					$(this).val('Menu');
					$('.main-mobile-navigation').toggle();
				}
			});
		});
	</script>
	</div><!-- #ladwp_row_header -->
</div><!-- #ladwp_container_header -->

<div class="container" id="ladwp_container_content">
<div class="row" id="ladwp_row_content">
	<div class="show_breadcrumb hidden-xs hidden-sm">
		<?php if(function_exists('ladwp_breadcrumbs')): ladwp_breadcrumbs(false); endif;?>
	</div>
	<div class="content-slider">
		<!-- Header slider -->
		<?php
		if(is_front_page() || is_home()):
   		global $post;
		$dfg = get_theme_mod('multiple_select_setting');
		if(!empty($dfg)):
		$args = array(
    		'post__in' => $dfg,
    		'post_type' => 'post',
		);
		$slider_post = get_posts($args);
	?>
	<div class="carousel-wrapper">
	<div class="carousel-default activate-carousel-default">
	<?php
	foreach ( $slider_post as $post ) :
	  setup_postdata( $post );
	  $trimtitle = get_the_title();
	  $shorttitle = wp_trim_words( $trimtitle, $num_words = 5, $more = '… ' );

	?>
	<div class="slider_header_content" id="ladwp_slider_image_header_content">
		<div class="slide-img">
		<?php if ( has_post_thumbnail() ) :
		?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(1024,576)); ?></a>
		<?php
			  else :
		?>
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo get_template_directory_uri().'/img/placeholder-img.jpg' ?>" class="placeholder-img-slider-header">
		</a>

		<?php
			   endif;
		?>
		</div>
		<div class="slide-info">
			<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
			<?php
				the_excerpt();
				echo('<p><a href="'. get_permalink() . '" target="_blank"><i class="fa fa-chevron-circle-right"></i>' . __('Read More','ladwp') . '</a></p>');
			?>
		</div>
	</div>
	<?php endforeach;
	//wp_reset_postdata(); ?>
	</div>
	</div><!-- .carousel-wrapper -->
<?php endif; endif;?>
	<!-- End of Header slider -->
	</div>
	<div id="content" class="site-content">
