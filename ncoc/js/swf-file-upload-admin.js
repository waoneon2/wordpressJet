(function ($) {
	'use strict';

  var swf_file_frame;
  var file_path_field;
  var clone;
  var file_path_field_;

  $(document).on( 'click', '#ncoc_swf_file', function( event ) {
    var $el = $( this );

    file_path_field = $( '._ncoc_swf_file' );
    file_path_field_ = document.getElementById('_ncoc_swf_file');

    event.preventDefault();

    if ( swf_file_frame ) {
      swf_file_frame.open();
      return;
    }

    swf_file_frame = wp.media.frames.downloadable_file = wp.media({

      title: 'Choose swf',
      library: {
        type: 'application',
      },
      button: {
        text: 'Choose swf'
      },
      multiple: false,
    });

    swf_file_frame.on( 'select', function() {
      var file_path = '';
      var selection = swf_file_frame.state().get( 'selection' );
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if(attachment.mime !== "application/x-shockwave-flash"){
          alert("Please select swf file");
        } else {
          if ( attachment.url ) {
            file_path = attachment.url;
          }
        }
      });

      if(file_path !== ''){
        clone = file_path_field_.cloneNode(true);
        clone.setAttribute('src',file_path);
        file_path_field_.parentNode.replaceChild(clone, file_path_field_);
        file_path_field.val( file_path );
        $('#ncoc_swf_file').hide();
        $('#remove_ncoc_swf_file').show();
        $('#_ncoc_swf_file').css({'position':'relative','width':'100%','height':'100%'});
        $('#label_if_not_set').hide();
        setTimeout(function(){
          $('#_ncoc_swf_file').show();
        },1000);
      }
    });


    swf_file_frame.on( 'ready', function() {
      swf_file_frame.uploader.options.uploader.params = {
        type: 'downloadable_product'
      };
    });


    swf_file_frame.open();
  });

  $(document).on( 'click', '#remove_ncoc_swf_file', function( event ) {
      file_path_field = $( '._ncoc_swf_file' );
      file_path_field_ = document.getElementById('_ncoc_swf_file');

      clone = file_path_field_.cloneNode(true);
      clone.setAttribute('src','');
      file_path_field_.parentNode.replaceChild(clone, file_path_field_);
      file_path_field.val('');
      $('#_ncoc_swf_file').hide();
      $('#ncoc_swf_file').show();
      $('#label_if_not_set').show();
      $('#remove_ncoc_swf_file').hide();
  });
})(jQuery);