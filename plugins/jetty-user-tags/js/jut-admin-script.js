(function ($) {
  'use strict'
  $(document).ready(function( $ ){
  	if($('#bulk-action-selector-top').length !== 0){
  		var om = $('#bulk-action-selector-top option[value=-1]');
  		om.last().css({
  			"color":"#000",
  			"font-size":"15px",
  			"font-weight": "bold"
  		}).attr('disabled', true);
  	}
  });
})(jQuery)