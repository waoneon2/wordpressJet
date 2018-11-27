<?php
/**
 * The Header for multipage of theme
 *
 * Displays all of the <head> section and everything up till </header>
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- PRELOADER
    ============================================= -->       
    <div id="loader-wrapper">
        <div id="loader">
            <div class="sk-folding-cube">
              <div class="sk-cube1 sk-cube"></div>
              <div class="sk-cube2 sk-cube"></div>
              <div class="sk-cube4 sk-cube"></div>
              <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <?php
        $header_style = (function_exists('ot_get_option'))? ot_get_option( 'header_style', 'style_1' ) : 'style_1';
        $button_style_color = (function_exists('ot_get_option'))? ot_get_option( 'button_style_color', 'on' ) : 'on';
        $button_class_hed = '';
        if($button_style_color == 'off'){
        $button_class_hed = ' btn btn-green btn-arrow';
        }
        if($header_style == 'style_4'){
            $hed_class = ' navbar-light bg-tra';
            $header_id = '4';
        }elseif($header_style == 'style_3'){
            $hed_class = 'no-bg white-nav def-nav';
            $header_id = '3';
        } elseif($header_style == 'style_2'){
            $hed_class = 'navbar-dark bg-tra';
            $header_id = '2';
        } else {
            $hed_class = 'navbar-light bg-light';
            $header_id = '1';
        }
        
        ?>
        <header id="header" class="header">            
            <!-- navbar fixed on top Black Background: -->  
            <nav class="navbar fixed-top navbar-expand-lg <?php echo esc_attr($hed_class); ?> ">    
                <div class="container">
                        <!-- Slim Menu -->
                        <?php 
                        $logo = (function_exists('ot_get_option'))? ot_get_option( 'main_logo', esc_url(UNISET_THEMEURI . 'images/logo.png') ) : esc_url(UNISET_THEMEURI . 'images/logo.png');
                        $logo_alt = (function_exists('ot_get_option'))? ot_get_option( 'main_logo_alt', esc_url(UNISET_THEMEURI . 'images/logo-alt.png') ) : esc_url(UNISET_THEMEURI . 'images/logo-alt.png'); 
                        ?>
                        
                        <a class="visible-sec navbar-brand logo-white" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                            <?php if($logo_alt != ''): ?>
                                <img src="<?php echo esc_url($logo_alt); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="115" height="30">                                
                                <?php else: ?>
                                    <?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
                                <?php endif; ?>
                        </a>
                        
                        <a class="visible-sec navbar-brand logo-black" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                            <?php if($logo != ''): ?>
                                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="115" height="30">                                
                            <?php else: ?>
                                <?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
                            <?php endif; ?>
                        </a>

                        <div class="visible-sec tagline">
                            <span><?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?></span>
                        </div>
                        
                        <div class="hidden-sec slim-wrap">                              
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link-text">
                            <?php if($logo != ''): ?>
                                <img class="default-view" src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                            <?php else: ?>
                                <?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
                            <?php endif; ?>
                            </a>
                            <?php 
                            $menu_name = get_post_meta( get_the_ID(), 'onepage_menu_select', true );
                            if ( is_page_template( 'page-templates/home-page.php' ) ) {                             
                                $args_slim = array(
                                'menu'            => $menu_name,
                                'menu_class'      => 'menu-items',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => '',
                                'container'       => '',
                                );                                          
                                wp_nav_menu( $args_slim );
                            } else {                                  
                                $args_slim = array(
                                'theme_location'  => 'main-menu',
                                'menu_class'      => 'menu-items',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => '',
                                'container'       => '',
                                );                                          
                                wp_nav_menu( $args_slim );
                            }
                            ?>
                        </div>                                                                           
                   
                    <div id="navbarSupportedContent" class="collapse navbar-collapse visible-sec">
                        <?php if($header_style == 'style_3' || $header_style == 'style_2'): ?>
                        <?php
                        $header_button = (function_exists('ot_get_option'))? ot_get_option( 'header_button', 'on' ) : 'on';
                        if($header_button != 'off'){
                            $header_button_text = (function_exists('ot_get_option'))? ot_get_option( 'header_button_text', '' ) : '';
                            $header_button_link = (function_exists('ot_get_option'))? ot_get_option( 'header_button_link', '' ) : '';
                            
                            if($header_button_text != '' && $header_button_link != ''){
                            ?>
                                <ul class="nav navbar-nav header-btn">                                                  
                                    <li class="nav-link">
                                        <a class="header-btn<?php echo esc_attr($button_class_hed); ?>" href="<?php echo esc_url($header_button_link); ?>"><?php echo esc_html($header_button_text); ?></a>
                                    </li>   
                                </ul>
                            <?php 
                            }
                        } ?>
                        <?php endif; ?>
                        
                        <?php if ( is_page_template( 'page-templates/home-page.php' ) ) {
                            wp_nav_menu(
                            array(
                                'menu'              => $menu_name,
                                'menu_class'        => 'navbar-nav ml-auto',
                                'container'         => false,
                                'fallback_cb'       => '',
                                'walker'            => new uniset_scm_walker
                            )
                        );
                        } else {                            
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'main-menu',
                                'menu_class'        => 'navbar-nav ml-auto',
                                'container'         => false,
                                'fallback_cb'       => '',
                                'walker'            => new uniset_scm_walker
                            )
                        );
                        }
                        ?>
                        <?php
                        if( function_exists('ot_get_option') ):
                            $social_array = ot_get_option( 'header_social_icons', array() );
                            $social_icon_color = ot_get_option( 'social_icon_color', 'on' );
                            $color_class = '';
                            if($social_icon_color == 'off'){
                                $color_class = ' ico-color';
                            }
                                                    
                            if( !empty($social_array) ): ?>
                            <div class="header-socials clearfix">
                                <?php foreach ($social_array as $key => $value) { ?>
                                    <span><a href="<?php echo esc_url($value['link']); ?>" class="s-link-circle<?php echo esc_attr($color_class); ?> ico-<?php echo esc_attr($value['icon']); ?>"><i class="fa fa-<?php echo esc_attr($value['icon']); ?>" aria-hidden="true"></i></a></span>
                                <?php } ?>          
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                                            
                        <!-- Navigation Menu Button -->
                        <?php if($header_style == 'style_1' || $header_style == 'style_4'): ?>
                        <?php
                        $header_button = (function_exists('ot_get_option'))? ot_get_option( 'header_button', 'on' ) : 'on';
                        if($header_button != 'off'){
                            $header_button_text = (function_exists('ot_get_option'))? ot_get_option( 'header_button_text', '' ) : '';
                            $header_button_link = (function_exists('ot_get_option'))? ot_get_option( 'header_button_link', '' ) : '';
                            
                            if($header_button_text != '' && $header_button_link != ''){
                            ?>
                                <ul class="nav navbar-nav header-btn">                                                  
                                    <li class="nav-link">
                                        <a class="header-btn<?php echo esc_attr($button_class_hed); ?>" href="<?php echo esc_url($header_button_link); ?>"><?php echo esc_html($header_button_text); ?></a>
                                    </li>   
                                </ul>
                            <?php 
                            }
                        } ?>
                        <?php endif; ?>
                                                                                                   
                    </div>  <!-- End Navigation Menu -->
                                                               
                </div>    <!-- End container -->                    
            </nav>     <!-- End navbar  -->
        </header>