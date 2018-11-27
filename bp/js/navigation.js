/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

(function ($) {
	var menu = $('nav.main-navigation');
	var dropdownMobile = function (container) {
		var expand = '<span class="screen-reader-text">expand child menu</span>';
		var collapse = '<span class="screen-reader-text">collapse child menu</span>';

		container.find( '.menu-item-has-children > a' )
			.after( '<button class="dropdown-toggle" aria-expanded="false">' + expand + '</button>' );
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggle-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );
		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this );
			e.preventDefault();
			if (!e) {
			  e = window.event;
			}
			e.cancelBubble = true;
			if (e.stopPropagation) {
			  e.stopPropagation();
			}
			_this.toggleClass( 'toggle-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === expand ? collapse : expand );
		} );
		container.find('.menu-item-has-children').click(parentClicked);
		container.find('.menu-item-has-children ul.sub-menu li').click(function (e) {
			if (!e) {
			  e = window.event;
			}
			e.cancelBubble = true;
			if (e.stopPropagation) {
			  e.stopPropagation();
			}
		});
		function parentClicked(e) {
			e.preventDefault();
			var _self = $(this);
			_self.find('.dropdown-toggle').click();
		}
	};
	var initialize = false;
	function initializeButton() {
		var matches = window.matchMedia('(max-width: 40em)');
		if (matches.matches && !initialize) {
			dropdownMobile(menu);
			initialize = true;
		}
	}

	$(document).ready(initializeButton);
	$(window).on("resize", initializeButton);
})(jQuery)
