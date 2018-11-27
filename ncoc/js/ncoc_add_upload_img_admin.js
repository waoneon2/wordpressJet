jQuery(function($) {
	'use strict';

  var image_rotator_frame;
  var $image_gallery_ids = $( '#image_rotator' );
  var find_this = $('#image_rotator_container').length;
  if(find_this !== 0){
  var $image_rot = $( '#image_rotator_container' ).find( 'ul.product_images' );

  $('.add_product_images').on('click', 'a', function(event) {
    var $el = $( this );

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( image_rotator_frame ) {
      image_rotator_frame.open();
      return;
    }

    // Create the media frame.
    image_rotator_frame = wp.media.frames.product_gallery = wp.media({
      // Set the title of the modal.
      title: $el.data( 'choose' ),
      button: {
        text: $el.data( 'update' )
      },
      states: [
        new wp.media.controller.Library({
          title: $el.data( 'choose' ),
          filterable: 'all',
          multiple: true
        })
      ]
    });

    // When an image is selected, run a callback.
    image_rotator_frame.on( 'select', function() {
      var selection = image_rotator_frame.state().get( 'selection' );
      var attachment_ids = $image_gallery_ids.val();
      var file_path = '';
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
        if(attachment.type != 'image'){
          alert(" Please upload or select image file only!");
        } else {
          if ( attachment.id ) {
            attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
            var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

            $image_rot.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
          }
        }
      });

      $image_gallery_ids.val( attachment_ids );
    });

    // Finally, open the modal.
    image_rotator_frame.open();
  });

  // Image ordering
  $image_rot.sortable({
    items: 'li.image',
    cursor: 'move',
    scrollSensitivity: 40,
    forcePlaceholderSize: true,
    forceHelperSize: false,
    helper: 'clone',
    opacity: 0.65,
    placeholder: 'woodstone-metabox-sortable-placeholder',
    start: function( event, ui ) {
      ui.item.css( 'background-color', '#f6f6f6' );
    },
    stop: function( event, ui ) {
      ui.item.removeAttr( 'style' );
    },
    update: function() {
      var attachment_ids = '';

      $( '#image_rotator_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
        var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
        attachment_ids = attachment_ids + attachment_id + ',';
      });

      $image_gallery_ids.val( attachment_ids );
    }
  });

  // Remove images
  $( '#image_rotator_container' ).on( 'click', 'a.delete', function() {
    $( this ).closest( 'li.image' ).remove();

    var attachment_ids = '';

    $( '#image_rotator_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
      var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
      attachment_ids = attachment_ids + attachment_id + ',';
    });

    $image_gallery_ids.val( attachment_ids );

    // remove any lingering tooltips
    $( '#tiptip_holder' ).removeAttr( 'style' );
    $( '#tiptip_arrow' ).removeAttr( 'style' );

    return false;
  });
  } 
});
