(function ($) {
	'use strict';

  var news_file_frame;
  var file_path_field;

  $(document).on( 'click', '#ncoc_news_file', function( event ) {
    var $el = $( this );

    file_path_field = $( '._ncoc_news_file' );

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( news_file_frame ) {
      news_file_frame.open();
      return;
    }

    var news_file_states = [
      // Main states.
      new wp.media.controller.Library({
        library:   wp.media.query(),
        multiple:  true,
        title:     'Choose news events file',
        priority:  20,
        filterable: 'uploaded'
      })
    ];

    // Create the media frame.
    news_file_frame = wp.media.frames.downloadable_file = wp.media({
      // Set the title of the modal.
      title: 'Choose news',
      library: {
        type: ''
      },
      button: {
        text: 'choose'
      },
      multiple: true,
      states: news_file_states
    });

    // When an image is selected, run a callback.
    news_file_frame.on( 'select', function() {
      var file_path = '';
      var selection = news_file_frame.state().get( 'selection' );
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if ( attachment.url ) {
          file_path = attachment.url;
        }
      });
      file_path_field.val( file_path );
    });

    // Set post to 0 and set our custom type
    news_file_frame.on( 'ready', function() {
      news_file_frame.uploader.options.uploader.params = {
        type: 'downloadable_product'
      };
    });

    // Finally, open the modal.
    news_file_frame.open();
  });
})(jQuery);