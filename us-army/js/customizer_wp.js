/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .header-section-rt h1' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description, .navbar-title a, .header-section-rt h3' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description, .header-section-rt h1, .header-section-rt h3, .navbar-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description, .header-section-rt h1, .header-section-rt h3, .navbar-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description, .header-section-rt h1, .header-section-rt h3, .navbar-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Background color
	wp.customize('background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'div#page' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( 'div#page' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( 'div#page' ).css( {
					'background': to
				} );
			}
		} );
	} );
} )( jQuery );
