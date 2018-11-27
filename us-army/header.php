<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package US_Army
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
	<h2 id="myarmyHeader">
		<div class="container">
			<div class="row">
				<a href="http://www.army.mil/myarmy/" target="_blank" id="miniHeader">
					My.Army.Mil. Learn more about <strong>your</strong> Army media. How <strong>you</strong> like it.
				</a>
			</div>
		</div>
	</h2>
	<div id="page-container" class="container">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'us-army' ); ?></a>
		<?php function printHeaderImage() {
		    $headerImage = get_header_image();
		    if ( '' == $headerImage ) {
		      $headerImage = get_template_directory_uri() . '/img/header-logo.png';
		    }
		    echo( $headerImage );
		} ?>
		<header id="masthead" class="site-header" role="banner">
      <div class="">
      	<div class="header-section-wrap hidden-xs">
      		<div class="header-section-lt ">
      			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" src="<?php printHeaderImage() ?>"></a>
      		</div>
      		<div class="header-section-rt">
      			<h1><?php echo get_bloginfo('title') ?></h1>
      			<h3><?php echo get_bloginfo('description') ?></h3>
      		</div>
      	</div>
      </div>
      <nav id="site-navigation" class="main-nav navbar navbar-inverse" role="navigation">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
				    <span class="sr-only">Menu</span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				  </button>
				  <div class="navbar-wrap visible-xs">
				    <div class="navbar-logo">
				      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php printHeaderImage(); ?>" align="left" src="" alt="logo" border="0"></a>
				    </div>
				    <div class="navbar-title">
				      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('title') ?></a>
				    </div>
				  </div>
				</div>
				<div class="navbar-collapse no-padding collapse" id="menuBar" aria-expanded="false" style="height: 1px;">
				  <?php
				  if ( has_nav_menu( 'menu-1' ) ) {
				    wp_nav_menu( array(
				    'theme_location' => 'menu-1',
				    'menu_class' => 'main-nav nav navbar-nav nav-with-js sf-menu sf-js-enabled',
				    'walker' => new us_army_walker_nav_menu()
				    ));
				  } else {
				    esc_html_e( 'Primary Navigation', 'us-army' );
				  }?>
					<div role="search" id="liveSearch">
					  <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="searchForm">
					    <h2>
					      <label class="hide" for="search">Search</label>
					      <input type="text" size="32" id="search" name="s" placeholder="Search Press Center..." >
					      <input type="submit" id="searchbutton" class="searchclose" value=".">
					    </h2>
					  </form>
					</div>
				</div>
			</nav>
		</header><!-- #masthead -->
<script type="text/javascript">
	;(function($){
		$.fn.superfish = function(op){
			console.log('sf');
			var sf = $.fn.superfish,
				c = sf.c,
				$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
				over = function(){
					var $$ = $(this), menu = getMenu($$);
					clearTimeout(menu.sfTimer);
					$$.showSuperfishUl().siblings().hideSuperfishUl();
				},
				out = function(){
					var $$ = $(this), menu = getMenu($$), o = sf.op;
					clearTimeout(menu.sfTimer);
					menu.sfTimer=setTimeout(function(){
						o.retainPath=($.inArray($$[0],o.$path)>-1);
						$$.hideSuperfishUl();
						if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
					},o.delay);
				},
				getMenu = function($menu){
					var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
					sf.op = sf.o[menu.serial];
					return menu;
				},
				addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };

			return this.each(function() {
				var s = this.serial = sf.o.length;
				var o = $.extend({},sf.defaults,op);
				o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
					$(this).addClass([o.hoverClass,c.bcClass].join(' '))
						.filter('li:has(ul)').removeClass(o.pathClass);
				});
				sf.o[s] = sf.op = o;

				$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
					if (o.autoArrows) addArrow( $('>a:first-child',this) );
				})
				.not('.'+c.bcClass)
					.hideSuperfishUl();

				var $a = $('a',this);
				$a.each(function(i){
					var $li = $a.eq(i).parents('li');
					$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
				});
				o.onInit.call(this);

			}).each(function() {
				var menuClasses = [c.menuClass];
				if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
				$(this).addClass(menuClasses.join(' '));
			});
		};

		var sf = $.fn.superfish;
		sf.o = [];
		sf.op = {};
		sf.IE7fix = function(){
			var o = sf.op;
			if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
				this.toggleClass(sf.c.shadowClass+'-off');
			};
		sf.c = {
			bcClass     : 'sf-breadcrumb',
			menuClass   : 'sf-js-enabled',
			anchorClass : 'sf-with-ul',
			arrowClass  : 'sf-sub-indicator',
			shadowClass : 'sf-shadow'
		};
		sf.defaults = {
			hoverClass	: 'sfHover',
			pathClass	: 'overideThisToUse',
			pathLevels	: 1,
			delay		: 800,
			animation	: {opacity:'show'},
			speed		: 'normal',
			autoArrows	: true,
			dropShadows : true,
			disableHI	: false,		// true disables hoverIntent detection
			onInit		: function(){}, // callback functions
			onBeforeShow: function(){},
			onShow		: function(){},
			onHide		: function(){}
		};
		$.fn.extend({
			hideSuperfishUl : function(){
				var o = sf.op,
					not = (o.retainPath===true) ? o.$path : '';
				o.retainPath = false;
				var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
						.find('>ul').hide().css('visibility','hidden');
				o.onHide.call($ul);
				return this;
			},
			showSuperfishUl : function(){
				var o = sf.op,
					sh = sf.c.shadowClass+'-off',
					$ul = this.addClass(o.hoverClass)
						.find('>ul:hidden').css('visibility','visible');
				sf.IE7fix.call($ul);
				o.onBeforeShow.call($ul);
				$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
				return this;
			}
		});

	})(jQuery);
</script>
		<div id="content" class="site-content">
