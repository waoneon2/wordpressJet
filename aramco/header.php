<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aramco
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
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aramco' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="headerEdit">
			<div class="header">
				<div class="logo">
			        <a href="#">
			            <img src="<?php echo get_template_directory_uri() ?>/images/logo.png" 
			            data-imgsmall="<?php echo get_template_directory_uri() ?>/images/logo.png" 
			            data-imgsmallretina="<?php echo get_template_directory_uri() ?>/images/logoRetina.png" 
			            data-imglarge="<?php echo get_template_directory_uri() ?>/images/logoLarge.png" 
			            data-imglargeretina="<?php echo get_template_directory_uri() ?>/images/logoLargeRetina.png" 
			            alt="Saudi Aramco" class="responsiveImg">
			        </a>
			    </div>
				<div class="menuBar">
					<div id="js-mobile-menu" class="mobile-menu" 
						data-home-text="Home" 
						data-back-text="Back" 
						data-campaign="false" 
						data-current-path="/en/home.html" 
						data-nearest-visible-parent="/en/home.html">
			            
			            <span aria-hidden="true" data-icon="&#58882;"></span>
			            <span class="screen-reader-txt">Mobile Menu</span>
			        </div>
					<div class="top-search">
		                <a href="#" class="btnSearch">
		                    <span aria-hidden="true" data-icon="&#58880;"></span>
		                    <span class="screen-reader-txt">Search</span>
		                </a>
		            </div>
		            <div class="topNavigation">
		            	<?php
						if(has_nav_menu( 'top-nav' )):
							wp_nav_menu( array( 'theme_location' => 'top-nav', 'menu_id' => 'top-nav','container_class' => 'topNavigationList' )); 
						endif;
						?>
		            </div>
				</div>
				<div class="searchBar" style="display: none;">
		            <div class="openContainer">
		                <div class="searchGroup">
		                    <div class="field">
		                        <?php get_search_form(); ?>
		                    </div>
		                    <button class="btnClose">
		                        <span aria-hidden="true" data-icon="&#xe60d;"></span>
		                        <span class="screen-reader-txt">Search</span>
		                    </button>
		                </div>
		            </div>
		        </div>	
			</div>
			<div id="js-mobile-nav-cnt" class="mobile-navigation-cnt">
				<div id="js-mobile-nav">

						<?php 
						if(has_nav_menu( 'primary-nav' )):
							wp_nav_menu( 
								array( 
									'theme_location' => 'primary-nav', 
									'menu_id' => 'primary-nav-mobile', 
									'menu_class' => 'mobile-navigation-card',
									'walker' => new Aramco_Walker_Mobile_Menu()
							));
						endif;
						?>
				</div>
			</div>
			<nav id="site-navigation" class="primaryNavigation" role="navigation">
				<?php 
				if(has_nav_menu( 'primary-nav' )):
					wp_nav_menu( 
						array( 
							'theme_location' => 'primary-nav', 
							'menu_id' => 'primary-nav', 
							'container_class' => 'primaryNavigationList',
							'walker' => new Aramco_Walker_Nav_Menu()
						));
				endif;
					?>	
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<style type="text/css">


		.icon {
		    font-family: saudiaramco-icons;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale
		}
		.icon2[data-icon]:before, [data-icon]:before {
		    font-family: saudiaramco-icons;
		    content: attr(data-icon);
		    speak: none;
		    font-style: normal;
		    font-weight: 400;
		    font-variant: normal;
		    text-transform: none;
		    line-height: 1;
		    -webkit-font-smoothing: antialiased;
		    -moz-osx-font-smoothing: grayscale;
		}

		.icon2[data-icon]: before {
		    font-family: saudiaramco-icons2
		}
		.visuallyhidden {
		    border: 0;
		    clip: rect(0 0 0 0);
		    height: 1px;
		    margin: -1px;
		    overflow: hidden;
		    padding: 0;
		    position: absolute;
		    width: 1px;
		}
		header {
			margin: 0 auto;
			max-width: 1000px;
			padding: 0 20px;
		}
		.header {
		    position: relative;
		}
		header .menuBar {
		    width: 55%;
		}
		.screen-reader-txt {
		    position: absolute;
		    top: -9999px;
		    left: -9999px;
		}

		/*------------------------------------------------
		#Search
		------------------------------------------------*/

		
		.no-js .searchGroup, .openSearch .searchGroup, .rtl .searchBar, .searchBar .openContainer {
		    width: 100%;
		}
		.searchBar .openContainer {
		    height: 68px;
		    border-width: 5px 0 0;
		    border-color: #e0e0e0;
		    border-style: solid;
		}
		.searchBar .openContainer {
		    border: 0;
		}
		.btnClose {
		    display: none;
		}
		.btnClose, .btnSearchText {
		    cursor: pointer;
		}
		.openSearch .searchGroup {
		    transition-property: width;
		    transition-duration: .5s;
		    transition-timing-function: linear;
		    -webkit-transition-property: width;
		    -webkit-transition-duration: .5s;
		    -webkit-transition-timing-function: linear;
		    -moz-transition-property: width;
		    -moz-transition-duration: .5s;
		    -moz-transition-timing-function: linear;
		}
		.searchBar .field form {
		    display: inline-block;
		    width: 100%;
		}
		.searchGroup {
		    padding: 25px 20px 0;
		    width: 20%;
		    height: 68px;
		    overflow: hidden;
		    box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		}
		.searchGroup input {
		    background-color: transparent;
		    border: 0;
		    font-size: 20px;
		    width: 79%;
		    padding: 8px 5px;
		    box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		    -moz-box-sizing: border-box;
		}
		.btnSearchText {
		    width: 19%;
		    font-size: 32px;
		    border: 0;
		    display: inline-block;
		    padding-top: 5px;
		    padding-bottom: 5px;
		    float: right;
		    border-radius: 0;
			padding: 8px 0; 
		}
		.searchBar .openContainer {
		    height: 68px;
		    border-width: 5px 0 0;
		    border-color: #e0e0e0;
		    border-style: solid;
		}
		.searchBar {
		    margin-top: 30px;
		    display: none;
		}
		.btnSearchText, .btnSearchText:active, .btnSearchText:focus, .btnSearchText:hover {
		    background-color: #fff;
		}
		.searchGroup .field {
		    background-color: #ebebeb;
		}
		@media screen and (min-width: 769px) {
			.searchBar .openContainer {
			    border: 0;
			}
			.searchBar {
			    margin-top: 30px;
			    display: none;
			}
			.rtl .searchBar, .searchBar {
				height: 35px;
				border: 0;
				position: absolute;
				position: block;
				top: 0px;
				overflow: hidden;
				width: 74%;
				left: -1px;
			}
			.js .searchBar {
			    margin: 0;
			}
			.searchGroup {
			    padding: 25px 20px 0;
			    width: 20%;
			    height: 68px;
			    overflow: hidden;
			    box-sizing: border-box;
			    -moz-box-sizing: border-box;
			    -webkit-box-sizing: border-box;
			}
			.searchGroup {
			    padding-top: 0;
			    padding-left: 0;
			    padding-right: 0;
			    height: auto;
			}
			.searchGroup .field {
			    background-color: #ebebeb;
			}
			.searchBar .field {
			    width: 94%;
			}
			.btnClose, .searchBar .field {
			    display: inline-block;
			}
			.searchGroup input {
			    font-size: 21px;
			    padding-top: 5px;
			    padding-bottom: 5px;
			    border: 0;
			    width: 90%;
			    vertical-align: top;
			}
			.btnSearchText {
			    width: 7%;
			    margin-top: 8px;
			    margin-bottom: 3px;
			    border-left: 1px solid #676a6e;
			    font-size: 20px;
			    padding: 0 12px;
			    float: none;
			}
			.btnSearchText, .btnSearchText:active, .btnSearchText:focus, .btnSearchText:hover {
			    background-color: #ebebeb;
			    box-shadow: inset 0 0 0 rgba(255, 255, 255, 0);
			}
			.btnClose {
			    border: 0;
			    border-radius: 0;
			    vertical-align: top;
			    margin-top: 0;
			    width: 6%;
			    margin-left: -7px;
			    font-size: 15px;
			    color: #676a6e;
			    padding: 12px 12px 7px;
			}
			.btnClose, .btnClose:active, .btnClose:focus, .btnClose:hover {
			    background-color: #fff;
			}
		}
		@media screen and (min-width: 959px) {
			.searchGroup input {
			    width: 92%;
			}
		}

		/*------------------------------------------------
		Top Navigation
		------------------------------------------------*/
		.topNavigation ul{
			list-style: none;
		}
		
		.topNavigationList ul.menu > li.menu-item a {
			font-weight: 700;
			font-size: 14px;
			text-decoration: none;
		}
		.top-search {
			display: inline-block;
		    margin-right: 1.5rem;
		    position: relative;
			top: -7px;
		}
		.top-search a{
			font-size: 20px;
		}

		.btnSearch {
		    text-decoration: none;
		}
		.btnSearch span, .btnSearchText span {
		    color: #676a6e;
		}
		.btnSearch span {
		    font-size: 25px;
		}
		.logo {
		    float: right;
		    box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		}
		.logo a img {
		    vertical-align: middle;
		    width: 102px;
		    border: 0;
		}

		.topNavigationList ul#top-nav li.menu-item-has-children a:after {
			font-family: saudiaramco-icons;
		    font-size: 8px;
		    width: 20px;
		    height: 20px;
		    content: '\e617';
		    position: absolute;
		    right: 2px;
		    top: 6px;
		}
		.topNavigationList ul#top-nav li.menu-item-has-children ul.sub-menu a:after {
		    font-size: 0;
		}
		.sub-menu {
			background-color: #fff;
			width: 99%;
			display: block;
			position: absolute;
			top: 100%;
			left: -2px;
			z-index: 1000;
			border-color: #dfdfdf;
			border-style: solid;
			border-width: 0 2px 2px;
			padding: 0;
    		text-align: left;
		}



		@media screen and (min-width: 769px)
		{
			.topNavigationList {
			    display: table;
    		    width: 100%;
			}
			.topNavigationList ul#top-nav {
			    display: table-row;
			    line-height: 2;
			}
			.topNavigationList ul.menu >  li.menu-item {
			    display: table-cell;
			    border: 0;
			    text-align: center;
			    border-left: 1px solid #e3e3e3;
			    position: relative;
			}
			.topNavigationList ul.menu > li.menu-item a {
			    font-weight: 700;
			    font-size: 14px;
			    text-decoration: none;
		     	padding: 0px 38px 0 20px;
			}
			.topNavigationList ul.menu >  li.menu-item a, .top-search a {
				text-transform: capitalize;
				text-decoration: none;
			    text-align: left;
			    color: #7e7e7e;
			}
			.topNavigationList .sub-menu {
			    border-radius: 3px;
			    margin-top: 9px;
			    border-width: 1px;
			    left: 0;
			    display: none;
			}
			.topNavigationList ul.sub-menu > li.menu-item a { 
			  	font-weight: 400;
			    font-size: 12px;
			    padding: 5px 15px;
			}
			.topNavigationList .sub-menu:after, .sub-menu:before {
			    content: '';
			    width: 0;
			    height: 0;
			    position: absolute;
			    top: -10px;
			    right: 6px;
			}
			.topNavigationList .sub-menu:before {
			    border-bottom: 10px solid #dadada;
			    border-left: 10px solid transparent;
			    border-right: 10px solid transparent;
			}
			.topNavigationList .sub-menu:after {
			    border-bottom: 9px solid #fff;
			    border-left: 9px solid transparent;
			    border-right: 9px solid transparent;
			    top: -9px;
			    right: 7px;
			}
			.topNavigationList .sub-menu li a {
			    padding: 12px 14px;
			}
			.topNavigationList .sub-menu li a:hover {
			    background-color: #f5f5f5;
			    border-top: 1px solid #ececec;
			    border-bottom: 1px solid #ececec;
			    padding-top: 11px;
			    padding-bottom: 11px;
			}
			.topNavigationList .sub-menu li a {
			    text-decoration: none;
			    padding: 0px 45px 0 20px;
			    border: 1px solid #ffffff;
			    display: block;
			    width: 100%;
			}
		}

		li.socialmedia {
			padding-left: 10px;
		}
		.socialMediaIconsList div {
		    display: inline-block;
		}
		.topNavigationList ul.menu > li.menu-item .socialMediaIconsList a {
		    padding: 0px 3px 0 6px;
		    font-size: 16px;
		}

		/*------------------------------------------------
		Primary Navigation
		------------------------------------------------*/
		.megaNavigationHeaderLink, .primaryNavigationList li.menu-item > a {
		    font-size: 14px;
		    font-family: frutiger,Arial,sans-serif;
		    font-weight: 600;
		    line-height: 1.2;
		    text-decoration: none;
		    color: inherit;
		    padding: 5px 3px 13px 3px;
		    display: block;
		    position: relative;
		}
		.primaryNavigationList li.li-depth-0:first-child {
		    border-top: none;
		}
		.primaryNavigationList li.li-depth-0{
			list-style-type: none;
			border-top: 2px solid silver;
		}
		.primaryNavigationList li.menu-item > a {
			text-decoration: none;
			color: #676a6e;
		}

		.primaryNavigationList li.menu-item > a {
			font-size: 14px;
			line-height: 5px;
			display: inline-block;
			border-bottom: 5px solid transparent;
		}
		/*.primaryNavigationList .li-depth-0 > a:hover {*/
		.primaryNavigationList .li-depth-0:hover > a {
			border-bottom: 5px solid rgb(0,163,224);
    		border-left: 0;	
		}


		@media screen and (min-width: 641px) {
			header .menuBar {
			    width: 60%;
			    position: relative;
			}
			.logo a img {
			    width: 128px;
			}
		}

		@media screen and (min-width: 769px) {
			.header {
			    height: 88px;
			    padding: 0;
			}
			header .menuBar {
			    padding: 30px 0 0;
			    width: 74.39%;
			}
			.top-search {
			    padding-right: 2%;
			    margin-right: 0;
			    padding-top: 4px;
			    padding-bottom: 0;
			}
			.logo a img {
			    width: 144px;
			}
			.logo {
			    margin-top: 10px;
			}

			.primaryNavigationList {
			    display: table;
    		    width: 100%;
    		    border-top: 1px solid silver;
			}
			.primaryNavigationList ul#primary-nav {
			    display: table-row;
			}
			.primaryNavigationList li.li-depth-0 {
			    display: table-cell;
			    border: 0;
			    text-align: center;
			}
			.primaryNavigationList li.home span:first-child {
			    font-size: 24px;
			    padding: 0 2px;
			}
			

		}
		@media screen and (min-width: 959px) {
			.header {
			    padding: 0;
			}
			.logo a img, .rtl .logo a img {
			    width: 176px;
			}
		}

		/*----------------------------------------------------
		* megamenu
		----------------------------------------------------*/
		.href-1 {
			display: none!important;
		}
		.li-depth-post, .sub-depth-2 {
			list-style: none;
		}
		.aramco-megamenu {
			/* margin-top: 9px; */
			border-width: 1px;
			left: 0;
			display: none;
			border-top: 5px solid rgb(0,163,224);
			position: absolute;
			min-width: 960px;
			width: 100%;
			/* top: 155px; */
			/* top: -45px; */
			z-index: 9999;
			background-color: rgb(103,106,110);
		}
		.primaryNavigationList .sub-depth-0 {
			max-width: 960px;
		    width: 96%;
		    margin: 22px auto 25px;
		    padding: 0;
		}
		.primaryNavigationList li.li-depth-2 {
			text-align: left;
			list-style: none;
			border-bottom: 1px solid gray;
			position: relative;
		}
		.primaryNavigationList li.li-depth-2.have_child {
			border-bottom: 0;
		}
		.primaryNavigationList .sub-depth-2 { 
			border-top: 1px solid gray;
			padding: 20px 0 0 0;
		}
		.primaryNavigationList .sub-depth-2 .li-depth-3 { 
			margin-bottom: 8px;
		}
		.primaryNavigationList li.li-depth-2 > a {
		
		    padding: 0;
		    font-size: 16px;
		    padding: 18px 25px 3px 0;
		    font-weight: 600;
		    text-align: left;
		    line-height: 1.2;
	        word-break: break-word;
		    color: #fff
		}
		.primaryNavigationList li.li-depth-3 > a { 
		    font-size: 14px;
		    padding: 0;
		    list-style: none;
		    font-weight: 200;
		    text-align: left;
		    line-height: 1.2;
	        word-break: break-word;
		    color: rgb(218,218,218);
		}
		li.menu-item.li-depth-3:before {
		    font-weight: 700;
		    color: rgb(218,218,218);
		    position: relative;
		    left: -3px;
		    font-family: saudiaramco-icons;
		    font-size: 9px;
		    content: '\e619';
		    padding-left: 10px;
		    text-decoration: none;
		}
		.primaryNavigationList li.li-depth-2 a:hover {
			/*color: #84bd00;*/
			color: rgb(0,163,224);
		}
		.primaryNavigationList li.li-depth-2:after {
		    content: '\e616';
		    font-family: saudiaramco-icons;
		    position: absolute;
		    right: 0;
		    top: 18px;
		    color: #989898;
		}
		.primaryNavigationList .sub-depth-0 li.li-depth-1 {
		    width: 25%;
	        display: inline-block;
	        list-style: none;
	        vertical-align: top;
		}
		.closeNav {
			font-family: saudiaramco-icons;
		    font-size: 20px;
		    display: inline-block;
		    border: 1px solid #fff;
		    border-top: 0;
		    color: #fff;
		    width: 80px;
		    height: 30px;
		    background: rgb(103,106,110);
		    position: relative;
		    top: 31px;
		}
		.closeNav:before {
		    content: '\e60d';
		    position: relative;
		    top: -3px;
		}
		.hide {
			display: none!important;
		}

		/*@media screen and (min-width: 769px)*/
		.aramco-megamenu .card {
		    text-align: left;
		    padding: 20px 0 0;
		    border-left: 1px solid transparent;
		    border-right: 1px solid transparent;
		    box-shadow: none;
		    -moz-box-shadow: none;
		    -webkit-box-shadow: none;
		}
		.aramco-megamenu .card strong a {
		    text-decoration: none;
		    display: inline-block;
		    color: inherit;
		}
		.aramco-megamenu .card strong, .aramco-megamenu .card strong a {
		    font-size: 14px;
		    font-family: frutiger,Arial,sans-serif;
		    font-weight: 700;
		    line-height: 1.2;
		}
		.aramco-megamenu .card strong {
		    color: gray;
		    margin-bottom: 5px;
		}
		.aramco-megamenu .card h2, .aramco-megamenu .card strong {
		    padding: 0 9.46%;
		}
		.aramco-megamenu .card h2, .aramco-megamenu .card h2 a {
			 text-decoration: none;
		    font-weight: 300;
		}
		.aramco-megamenu .card h2 {
		    font-size: 21px;
		    color: #000;
		    margin-top: 5px;
		    margin-bottom: 20px;
		    line-height: 1.2;
		}
		.card h2 a {
		    color: rgb(103,106,110);
		}
		.aramco-megamenu .card h2, .aramco-megamenu .card h2 a {
		    font-weight: 300;
		}
		.aramco-megamenu .card img {
		    width: 100%;
		}	

		.card h2 a:hover, .card h3 a:hover {
		    text-decoration: underline;
		}
		li.li-depth-0 > a.selected {
		 	color: rgb(0,163,224);
		}

		/*----------------------------------------
		*  MOBILE MENU
		-----------------------------------------*/
		.mobile-menu {
		    display: inline-block;
		    color: #676a6e;
		    font-size: 22.5px;
		    padding: 0 .5rem;
		    margin-right: 1.2rem;
		    position: relative;
		    top: 4px;
		    -webkit-border-radius: 3px;
		    -moz-border-radius: 3px;
		    -ms-border-radius: 3px;
		    -o-border-radius: 3px;
		    border-radius: 3px;
		}
		.active, .primaryNavigation.active {
		    display: block;
		}
		.mobile-navigation-cnt {
			display: none;
		    position: absolute;
		    left: 0;
		    margin-top: 20px;
		    z-index: 10000;
		    width: 100%;
		}
		.mobile-navigation-cnt.active {
		    display: block;
		}
		.mobile-navigation-card {
		    background: #fff;
		}
		.mobile-navigation-card, .mobile-navigation-card li {
		    font-size: 16px;
		    font-family: frutiger,Arial,sans-serif;
		    font-weight: 400;
		    line-height: 1.2;
		    padding: 0;
		}
		.mobile-navigation-card .open>a, .mobile-navigation-card.open>li {
		    padding: 17px 20px;
		    background: #fff;
		    border-bottom: 1px solid #dadada;
		}
		.mobile-navigation-card.open>li.home, .mobile-navigation-card>li.back {
		    color: #303030;
		    padding: 17px 20px;
		    border-bottom: 1px solid #dadada;
		    font-size: 16.5px;
		}
		
		.mobile-navigation-card .open>a, .mobile-navigation-card li.home {
		    font-weight: 700;
		    border-left: 4px solid #00a3e0;
		}
		.mobile-navigation-card .open>a, .mobile-navigation-card.open>li>a {
		    color: #303030;
		}
		.mobile-navigation-card .open>a:hover, .mobile-navigation-card.open>li>a:hover {
		    color: #00a3e0;
		}
		/*active page*/
		.mobile-navigation-card a.selected, .mobile-navigation-card a:hover, .mobile-navigation-card.open>li>a.selected {
		    color: #00a3e0;
		}
		.mobile-navigation-card a {
		    display: block;
		    color: #fff;
		    text-decoration: none;
		}
		
		.mobile-navigation-card .off-screen, .mobile-navigation-card .open, .mobile-navigation-card .open>ul>li, .mobile-navigation-card.off-screen .open {
		    display: block!important;
		}
		.mobile-navigation-card .open>ul>li, .mobile-navigation-card li.back, .mobile-navigation-card.open li.home, .mobile-navigation-card.open>li {
		    display: block;
		}
		.mobile-navigation-card .off-screen>a, .mobile-navigation-card .off-screen>ul>li, .mobile-navigation-card li, .mobile-navigation-card li.home, .mobile-navigation-card.open li.back {
		    font-size: 16.5px;
		    display: none;
		}
		.mobile-navigation-card.open>li.home a:before, .mobile-navigation-card>li.back:before {
		    font-family: saudiaramco-icons;
		    color: #303030;
		    content: '\e60a \0000a0';
		    font-weight: 400;
		}
		.mobile-navigation-card .open .parent a:after, .mobile-navigation-card .open>a:after, .mobile-navigation-card.open .parent a:after {
		    font-family: saudiaramco-icons;
		    content: '\e616';
		    font-weight: 400;
		    float: right;
		    color: #303030;
		}
		.mobile-navigation-card .open .parent a:after, .mobile-navigation-card.open .parent a:after {
		    content: '\e614';
		}
		.mobile-navigation-card>li.back:before {
			content: '\e601 \0000a0';
		}
		.mobile-menu.focus {
		    background-color: #00a3e0;
		    color: #fff;
		}
		.mobile-navigation-card>li.back {
		    cursor: pointer;
		}
		/*submenu*/
		.mobile-navigation-card .open>ul {
		    background: #303030;
		    padding-left: 0;
		}
		.mobile-navigation-card ul {
		    padding-left: 0;
		}
		.mobile-navigation-card .open>ul li {
		    margin: 0 20px;
		}
		.mobile-navigation-card a {
		    display: block;
		    color: #fff;
		    text-decoration: none;
		}
		.mobile-navigation-card .open>ul a {
		    border-bottom: 1px inset #525252;
		    padding: 17px 0;
		}
		.mobile-navigation-card a.selected, .mobile-navigation-card a:hover, .mobile-navigation-card.open>li>a.selected {
		    color: #00a3e0;
		}
		@media screen and (max-width: 768px) {
			.topNavigation {
				display: none;
			}
			.primaryNavigationList {
			    display: none;
			    border-top: 5px solid #f2f2f2;
			}
			.top-search {
			    margin-right: 15px;
			    top: 3px;
			    left: -14px;
			}
			.headerEdit {
				padding: 15px 0 20px;
			}
		}
		@media screen and (min-width: 769px)
		{
			.topNavigation {
				display: inline-block;
			}
			.mobile-menu {
			    display: none;
			    top: 0;
			}
		}
		  	
	</style>
	<script type="text/javascript">
		jQuery('document').ready(function($){
		 	
		 	// TOP NAV SUBMENU
	 	 	$(document).on("click",".menu-item-has-children",function(e){
 	 		  	e.preventDefault();
 	 		  	$(this).find(".sub-menu").toggle();
	 	 	});
	 	 	$(document).on("mouseleave",".sub-menu",function(e){
 	 		  	e.preventDefault();
 	 		  	$(this).toggle();
	 	 	});

	 	 	// MEGA MENU
 	 	    $(".li-depth-0, .aramco-megamenu").hover(function () {
 	 	        $(this).find(".aramco-megamenu").show();
 	 	    }, function() {
 	 	        $(".aramco-megamenu").hide();
	 	 	}); 
	 	 	$(document).on("click",".closeNav",function(e){ 
	 	 		e.preventDefault();
	 	 		$(".aramco-megamenu").hide();
	 	 	});

	 	 	// SEARCH
	 	 	$(document).on("click",".btnSearch",function(e){
 	 		  	e.preventDefault();
 	 		  	//$(".menuBar").hide();
 	 		  	$(".searchBar").show();
 	 		  	setTimeout(function(){ 
 	 		  		$('.header').addClass('openSearch');
 	 		  	}, 100);
	 	 	});
	 	 	$(document).on("click",".btnClose",function(e){
 	 		  	e.preventDefault();
 	 		  	//$(".menuBar").show();
 	 		  	$(".searchBar").hide(); 
 	 		  	$('.header').removeClass('openSearch');	 		  	
	 	 	});

	 	 	//  MOBILE MENU
	 	 	$(document).on("click","#js-mobile-menu",function(e){
 	 		  	e.preventDefault();
 	 		  	$('#js-mobile-nav-cnt').toggleClass('active');	 		  	
 	 		  	$('#js-mobile-menu').addClass('focus');	 		  	
 	 		  	$('.mobile-navigation-card').addClass('open');	 		  	
	 	 	});

	 	 	$(document).on("click",".parent",function(e){
	 	 		e.stopPropagation();
	 	 		if(!$(this).first().hasClass('open')) {
 	 				e.preventDefault();
	 	 		} 

				if ($('.mobile-navigation-card').hasClass('open')) {
					$('.mobile-navigation-card').removeClass('open');
				}
					
				
				$(this).addClass('open');
				$tg = $('.parent.open').length;
				if($tg > 1){
					$('.parent.open').first().addClass('off-screen').removeClass('open');	
				} else {
					console.log('1');
					$(this).addClass('open');
				}
				
	 	 	});	 	 	

	 	 	$(document).on("click",".js-back",function(e){
 	 		  	e.preventDefault();
 	 		  	if(!$('.parent').hasClass('off-screen')) {
 	 		  		$('.mobile-navigation-card').addClass('open');
 	 		  		$('.parent').removeClass('open');
 	 		  	} else {
 	 		  		$(".open").first().removeClass("open");	
 	 		  		$(".off-screen").last().addClass("open").removeClass("off-screen");

 	 		  		
 	 		  	}
 	 		  	
 	 		  	// $('.mobile-navigation-card.open li.home, .mobile-navigation-card.open>li').hide();
 	 		  	/*$('#js-mobile-nav-cnt').toggleClass('active');	 		  	
 	 		  	$('#js-mobile-menu').toggleClass('focus');*/	 		  	
	 	 	});

		});
	</script>
	<div id="content" class="site-content">
