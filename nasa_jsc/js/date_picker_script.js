( function( $ ) {
  $( document ).ready(function() {
  	console.log($('#nasa_jsc_status_setting').length);
  	$('.nasa_jsc_datepicker').datepicker({
  		beforeShow: function(input) {
	        $(input).css({
	            "position": "relative",
	            "z-index": 999999
	        });
    	},
    	changeMonth: true,
      changeYear: true,
      onSelect: function(a, b) { 
	        var date_format = a; 
	        $("input.nasa_jsc_datepicker").trigger("change");
	    }
  	});

  });
})( jQuery );