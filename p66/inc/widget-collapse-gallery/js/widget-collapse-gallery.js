(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index

  function findAncestor(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

  function fileUploadHandler(e) {
    e.preventDefault()
    var target     = $(e.currentTarget),
        box        = target.closest('div.media-item')

    index          = target.closest('div.media-item').data('index')
    imageinput     = target.closest('div.media-item').find('.jiw_repeatable_attachment_id_field'),
    thumbnail      = target.closest('div.media-item').find('figure')

    if (typeof frame !== 'undefined') {
      frame.open()
      return
    }
    frame = wp.media.frames.file_frame = wp.media({
      title: i18n.title,
      button: {
        text: i18n.text
      },
      multiple: false
    })
    frame.on('select', function() {
      var attachment = frame.state().get('selection').first().toJSON()
      // don't accept an image
      if (attachment.type !== 'image') {
        return;
      }
      // we have an image selected
      imageinput.val(attachment.id)
      if (thumbnail) {
        var image = doc.createElement('img'),
            btn  = thumbnail.find('.jetty-remove-image')
        image.className = 'preview-image-item preview-image-item-' + index
        image.src = attachment.url
        thumbnail.html(image)
      }
    })
    frame.open()
  }


  function main() {
    console.log('promo')
    $(doc.body)
      .on('click', '.jetty-widget-promo-form .jiw_upload_file_button', fileUploadHandler)
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, jw_admin_promo)
