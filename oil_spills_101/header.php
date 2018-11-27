<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oil_Spill_101
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'oilspill' ); ?></a>
	<?php  $hero_img = get_theme_mod('oilspill_add_hero_img'); ?>
	<?php if ( is_front_page() || is_home() ) : ?>
	<?php if(!empty($hero_img)) : ?>
		<header id="masthead" class="site-header front-header" role="banner">
		<div class="background-image container">
			<img src="<?php echo $hero_img; ?>" class="img-responsive">
		</div>
	<?php else: ?>
		<header id="masthead" class="site-header front-header" role="banner">
		<div class="background-image container">
			<img src="<?php echo get_template_directory_uri();?>/images/BG-Cape-Flattery-Bay_WEB.jpg" class="img-responsive">
		</div>
	<?php endif; ?>
	<?php
		$pages = array();
		$get_page = get_theme_mod('oilspill_opt_overlay_page');
		if(!empty($get_page)):
			if ( 'page-none-selected' != $get_page ) :
				$pages[] = $get_page;
			$args = array(
				'posts_per_page' => 1,
				'post_type' => 'page',
				'post__in' => $pages,
				'orderby' => 'post__in'
			);
			$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
	?>
				<div class="overlay-page caption container" id="oilspill-overlay-page" data-page-id="<?php the_ID(); ?>">
					<div class="content-overlay-text row">
					<div class="col-md-6"></div>
						<div class="col-md-6" id="col-overlay">
							<div class="content-is-page">
								<?php the_title( sprintf( '<h2 class="entry-title-overlay"><a class="link-overlay-page" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-content-overlay clearfix">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
	<?php
					endwhile;
				endif;
			endif;
		endif;
	else:
		if (has_post_thumbnail()) {
			echo '<header id="masthead" class="site-header" role="banner">';
			echo '<div class="background-image container" id="no-home-img"> ';
			the_post_thumbnail() ;
			echo '</div>';
		} else { ?>
		<header id="masthead" class="site-header" role="banner">
		<div class="background-image container" id="no-home-img">
			<img src="<?php echo get_template_directory_uri();?>/images/BG-Cape-Flattery-Bay_WEB.jpg" class="img-responsive">
		</div>
	<?php
		}
	endif;
	?>


		<div class="top-header">
			<div class="container">
				<div class="row">
				<nav id="main-nav header-nav-oilspills" class="navbar navbar-default">
        <div class="container-fluid no-padding">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="sr-only"></span>
              </button>

            <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php
            	$get_header_img = getHeaderImage();
            	if($get_header_img != "empty"):
            ?>
        		<img src="<?php echo $get_header_img; ?>" class="img-responsive">
        		<span class="navbar-logo" style="display: none;"><?php bloginfo('name'); ?></span>
                <span class="navbar-title" style="display: none;"><?php bloginfo('description'); ?></span>
        	<?php
            	else:
            ?>
        		<span class="navbar-logo"><?php bloginfo('name'); ?></span>
                <span class="navbar-title"><?php bloginfo('description'); ?></span>
        	<?php
            	endif;
            ?>


            </a>
            </div>

            <div class="navbar-collapse navbar-right collapse" id="bs-navbar-collapse-1">
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'Header Nav',
                        'theme_location'    => 'primary',
                        'depth'             => 4,
                        'container'         => false,
                        'menu_class'        => 'nav navbar-nav clearfix',
                        'walker'            => new oilspill_walker_nav_menu())
                    );
                ?>

            </div>

        </div>
    </nav><!-- #site-navigation -->
				</div>
			</div>
		</div> <!-- top-header -->
		<?php if ( !is_front_page() && !is_home() ) : ?>
			<?php if(get_the_title()): ?>
				<div class="post-title-container">
					<div class="container">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</header><!-- #masthead -->




	<div id="content" class="site-content">
