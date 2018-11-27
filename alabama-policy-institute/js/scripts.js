/**
 * --------------------------------------------------------------------------
 * SCRIPTS
 * --------------------------------------------------------------------------
 *
 * Here we define config of APP
 */

'use strict';

var APP = {
	utilities: {},
	config: {}
};

/**
 * --------------------------------------------------------------------------
 * CONSTANTS
 * --------------------------------------------------------------------------
 *
 * Load tested earlier, universal modules
 */

/**
 * --------------------------------------------------------------------------
 * PubSub - Publish Subscibe (Mediator)
 * --------------------------------------------------------------------------
 */

APP.utilities.pubsub = {
	pubsub: {},
	subscribe: function (pubName, fn) {
		this.pubsub[pubName] = this.pubsub[pubName] || [];
		this.pubsub[pubName].push(fn);
	},
	unsubscribe: function(pubName, fn) {
		if (this.pubsub[pubName]) {
			for (var i = 0; i < this.pubsub[pubName].length; i++) {
				if (this.pubsub[pubName][i] === fn) {
					this.pubsub[pubName].splice(i, 1);
					break;
				}
			};
		}
	},
	publish: function (pubName, data) {
		if (this.pubsub[pubName]) {
			this.pubsub[pubName].forEach(function(fn) {
				fn(data);
			});
		}
	}
};

/**
 * --------------------------------------------------------------------------
 * BREAKPOINTS
 * --------------------------------------------------------------------------
 */

APP.utilities.breakpoints = (function() {

	// --------------------------------------------------------------------------
	// Get HTML body::before pseudoelement content.
	// It should be include-media variable, eg. '(sm: 576px, md: 768px, lg: 992px, xl: 1200px)'

	var data = window.getComputedStyle(document.body, '::before').getPropertyValue('content').replace(/[\"\'\s]/g, '');

	// Cut the (brackets)
	data = data.slice(1, -1);

	// Split data by comma
	var dataArr = data.split(',');
	dataArr.unshift('zero:0px');

	// --------------------------------------------------------------------------

	function checkBreakpoint() {

		dataArr.forEach(function(val, i) {

			var breakpoint = val.split(':');
			var breakpointName = breakpoint[0];
			var currValue = breakpoint[1].slice(0, -2);

			if (i !== dataArr.length - 1) { var nextValue = dataArr[i+1].split(':')[1].slice(0, -2) - 1; }

			if (i === 0) { var query = window.matchMedia('screen and (max-width: '+ nextValue +'px)'); }
			else if (i === dataArr.length - 1) { var query = window.matchMedia('screen and (min-width: '+ currValue +'px)'); }
			else { var query = window.matchMedia('screen and (min-width: '+ currValue +'px) and (max-width: '+ nextValue +'px)'); }

			query.addListener(change);
			function change() { query.matches ? APP.utilities.pubsub.publish('breakpoint', [breakpointName, currValue]) : null; }
			change();

		});
	}

	checkBreakpoint();

	// --------------------------------------------------------------------------
	// Return

	return {
		check: checkBreakpoint
	}

})();


/**
 * --------------------------------------------------------------------------
 * MODULES
 * --------------------------------------------------------------------------
 *
 * Load specific to the project modules
 */

/**
 * --------------------------------------------------------------------------
 * VIEW
 * --------------------------------------------------------------------------
 */

APP.utilities.view = (function() {

	// --------------------------------------------------------------------------
	// Cache DOM

	var $code = $('#breakpoint');

	// --------------------------------------------------------------------------
	// Bind events

	APP.utilities.pubsub.subscribe('breakpoint', setDeviceInfo);

	// --------------------------------------------------------------------------
	// Functions

	function setDeviceInfo(value) {
		$code.text(value[0]+', min-width: '+ value[1] +'px');
	}

	APP.utilities.breakpoints.check();

})();

/**
* --------------------------------------------------------------------------
* VIEW
* --------------------------------------------------------------------------
*/

APP.utilities.menu = (function() {

	// --------------------------------------------------------------------------
	// Menu toggle button
	$('.menu__toggle .btn').on('click', function(){
		if( $( window ).width() > 1199 ) {
			//$('.menu').toggleClass('shrinked');
            if($('.menu').hasClass('open')) {
                $('.menu').addClass('closed').removeClass('open').removeClass('open-start');
                $('.main-content').addClass('closed').removeClass('open').removeClass('open-start');
            } else if($('.menu').hasClass('open-start') && $('.menu').hasClass('shrinked')) {
                $('.menu').addClass('open').removeClass('closed');
                $('.main-content').addClass('open').removeClass('closed');
            } else if($('.menu').hasClass('open-start')) {
                $('.menu').addClass('closed').removeClass('open').removeClass('open-start');
                $('.main-content').addClass('closed').removeClass('open').removeClass('open-start');
            } else {
                $('.menu').addClass('open').removeClass('closed');
                $('.main-content').addClass('open').removeClass('closed');
            }

		} else {
			$('.menu').toggleClass('open');
			$('.main-content').toggleClass('menu-open');
			$('.header-mobile').toggleClass('menu-open');
		}
	});

	// --------------------------------------------------------------------------
	// Menu auto collapsed after scroll

	if($('.featured-img').length && $( window ).width() > 1199 ) {
		var $menu = $('.menu');
		var $featuredImg = $('.featured-img');
		var $featuredImgHeight = $featuredImg.height();

		$(window).scroll(function(){
			if($(window).scrollTop() > $featuredImgHeight){
				$menu.addClass('shrinked');
				$('.main-content').addClass('shrinked');
			}
			else{
				$menu.removeClass('shrinked');
                $('.main-content').removeClass('shrinked');
			}
		});
	}

	// --------------------------------------------------------------------------
	// Menu sub-nav
	$('.menu__link--with-sub-list').on('click', function(e){
		e.preventDefault();
		$(this).toggleClass('menu__link--active');
		$(this).siblings('.menu__sub-list').slideToggle();
	});


	// --------------------------------------------------------------------------
	// Search form
	$('.search__icon').on('click', function(){
		$('.search').toggleClass('search--open');
		$(this).siblings('.search__form').slideToggle();
		$('.search').siblings().toggleClass('covered');
	});


})();

/**
* --------------------------------------------------------------------------
* VIEW
* --------------------------------------------------------------------------
*/

APP.utilities.smoothScroll = (function() {

	// --------------------------------------------------------------------------
	// Timeline - jRange
	$('.btn--scroll-down').on('click', function(){
		$('html, body').animate({
			scrollTop: $('.hero').outerHeight()
		}, 500);
	});

})();

/**
 * --------------------------------------------------------------------------
 * VIEW
 * --------------------------------------------------------------------------
 */

APP.utilities.herolist = (function() {

	// --------------------------------------------------------------------------
	// Staff listing
	$('.hero-list__toggle').on('click', function(){
		$(this).toggleClass('hero-list__toggle--active');
		$('.hero-list__wrapper').slideToggle();
	});

})();

/**
* --------------------------------------------------------------------------
* VIEW
* --------------------------------------------------------------------------
*/

APP.utilities.timeline = (function() {

	// --------------------------------------------------------------------------
	// Timeline - jRange
	if( $('.range-slider').length ) {
		$('.range-slider').jRange({
			from: 1940,
			to: 2017,
			step: 1,
			scale: [1940,1960,1980,2000,2017],
			format: '%s',
			width: 653,
			showLabels: true,
			isRange : true
		});
		$('.range-slider').jRange('setValue', '1951,2017');
	}

})();

