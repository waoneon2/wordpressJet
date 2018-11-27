(function ( $ ) {
	"use strict";

	$(function () {

	});

	$(document).ready(function( $ ){
		var insertHtml = '<span class="progress_overlay">Saving configurations <img class="progress_img_save_loading" src="'+imgurlLoading+'" /></span>';
		$("form#on_form_settings").on("submit", function(e){
			e.preventDefault();
			var contentForm 	= $(this).serialize();
			var buttonSubmit 	= $(this).find('input#save_jetty_smm_settings');

			console.log(contentForm);

			$.ajax({
				url : asss_ajax_action.ajax_url,
				type : 'post',
				data : {
					action : 'HandleSaveAjaxRequest',
					formData : contentForm
				},
				beforeSend : function(){
					 $('input#save_jetty_smm_settings').prop('disabled', true);
					 $(insertHtml).insertAfter(buttonSubmit);
					 

				},
				success : function( response ) {
					setTimeout(function(){
						$('.progress_overlay').html('Configuration has been saved').delay(800).fadeOut('slow');
						$('input#save_jetty_smm_settings').prop('disabled', false);
					}, 4000);
				}
			});
		});
	});

}(jQuery));