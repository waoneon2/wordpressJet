<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andeavor
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'andeavor' ); ?></a>
	<header id="masthead" class="site-header container">
		<div class="site-branding">
			<div class="row">
				<?php if (get_theme_mod( 'andeavor_logo' )) : ?>
				<div class="col-md-8 header-logo">
					<?php
				    $get_andeavor_logo = get_theme_mod('andeavor_logo');
				    $get_andeavor_link_logo = get_theme_mod('andeavor_link_logos');
				    $get_andeavor_title_logo = get_theme_mod('andeavor_logo_title');
				    $get_andeavor_alt_logo = get_theme_mod('andeavor_logo_alt');
				    $title_logo = "";
				    $alt_desc_logo = "";
				    $link_logo = "#";
				    $id_logo = 0;

				    $bol_link_logo = false;

				    $count_andeavor_logo = count($get_andeavor_logo);
				    $make_arr = array();
				    $get_arr = array();
				    $count_up = 0;

				    foreach ($get_andeavor_logo as $key => $value) {
				        if ($value !== "") :
				                $make_arr[$count_up] = array(
				                    'large_img' => $value,
				                    'idloop' => $key
				                );
				           $count_up++;
				        endif;
				    }
				    $get_arr["data"] = $make_arr;
				    $convert_json = json_encode($get_arr, JSON_PRETTY_PRINT);
				    $decode_data = json_decode($convert_json, true);
				    ?>
				    <?php
				    foreach ($decode_data["data"] as $key => $value) {

				    if($get_andeavor_title_logo):
				        if(!empty($get_andeavor_title_logo[(int)$value["idloop"]])):
				            $title_logo = $get_andeavor_title_logo[(int)$value["idloop"]];
				        else:
				            $title_logo = "";
				        endif;
				    endif;

				    if($get_andeavor_alt_logo):
				        if(!empty($get_andeavor_alt_logo[(int)$value["idloop"]])):
				            $alt_desc_logo = $get_andeavor_alt_logo[(int)$value["idloop"]];
				        else:
				            $alt_desc_logo =  "";
				        endif;
				    endif;

				    if($get_andeavor_link_logo):
				        if(!empty($get_andeavor_link_logo[(int)$value["idloop"]])):
				            $link_logo = $get_andeavor_link_logo[(int)$value["idloop"]];
				            $bol_link_logo = true;
				        else:
				            $link_logo = "#";
				            $bol_link_logo = false;
				        endif;
				    endif;
				    $id_logo +=1;
				    ?>
				    <div class="h-logo">
				     	
				        <?php 
				        	if(!$bol_link_logo || !trim($link_logo)){
				        		?>
				        		<img class="img-responsive" src="<?php echo $value["large_img"]; ?>" <?php if(!empty($title_logo)): ?> title="<?php echo esc_attr($title_logo); ?>" <?php endif; ?>  <?php if(!empty($alt_desc_logo)): ?> alt="<?php echo esc_attr($alt_desc_logo); ?>" <?php endif; ?>>
				        		<?php
				        	} else {
				        		?>
				        		<a href="<?php echo esc_url($link_logo); ?>" id="link_logo_<?php echo $id_logo?>" rel="link_rel_logo_client" target="_blank">
				            <img class="img-responsive" src="<?php echo $value["large_img"]; ?>" <?php if(!empty($title_logo)): ?> title="<?php echo esc_attr($title_logo); ?>" <?php endif; ?>  <?php if(!empty($alt_desc_logo)): ?> alt="<?php echo esc_attr($alt_desc_logo); ?>" <?php endif; ?>>
				        </a>
				        <?php
				        	}
				        ?>
				    </div>
				    <?php
				    }
				    ?>
				</div>
				<?php endif; ?>

				<div class="col-md-4 search-container hidden-sm hidden-xs">
					<div class="form-group">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar navbar-default">
			<div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>
			    <div class="collapse navbar-collapse no-padding mobile-nev-overflow" id="bs-navbar-collapse-1">
				    <?php
				    	wp_nav_menu( array(
				    		'theme_location' => 'menu-1',
				    		'menu_id'        => 'primary-menu',
				    		'depth'          => 6,
				    		'menu_class'	 => 'nav navbar-nav',
				    		'container'		 => false,
				    		'walker'         => new andeavor_walker_nav_menu()
				    	) );
				    ?>
			        <div class="hidden-lg hidden-xl hidden-md">
						<form role="search" method="get" class="navbar-form searchs-form-full search" action="<?php esc_url( home_url( '/' ) ); ?>">
							<div class="input-group">
								<input type="search" class="form-control searchs-field" placeholder=" " value="" name="s" title="Search for:">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default search-submit">search</button>
								</div>
							</div>
						</form>
					</div>
			    </div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
	<h1><?php echo get_theme_mod('header_information') ?></h1>

	<?php if (is_user_logged_in()): ?>
		<p>Welcome back <b><?php andeavor_user() ?></b> | if you are not <?php andeavor_user() ?>, <a href="<?php echo wp_logout_url(); ?>">click here</a>.</p>
	<?php endif ?>

<style type="text/css">

</style>