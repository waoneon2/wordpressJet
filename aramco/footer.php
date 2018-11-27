<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aramco
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container">

      <?php
      $footer_copy = (get_theme_mod('footer_copyright')) ? get_theme_mod('footer_copyright') : 'Copyright Aramco Services Company';
       if (is_page_template( 'page-three-column.php' )):
          if(has_nav_menu('footer-nav')) {
            wp_nav_menu(
                array(
                  'theme_location' => 'footer-nav',
                  'container_class' => 'menu-footer-navigation-container page-tree-col'
                )
              );
          } ?>
          <p class="copyright"><?php echo ' '.$footer_copy ?></p>
      <?php else: ?>
  			<div class="footer-widget">
  				<div class="coll coll1"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : endif; ?></div>
  				<div class="coll coll2"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : endif; ?></div>
  				<div class="coll coll3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : endif; ?></div>
  			</div>
  			<?php
  			if(has_nav_menu('footer-nav')):
  				wp_nav_menu(
  						array(
  							'theme_location' => 'footer-nav',
  							'container_class' => 'menu-footer-navigation-container'
  						)
  					);
  			endif;
  				?>
  			<p class="copyright"><?php echo ' '.$footer_copy ?></p>
		<?php endif; ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<style type="text/css">


#colophon {
	color: #fff;
    font-family: frutiger,Arial,sans-serif;
    font-weight: 400;
    background-color: rgb(103,106,110);
}

.footer-widget:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}

