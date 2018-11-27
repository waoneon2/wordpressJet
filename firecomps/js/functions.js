/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */
	/*$( function() {
		if ( body.is( '.sidebar' ) ) {
			var sidebar   = $( '#secondary .widget-area' ),
			    secondary = ( 0 == sidebar.length ) ? -40 : sidebar.height(),
			    margin    = $( '#tertiary .widget-area' ).height() - $( '#content' ).height() - secondary;

			if ( margin > 0 && _window.innerWidth() > 999 )
				$( '#colophon' ).css( 'margin-top', margin + 'px' );
		}
	} );*/

	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.twentythirteen', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.twentythirteen', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets vertically.
	 */
	if ( $.isFunction( $.fn.masonry ) ) {
		var columnWidth = body.is( '.sidebar' ) ? 228 : 245;

		$( '#secondary .widget-area' ).masonry( {
			itemSelector: '.widget',
			columnWidth: columnWidth,
			gutterWidth: 20,
			isRTL: body.is( '.rtl' )
		} );
	}
	
	/**
	 * Selector
	 */
	$('.selector .selected').click(function() {
		if ($(this).parent().find('ul:first').css('display') == 'block') {
			$(this).parent().find('ul:first').stop().slideUp('fast');
		} else {
			$(this).parent().find('ul:first').stop().slideDown('fast');
		}
	});
	$('.selector li').live('click', function() {
		var text = $(this).html();
		var parent = $(this).parents('.selector:first');
		parent.find('.selected').html(text);
		parent.find('ul:first').stop().slideUp('fast');
		$(this).parents('form:first').find('input[name=y]').val(text);
	});
	$('#page').bind('click', function(e) {
		if ($(e.target).parents('.selector').size() == 0) {
			$('.selector ul:first').stop().slideUp('fast');
		}
	});
	
	/**
	 * Load States
	 */
	if ($('.selector').size() > 0) {
		$.get('/?page_id=40183', {
			'_do': 'ajax',
			'_action': 'get_states',
		}, function(data) {
			$('.selector').each(function() {
				$(this).find('ul').empty();
				for (var i in data) $('<li></li>').html(data[i]).appendTo($(this).find('ul:first'));
			});
		}, 'JSON');
	}
	
	/**
	 * Load Maps
	 */
	if ($('#maps-for-finding-your-school').size() > 0) {
		var renderMaps = function(container, states) {
			var opts = {'showLabels': false};
			if (container.hasClass('dark')) {
				opts.stateStyles = {
					'fill': '#f6bc63',
					'stroke': '#000'
				};
				opts.stateHoverStyles = {'fill': '#f6bc63'};
				opts.stateSpecificHoverStyles = {};
				for (var i in states) opts.stateSpecificHoverStyles[states[i]] = {'fill': '#e58505'};
			} else {
				opts.stateStyles = {
					'fill': '#4096ca',
					'stroke': '#fff'
				};
				opts.stateHoverStyles = {'fill': '#4096ca'};
				opts.stateSpecificHoverStyles = {};
				for (var i in states) opts.stateSpecificHoverStyles[states[i]] = {'fill': '#c7c8ca'};
				opts.mouseover = function(e, data) {
					var supported = false;
					for (var i in states) if (states[i] == data.name) { supported = true; break; }
					if (supported) {
						var label = $('<span></span>').addClass('label').html(data.name);
						label.appendTo(container).show();
					}
				};
				opts.mouseout = function(event, data) {
					container.find('.label').remove();
				};
			}
			opts.click = function(e, data) {
				var supported = false;
				for (var i in states) if (states[i] == data.name) { supported = true; break; }
				if (supported) {
					if ($('#form-find-your-school').size() == 0) return;
					var url = $('#form-find-your-school').attr('action') + '?y=' + escape(data.name);
					window.location.href = url;
				}
			};
			container.usmap(opts);
		};
		$.get('/?page_id=40183', {
			'_do': 'ajax',
			'_action': 'get_states_short',
		}, function(data) {
			if (data.length == 0) return;
			var supported_states = [];
			for (var i in data) supported_states.push(data[i]);
			var container = $('#maps-for-finding-your-school');
			render_maps = renderMaps(container, supported_states);
			container.mousemove(function(e) {
				if (container.find('.label').size() == 0) return;
				var x = e.pageX - container.offset().left - 18;
				var y = e.originalEvent.pageY - container.offset().top - 60;
				container.find('.label:first').css({'left': x, 'top': y});
			});
		}, 'JSON');
	}
	
	if ($('#s').val() == '') $('#s').val('Search this site by entering a keyword');
	$('input[type=text]').each(function(i) {
		$(this).placeholder($);
	});
} )( jQuery );