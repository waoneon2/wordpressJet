(function ($) {
	"use strict";
	$(document).ready(function($) {
	    $('#jrlw-accordian').find('.accordion-toggle').click(function(){
	      //Expand or collapse this panel
	      $(this).next().slideToggle('fast');
	      //Hide the other panels
	      $(".accordion-content").not($(this).next()).slideUp('fast');
	    });
	  });
})(jQuery);