/**
 * File script.js.
 *
 */

( function( $ ) {

	$( document ).ready(function(e) {

		// dropdown
		var hoverTimer;
		$( ".navbar-header li.menu-item-has-children" ).mouseenter(function() {
			var $this = $(this);
			hoverTimer = setTimeout(function() {
			   $this.find('.sub-menu').first().slideDown('fast');
			}, 500);
		}).mouseleave(function() {
			clearTimeout(hoverTimer);
			$( this ).find('.sub-menu').first().slideUp('fast');
		});
		// cater
		$('.dropdown-menu .menu-item-has-children > a').append('<span class="glyphicon glyphicon-menu-right"></span>');

		// close
		$(".bottom-strip .close").click(function() {
			$(this).closest('.dropdown-menu-large').slideUp('fast');
		});

		//  mobile nav
		$(document).on('click', '.dropdown-mobile .dropdown-toggle', function() {
			console.log('dropdown mobile');
			$(this).siblings().toggle();
			$(this).children('.burger-icon').toggleClass('glyphicon glyphicon-menu-hamburger dashicons dashicons-no-alt');
			$(this).children('.lop-icon').toggleClass('glyphicon glyphicon-search dashicons dashicons-no-alt');
		});
		// close mobile nav bottom-divider
		$(document).on('click', '.dropdown-mobile .bottom-divider', function() {
			console.log('close');
			$(this).parent().parent().toggle();
			$('.burger-icon').addClass('glyphicon glyphicon-menu-hamburger');
			$('.lop-icon').addClass('glyphicon glyphicon-search');

			$('.burger-icon').removeClass('dashicons dashicons-no-alt');
			$('.lop-icon').removeClass('dashicons dashicons-no-alt');
		});

		//offcanvas
		$(document).on('click', '.offcanvas.offcanvas-toggle', function(e) {
			e.stopPropagation()
			// console.log('offcanvas');
			$(this).find('.row-offcanvas.row-offcanvas-right').addClass('active').css('right','100%');
		});

		$(document).on('click', '.main-menu-link.offcanvas-toggle', function(e) {
			e.stopPropagation()
			// console.log('main offcanvas');
			$(this).closest('.row-offcanvas.row-offcanvas-right').removeClass('active').css('right','-15%');
		});

	});

} )( jQuery );
