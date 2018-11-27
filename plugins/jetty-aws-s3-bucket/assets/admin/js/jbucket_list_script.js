(function ( $ ) {
	$(document).ready(function(){

	    jQuery('.jbucket_access').change(function(){
	    	var id 	= $(this).data('accessid');
	    	var jc 	= this;
	    	var val = this.value;
	    	var url_bucket 	= $(this).data('url-bucket');
	    	var url_post 	= $(this).data('url-post');
	    	var all_select 	= $('.jbucket_access');
	    	var getParent 	= $(jc).parent().parent();
			var findLink 	= $(getParent).find('a.link_jbucket');
			var up_load_img = $(getParent).find('span.prog_img_loading');
 
			jQuery.ajax({
				type: 'POST',
				url: jbucket_list_ajax_action.ajax_url,
				data: {
					"action": "jbucket_handle_select_bucket",
					"id": id,
					"val": val,
				},
				beforeSend : function(){
					jc.disabled = true;
					for (var i = 0; i < all_select.length; i++) {
						all_select[i].disabled = true;
					}
					$(up_load_img).html('<img class="jbucket_img_ajax_loading" src="'+jbucket_list_ajax_action.image_loading+'">');
				},
				success: function(data){
					var contentData = JSON.parse(data);

					// if(contentData.value === "private"){
					// 	$(findLink).attr('href', url_post);
					// } else {
					// 	$(findLink).attr('href', url_bucket);
					// }

					jc.disabled = false;
					
					for (var i = 0; i < all_select.length; i++) {
						all_select[i].disabled = false;
					}
					$(up_load_img).html('Saved!').delay(800).fadeOut('slow');
				}
			});
			return false;
	   	});

	});
	
}(jQuery));