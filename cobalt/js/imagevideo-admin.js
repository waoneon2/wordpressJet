(function ($) {
	'use strict';

  var publication_file_frame;
  var file_path_field;

  $(document).on( 'click', '#cobalt_image_video_file', function( event ) {
    var $el = $( this );

    file_path_field = $( '._cobalt_image_video_file' );

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( publication_file_frame ) {
      publication_file_frame.open();
      return;
    }

    var publication_file_states = [
      // Main states.
      new wp.media.controller.Library({
        library:   wp.media.query(),
        multiple:  true,
        title:     'Choose Image/Video',
        priority:  20,
        filterable: 'uploaded'
      })
    ];

    // Create the media frame.
    publication_file_frame = wp.media.frames.downloadable_file = wp.media({
      // Set the title of the modal.
      title: 'CChoose Image/Video',
      library: {
        type: ''
      },
      button: {
        text: 'choose'
      },
      multiple: true,
      states: publication_file_states
    });

    // When an image is selected, run a callback.
    publication_file_frame.on( 'select', function() {
      var file_path = '';
      var selection = publication_file_frame.state().get( 'selection' );
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if ( attachment.url ) {
          file_path = attachment.url;
        }
      });
      console.log(file_path);
      file_path_field.val( file_path );
    });

    // Set post to 0 and set our custom type
    publication_file_frame.on( 'ready', function() {
      publication_file_frame.uploader.options.uploader.params = {
        type: 'downloadable_product'
      };
    });

    // Finally, open the modal.
    publication_file_frame.open();
  });
})(jQuery);