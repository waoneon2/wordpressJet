(function ( $ ) {
	$(document).ready(function(){

	$(function() {
        $("#jbucket_field_folder_network_bucket").change(function (e) {
        	var nnmae = this.options[e.target.selectedIndex].text;
        	var nval = $(this).val();
        	var thisDd = this;
	        $.ajax({
				type: 'POST',
				url: jbucket_select_network_ajax_action.ajax_url,
				data: {
					"action": "jbucket_handle_network_update_folder",
					"blogId" : nval,
					"blogName" : nnmae
				},
				beforeSend : function(){
					thisDd.disabled = true;
					document.getElementById('jbucket_field_network_name_bucket').disabled = true;
					$('input#jbucket_field_network_name_bucket').after('<span class="loading_img_folder_bucket"></span>');
					$('span.loading_img_folder_bucket').html('<img class="jbucket_img_ajax_loading" src="'+jbucket_select_network_ajax_action.image_loading+'"> Fetching the last folder in use.');
				},
				success: function(data){
					var jdata = JSON.parse(data);
					$('input#jbucket_field_network_name_bucket').val(jdata.folder_name);
					thisDd.disabled = false;
					document.getElementById('jbucket_field_network_name_bucket').disabled = false;
					$('span.loading_img_folder_bucket').remove();
				}
			});
			return false;
	    });
    }); 

	});
	
}(jQuery));