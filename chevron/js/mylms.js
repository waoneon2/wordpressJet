jQuery(function($){
	$('#search_button_link').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'lmr',
			'query': mlp.posts,
			'page' : mlp.current_page
		};
 
		$.ajax({
			url : mlp.chevron_ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
					
					button.text( 'Show More' ).closest(".chevron_loadmore_container").prev().after(data);
					mlp.current_page++;
 
					if ( mlp.current_page == mlp.max_page ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
	});
});