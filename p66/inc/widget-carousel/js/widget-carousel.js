(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index
  console.log('Carousel');
  function findAncestor(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

  function createTabItem(wid, index) {
    var caroItem    = doc.createElement('div'),
        chooser     = doc.createElement('div'),

        sbutton     = doc.createElement('a'),
        button      = doc.createElement('a'),

        attachment  = doc.createElement('input'),
        figure      = doc.createElement('figure'),

        labelDesc   = doc.createElement('label'),
        inputDesc   = doc.createElement('textarea'),
        labelType   = doc.createElement('label'),
        inputType   = doc.createElement('select'),

        opType1      = doc.createElement('option'),
        opType2      = doc.createElement('option'),
        opType3      = doc.createElement('option'),
        opType4      = doc.createElement('option')


    caroItem.className = 'media-item media-item-' + index
    caroItem.dataset.index = index

    chooser.className = 'jetty-image-choose-action'

    sbutton.href = '#'
    sbutton.className = 'jetty-remove-image button button-secondary'
    sbutton.appendChild(doc.createTextNode(i18n.remove_text))

    button.href = '#'
    button.className = 'jiw_upload_file_button button button-primary'
    button.appendChild(doc.createTextNode(i18n.btn_text))

    chooser.appendChild(button)
    chooser.appendChild(sbutton)

    figure.className = 'image-preview'

    attachment.type = 'hidden'
    attachment.name = 'widget-jetty_widget_carousel[' + wid + '][items][' + index + '][image]'
    attachment.className = 'jiw_repeatable_attachment_id_field'
    attachment.value = -1

    labelDesc.for = 'desc_' + index
    labelDesc.appendChild(doc.createTextNode(i18n.label_desc))
    inputDesc.id   = 'desc_' + index
    inputDesc.name = 'widget-jetty_widget_carousel[' + wid + '][items][' + index + '][desc]'
    inputDesc.row = 5

    labelType.for = 'type_' + index
    labelType.appendChild(doc.createTextNode(i18n.label_type))
    inputType.className = 'refinery-select-page'
    inputType.id   = 'type_' + index
    inputType.name = 'widget-jetty_widget_carousel[' + wid + '][items][' + index + '][type]'
    inputType.value = ''

    opType1.value = 'normal'
    opType1.text  = 'Normal'
    inputType.appendChild(opType1)

    opType2.value = 'fully-shaded-red'
    opType2.text  = 'Fully Shaded Red'
    inputType.appendChild(opType2)

    opType3.value = 'fully-shaded'
    opType3.text  = 'Fully Shaded'
    inputType.appendChild(opType3)

    opType4.value = 'fully-brightened'
    opType4.text  = 'Fully Brightened'
    inputType.appendChild(opType4)


    caroItem.appendChild(attachment)
    caroItem.appendChild(figure)

    caroItem.appendChild(chooser)

    caroItem.appendChild(labelDesc)
    caroItem.appendChild(inputDesc)

    caroItem.appendChild(labelType)
    caroItem.appendChild(inputType)

    return caroItem
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

  function addMoreHandler(e) {
    console.log('add')
    e.preventDefault()

    var container   = findAncestor(e.currentTarget, 'jetty-widget-carousel-form'),
        items       = container.querySelectorAll('.media-item'),
        target      = e.currentTarget,
        wid         = target.dataset.widgetbase
         console.log(items.length);
    if (items.length < 8) {
      // find next id for index
      var nextid = 0;
      for (var i = 0, len = items.length; i < len; i++) {
        nextid = Math.max(items[i].dataset.index, nextid)
      }
      container.insertBefore(createTabItem(wid, nextid + 1), e.currentTarget)
      if (items.length === 7) {
        e.currentTarget.classList.add('hidden')
      }
    }
  }

  function removeImageHandler(e) {
    e.preventDefault()

    var box        = findAncestor(e.currentTarget, 'media-item'),
        container  = findAncestor(e.currentTarget, 'jetty-widget-carousel-form')

    container.removeChild(box);
    var items = container.querySelectorAll('.media-item')
    if (items.length < 8) {
      var button = container.querySelector('.jiw-add-more')
      button.classList.remove('hidden')
    }
  }

  function main() {
    console.log('main')
    $(doc.body)
      .on('click', '.jetty-widget-carousel-form .jiw_upload_file_button', fileUploadHandler)
      .on('click', '.jetty-widget-carousel-form .jiw-add-more', addMoreHandler)
      .on('click', '.jetty-widget-carousel-form .jetty-remove-image', removeImageHandler)
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, jw_admin_carousel)