.footer-widget .coll {
	padding: 0 6.5%;
    width: 100%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
.footer-widget .coll1 li{
	display: inline-block;
}
.footer-widget .coll.coll1 li {
    width: 48%;
}
.footer-widget .coll2 li,
.footer-widget .coll3 li {
    width: 100%;
    display: inline-block;
    vertical-align: top;
    /*padding: 8px 0 16px;*/
    position: relative;
    font-weight: 400;
}

.footer-widget .coll2 li a,
.footer-widget .coll3 li a {
    display: inline-block;
    width: 90%;
    color: inherit;
    position: relative;
	left:15px;
}

.footer-widget .coll li a {
    text-decoration: none;
    color: rgb(218,218,218);
}

.footer-widget .coll li a:hover{
	color: #00a3e0;
}

.footer-widget .coll h1 {
    font-weight: 700;
    line-height: 1.2;
    font-size: 16px;
    margin: 0 0 20px;
    -webkit-font-smoothing: antialiased;
    padding: 33px 0 10px;
    margin: 0 0 20px;
    border-bottom: 2px solid gray;
    color: #fff;
}

.footer-widget .coll1 {
	display: none;
}

.footer-widget .coll2 ul,
.footer-widget .coll3 ul {
	margin: 20px 0 30px;
    padding: 0;
    list-style: none;
}

.coll2 li>span,
.coll3 li>span {
	font-size: 12px;
    color: silver;
    position: absolute;
    left: 0;
    top: 4px;
}

.menu-footer-navigation-container ul {
	padding: 0;
    margin: 0;
    list-style: none;
    vertical-align: top;
}

.menu-footer-navigation-container ul li {
	background-color: #191919;
    display: inline-block;
    /*margin-left: 3px;*/
    margin-top: 5px;
    width: 49.5%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    font-size: 13px;
}

.menu-footer-navigation-container ul li.float-right {
    background-color: transparent;
}
.menu-footer-navigation-container ul li:nth-child(odd) {
    margin-left: -3px;
}

.menu-footer-navigation-container ul li:nth-child(1), .menu-footer-navigation-container ul li:nth-child(2) {
	margin-top: 0;
}

.menu-footer-navigation-container ul a {
	color: #fff;
    padding: 0 10px 0 30px;
    overflow: auto;
    height: 50px;
    display: table-cell;
    vertical-align: middle;
    font-size: inherit;
    text-decoration: none;
}
.menu-footer-navigation-container ul a:hover {
	color: #84bd00;
}

.footer-container .copyright {
	font-size: 12px;
    font-family: frutiger,Arial,sans-serif;
    line-height: 1.5;
    margin: 0;
    padding: 30px;
    text-align: center;
}

.footer-tagline {

}
/*----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------*/

@media screen and (min-width: 641px){

	#colophon {
		padding: 20px 20px;
	}

	.footer-container {
		max-width: 960px;
    	margin: 0 auto;
	}

	.footer-widget {
		margin-bottom: 40px;
	}

	.footer-widget .coll {
		float:left;
		padding: 0;
		box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    -webkit-box-sizing: border-box;
	    color:rgb(218,218,218);
	}

	.footer-widget .coll1, .footer-widget .coll3 {
		display: block;
		width: 23.0769%;
	}

	.footer-widget .coll2 {
		width: calc(23.0769% * 2 + 2.494%);
	}

	.footer-widget .coll:not(:first-child) {
		margin-left: 2.494%;
	}

	.footer-widget .coll h1 {
		font-size: 16px;
	    border-bottom: 1px solid #fff;
	    padding: 8px 0 10px;
	    margin-bottom: 25px;
	    color: #fff;
	    font-weight: 700;
	}

	.footer-widget .coll ul {
		margin:0;
	    padding: 0;
	    list-style: none;
	}
	.footer-widget .coll2 li {
		width: 47%;
	    display: inline-block;
	    font-size: 14px;
	    margin-left: 0;
	    padding-bottom: 10px;
	    padding-top: 0;
	    box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    -webkit-box-sizing: border-box;
	}

	.footer-widget .coll2 li a {
	    padding: 0 0 4px;
	    width: 91%;
	    display: inline-block;
	}

	.footer-widget .coll li a {
		font-size: 12px;
	    position: relative;
	}
	.footer-widget .coll2 li a, .footer-widget .coll3 li a {
	    left: 15px;
	}

	.coll li>span {
	    font-size: 8px;
	    padding-top: 2px;
	    padding-bottom: 5px;
	    top: auto;
	}

	.menu-footer-navigation-container {
		width: 74.2187%;
    	float: left;
	}

	.menu-footer-navigation-container:before {
		content: " ";
	    display: block;
	    clear: both;
	    width: 0;
	    height: 0;
	    visibility: hidden;
	}
	/* .menu-footer-navigation-container ul {
		display: flex;
	} */
  .menu-footer-navigation-container.page-tree-col  ul {
    display: block;
  }
	.menu-footer-navigation-container ul li {
	    background: 0 0;
	    width: auto;
	    margin: 0;
	    line-height: 1.8;
	    flex:auto;
	    text-align: center;
	}

	.menu-footer-navigation-container ul li:nth-child(1){
		text-align: left;
	}
	.menu-footer-navigation-container ul li:nth-last-child(1){
		text-align: right;
	}
		.menu-footer-navigation-container ul li:nth-last-child(1) > a{
		padding-right: 0;
	}
	.menu-footer-navigation-container ul a {
		padding:1px 10px 0;
	    font-size: 12px;
	    font-weight: bold;
	    overflow: visible;
	    height: auto;
	    display: inline-block;
	    /*border-left: 1px solid #fff;*/
	    line-height: 1;
	}
	.menu-footer-navigation-container li:first-child a {
	    padding-left: 0;
	    border-left: 0;
	}
	.footer-container .copyright {
	    font-size: 12px;
	    margin: 4px 0 0;
	    width: 23.0769%;
	    color: #fff;
	    float: right;
	    padding: 0;
	}
}

/* @media screen and (max-width: 576px){
	.menu-footer-navigation-container ul {
		display: flex;
	}
} */
.footer-tagline {
	font-family: inherit;;
    font-size: 23px;
	width: 100%;
	margin-bottom: 40px;
	text-align: right;
	line-height: 1;
}

.footer-tagline span {
	font-size: 6px;
	display: inline-block;
	vertical-align: top;
}

.coll1 ul li.textHighlightSmall a {
	font-size: 10px;
}
.coll1 ul li.textHighlightMedium a {
	font-size: 14px;
}
.coll1 ul li.textHighlightLarge a {
	font-size: 22px;
}
/*----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------*/

@media screen and (min-width: 769px){

}

/*----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------*/
@media screen and (min-width: 959px){
	.footer-widget .coll h1 {
		font-size: 16px;
	    border-bottom: 1px solid #fff;
	    padding: 8px 0 10px;
	    margin-bottom: 25px;
	}

	.footer-widget .coll li {
		padding-bottom: 5px;
	}

	.footer-widget .coll li a {
		font-size: 14px;
	}

	.menu-footer-navigation-container ul a {
	    padding-top: 2px;
	    font-size: 14px;
	}
  .menu-footer-navigation-container.page-tree-col ul a {
    font-size: 12px;
     padding: 0 4px;
  }
	.footer-container .copyright {
		margin-top: 5px;
	}
}

[data-icon]:before {
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

</style>

</body>
</html>
