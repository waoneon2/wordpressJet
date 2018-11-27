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
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.head-title h2, .navbar-title a' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description, .head-title h2, .navbar-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description, .head-title h2, .navbar-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description, .head-title h2, .navbar-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Background Color.
	wp.customize( 'background_color', function(value) {
		value.bind(function(to){
			if('blank' === to) {
				$('#content').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				})
			} else {
				$('#content').css({
					'clip': 'auto',
					'position': 'relative'
				});
				$('#content').css({
					'background-color': to
				});
			}
		});
	});
} )( jQuery );