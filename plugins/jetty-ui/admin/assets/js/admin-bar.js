(function ( $ ) {
	"use strict";

	$.expr.filters.offscreen = function(el) {
	  var rect = el.getBoundingClientRect();
	  return (
	           (rect.x + rect.width) < 0 
	             || (rect.y + rect.height) < 0
	             || (rect.x > window.innerWidth || rect.y > window.innerHeight)
	         );
	};

	if (!Array.from) {
	  Array.from = (function () {
	    var toStr = Object.prototype.toString;
	    var isCallable = function (fn) {
	      return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
	    };
	    var toInteger = function (value) {
	      var number = Number(value);
	      if (isNaN(number)) { return 0; }
	      if (number === 0 || !isFinite(number)) { return number; }
	      return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
	    };
	    var maxSafeInteger = Math.pow(2, 53) - 1;
	    var toLength = function (value) {
	      var len = toInteger(value);
	      return Math.min(Math.max(len, 0), maxSafeInteger);
	    };

	    return function from(arrayLike/*, mapFn, thisArg */) {
	      var C = this;
	      var items = Object(arrayLike);
	      if (arrayLike == null) {
	        throw new TypeError("Array.from requires an array-like object - not null or undefined");
	      }
	      var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
	      var T;
	      if (typeof mapFn !== 'undefined') {
	        if (!isCallable(mapFn)) {
	          throw new TypeError('Array.from: when provided, the second argument must be a function');
	        }

	        if (arguments.length > 2) {
	          T = arguments[2];
	        }
	      }

	      var len = toLength(items.length);
	      var A = isCallable(C) ? Object(new C(len)) : new Array(len);
	      var k = 0;
	      var kValue;
	      while (k < len) {
	        kValue = items[k];
	        if (mapFn) {
	          A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
	        } else {
	          A[k] = kValue;
	        }
	        k += 1;
	      }
	      A.length = len;
	      return A;
	    };
	  }());
	}

	$(function () {

		function setTabIndexInNextFrame(tabHandler) {
			if (tabHandler.ctabix < tabHandler.menus.length) {
				tabHandler.menus[tabHandler.ctabix].focus();
				tabHandler.ctabix += 1;
				tabHandler.cancel = void 0;
			} else {
				tabHandler.menus[0].focus();
				tabHandler.ctabix = 1;
				tabHandler.cancel = void 0;
			}
		}

		function getCurrentActive() {
			return document.querySelector('#adminmenu li.wp-has-current-submenu a.menu-top')
		}

		function refEqual(a, b) {
			return a === b;
		}

		function elementIsVisible(elem) {
		    return !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );
		}

		function _uncons(empty, f, xs) {
  		return xs.length === 0 ? empty : f(xs[0], xs.slice(1));
		}

		function nubBy(f, xs) {
			return _uncons([], function (head, tail) {
				return [head].concat(nubBy(f, tail.filter(function (x) {
					return !f(head, x)
				})))
			}, xs)
		}

		function TabIndexHandler() {
			var menus = Array.from(document.querySelectorAll('#adminmenu li.menu-top a.menu-top'));
			var current = getCurrentActive();
			var extra = [];
			if (current && current.parentNode !== null) {
				extra = Array.from(current.parentNode.querySelectorAll('ul.wp-submenu li a'));
			}
			var ix = current != null ? menus.indexOf( current ) : 0;
			if (current != null && extra.length > 0 && ix !== -1) {
				var head = menus.slice(0, ix + 1);
				var tail = menus.slice(ix + 1, menus.length);
				menus = [].concat(head, extra, tail)
			}
			menus = nubBy(function (a, b) { return a.href === b.href }, menus.filter(elementIsVisible));
			var ix = current != null ? menus.indexOf( current ) : 0;
			this.ctabix = ix;
			this.cancel = void 0;
			this.menus = menus;
		}

		TabIndexHandler.prototype.handleEvent = function(event) {
			var k = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

			if (k === 9 ) {
				var $_el = document.activeElement;
				if($_el.tagName !== 'INPUT' && $_el.tagName !== 'SELECT' && $_el.tagName !== 'BUTTON' && $_el.tagName !== 'IFRAME' && $_el.tagName !== 'DIV' && $_el.tagName !== 'P' && $_el.tagName !== 'TEXTAREA'){
					event.preventDefault();
					if (this.cancel != null) {
						window.cancelAnimationFrame(this.cancel)
					}
					this.cancel = window.requestAnimationFrame(setTabIndexInNextFrame.bind(null, tabHandler))
				}
				return false
			}
		}	
		
		var tabHandler = new TabIndexHandler();
		document.body.addEventListener('keydown', tabHandler, false);

		// Remove WP's native hover event
		$('#wp-admin-bar-jetty-settings').unbind('mouseenter mouseleave');

		// Use masonry to cleanup settings dropdown layout

		var bd = document.createElement('div');
		bd.className = 'admin-bar-backdrop';
		var d = document.querySelector('.ab-sub-wrapper');
		var swide = $(window).width();
		

		function flyOutComplete(){
			var parent_node = $('#wp-admin-bar-jetty-settings-secondary-default').parent('.ab-sub-wrapper');
			var secondary_li = $('ul#wp-admin-bar-jetty-settings-secondary-default li[id*="wp-admin-bar-jetty-settings-secondary_"]');
			var secondary_li_offscreen = secondary_li.is(':offscreen');
			var width_parent = $('html #wpadminbar #wp-admin-bar-jetty-settings>.ab-sub-wrapper>.ab-submenu #wp-admin-bar-jetty-settings-secondary').css('width');

			if(true === secondary_li_offscreen){
				if(width_parent === '619px'){
					$(parent_node).css({
			  			'max-height': '250px',
			  			'overflow': 'hidden',
			  			'overflow-y': 'scroll'
			  		});
				} else {
					$(parent_node).css({
			  			'max-height': '300px',
			  			'overflow': 'hidden',
			  			'overflow-y': 'scroll'
			  		});
				}
	      	} else {
	      		$(parent_node).css({
	      			'max-height': 'none',
	      			'overflow': 'hidden',
	      			'overflow-y' : 'hidden'
	      		});
	      	}

		}

		$(window).on('resize', function(){
		      var win = $(this);
		      if (win.width() > 993) {
		      	$('html #wpadminbar #wp-admin-bar-jetty-settings>.ab-sub-wrapper>.ab-submenu #wp-admin-bar-jetty-settings-secondary').css('width', '619px');
		      	flyOutComplete();
		      } else {
		      	$('html #wpadminbar #wp-admin-bar-jetty-settings>.ab-sub-wrapper>.ab-submenu #wp-admin-bar-jetty-settings-secondary').css('width', 'auto');
		      	flyOutComplete();
		      }
		});

		$('#wp-admin-bar-jetty-settings > .ab-item').toggle(function() {
			$('#wp-admin-bar-jetty-settings').addClass('hover');
		
			if (swide > 993) {
				var $grid = $('#wp-admin-bar-jetty-settings-secondary-default').masonry({
				  itemSelector: '.menupop',
				  columnWidth: 157
				});
				$('html #wpadminbar #wp-admin-bar-jetty-settings>.ab-sub-wrapper>.ab-submenu #wp-admin-bar-jetty-settings-secondary').css('width', '619px');
				flyOutComplete();
			} else {
				var $grid = $('#wp-admin-bar-jetty-settings-secondary-default').masonry({
				  itemSelector: '.menupop',
				  columnWidth: 150
				});
				$('html #wpadminbar #wp-admin-bar-jetty-settings>.ab-sub-wrapper>.ab-submenu #wp-admin-bar-jetty-settings-secondary').css('width', 'auto');
				flyOutComplete();
			}			
			d.parentNode.appendChild(bd);

		}, function() {
			$('#wp-admin-bar-jetty-settings').removeClass('hover');
			$('#wp-admin-bar-jetty-settings-secondary-default').masonry( 'destroy' );
			d.parentNode.removeChild(bd);
		});

		$('#wp-admin-bar-jetty-settings-default').click(function(event){
		    event.stopPropagation();
		});

		$('#wpadminbar').on('click touchstart', '.admin-bar-backdrop', function() {
			$( "#wp-admin-bar-jetty-settings > .ab-item" ).trigger( "click" );
		});			

	});

}(jQuery));
