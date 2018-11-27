(function ($) {
  'use strict';


  var research_file_frame;
  var file_path_field;

  $(document).on( 'click', '#alpi_research_file', function( event ) {
    var $el = $( this );

    file_path_field = $( '._alpi_research_file' );

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( research_file_frame ) {
      research_file_frame.open();
      return;
    }

    var research_file_states = [
      // Main states.
      new wp.media.controller.Library({
        library:   wp.media.query(),
        multiple:  true,
        title:     'Choose research',
        priority:  20,
        filterable: 'uploaded'
      })
    ];

    // Create the media frame.
    research_file_frame = wp.media.frames.downloadable_file = wp.media({
      // Set the title of the modal.
      title: 'Choose a file',
      library: {
        type: ''
      },
      button: {
        text: 'choose'
      },
      multiple: true,
      states: research_file_states
    });

    // When an image is selected, run a callback.
    research_file_frame.on( 'select', function() {
      var file_path = '';
      var selection = research_file_frame.state().get( 'selection' );
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if ( attachment.url ) {
          file_path = attachment.url;
        }
      });
      file_path_field.val( file_path );
    });

    // Set post to 0 and set our custom type
    research_file_frame.on( 'ready', function() {
      research_file_frame.uploader.options.uploader.params = {
        type: 'downloadable_product'
      };
    });

    // Finally, open the modal.
    research_file_frame.open();
  });
})(jQuery);