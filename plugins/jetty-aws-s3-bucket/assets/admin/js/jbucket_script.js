(function ( $ ) {
	$(document).ready(function(){

	$(function() {
   //      $("#jbucket_uploader").plupload({
   //      	runtimes : 'html5,flash,silverlight,html4',
   //      	url : jbucket_ajax_action.directly_url,
   //      	multipart: true,
   //      	chunk_size: '500kb',
   //  		max_retries: 3,
   //      	filters: {
			//   mime_types : "image/*,application/*,text/*,audio/*,video/*"
			// },
			// sortable: true,
			// dragdrop: true,
			// views: {
	  //           list: true,
	  //           thumbs: true, // Show thumbs
	  //           active: 'thumbs'
	  //       },
   //      	flash_swf_url : jbucket_ajax_action.jbucket_flash_url,
   //      	silverlight_xap_url : jbucket_ajax_action.jbucket_silverlight_url
   //      });

   $("#jbucket_uploader").plupload({
        	runtimes : 'html5,flash,silverlight',
        	url : jbucket_ajax_action.jbucket_aws_s3_url,
        	multipart: true,
        	multipart_params: {
				'key': jbucket_ajax_action.jbucket_current_folder_key+'/'+'${filename}',
				'Filename': '${filename}',
				'acl': jbucket_ajax_action.jbucket_x_acl,
				'Content-Type': '',
				'AWSAccessKeyId' : jbucket_ajax_action.jbucket_aws_access_key,
				'policy' : jbucket_ajax_action.jbucket_policy,
				'signature': jbucket_ajax_action.jbucket_x_signature
			},
    		max_retries: 5,
        	filters: {
			  mime_types : "image/*,application/*,text/*,audio/*,video/*"
			},
			sortable: true,
			dragdrop: true,
			views: {
	            list: true,
	            thumbs: true,
	            active: 'thumbs'
	        },
        	flash_swf_url : jbucket_ajax_action.jbucket_flash_url,
        	silverlight_xap_url : jbucket_ajax_action.jbucket_silverlight_url,
        	init : {
        		FileUploaded: function(up, file, info) {
	                // Called when file has finished uploading
	                var rFile = file;
	                var jFilename = rFile.name;
	                var jPrefix = jbucket_ajax_action.jbucket_current_folder_key;
	                var jType = rFile.type;

	                console.log('[FileUploaded]');
	                console.log(file);
	                console.log(info);
	                console.log(up);
	                console.log(rFile.name);
	                console.log('------------------');

	                $.ajax({
						type: 'POST',
						url: jbucket_ajax_action.ajax_url,
						data: {
							"action": "jbucket_handle_file_uploaded",
							"prefix" : jPrefix,
							"filename" : jFilename,
							"filetype" : jType
						},
						beforeSend : function(){
							
						},
						success: function(data){
							console.log(data);
						}
					});
	            },
  
	            ChunkUploaded: function(up, file, info) {
	                // Called when file chunk has finished uploading
	                console.log('[ChunkUploaded]');
	                console.log(file);
	                console.log(info);
	                console.log(up);
		        },
	        }
        });

    }); 



	});
	
}(jQuery));