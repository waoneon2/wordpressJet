(function ($) {
  'use strict';

  var sheet_file_frame;
  var file_path_field;

  $(document).on( 'click', '#plains_sheet_file', function( event ) {
    var $el = $( this );

    file_path_field = $( '._plains_sheet_file' );

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( sheet_file_frame ) {
      sheet_file_frame.open();
      return;
    }

    var sheet_file_states = [
      // Main states.
      new wp.media.controller.Library({
        library:   wp.media.query(),
        multiple:  true,
        title:     'Choose Sheet',
        priority:  20,
        filterable: 'uploaded'
      })
    ];

    // Create the media frame.
    sheet_file_frame = wp.media.frames.downloadable_file = wp.media({
      // Set the title of the modal.
      title: 'Choose Sheet',
      library: {
        type: ''
      },
      button: {
        text: 'choose'
      },
      multiple: true,
      states: sheet_file_states
    });

    // When an image is selected, run a callback.
    sheet_file_frame.on( 'select', function() {
      var file_path = '';
      var selection = sheet_file_frame.state().get( 'selection' );
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if ( attachment.url ) {
          file_path = attachment.url;
        }
      });
      // console.log(file_path);
      var ext = file_path.split('.').pop();
      if(ext!="pdf"){
          alert(" Please upload or select pdf file only!");
          sheet_file_frame.open();
        } else {
          file_path_field.val( file_path );
        }
      
    });

    // Set post to 0 and set our custom type
    sheet_file_frame.on( 'ready', function() {
      sheet_file_frame.uploader.options.uploader.params = {
        type: 'downloadable_product'
      };
    });

    // Finally, open the modal.
    sheet_file_frame.open();
  });
})(jQuery);