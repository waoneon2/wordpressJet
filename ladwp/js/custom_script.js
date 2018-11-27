
( function( $ ) {
	$( document ).ready(function() {
		if($('.activate-carousel-default').length) {
		  	$('.activate-carousel-default').bxSlider({
			  	auto: true,
				pause: 8000,
		  		adaptiveHeight: false,
			  	slideWidth: 1200,
				preloadImages: 'visible',
				minSlides: 1,
				maxSlides: 1,
			});
		 }
	});

} )( jQuery );