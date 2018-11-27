( function( $ ) {

	$( document ).ready(function() {
		if($('.box-content').length !== 0){
			$('.box').matchHeight({
		    	byRow: false,
	    		property: 'height',
			});
		}
	});
} )( jQuery );