(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index
  console.log('Vertical Limits');
  function findAncestor(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

  function createTabItem(wid, index) {
    var tabItem  = doc.createElement('div'),
        chooser    = doc.createElement('div'),

        sbutton    = doc.createElement('a'),
        button     = doc.createElement('a'),

        attachment = doc.createElement('input'),

        labelTitle    = doc.createElement('label'),
        inputTitle    = doc.createElement('input'),
        labelContent = doc.createElement('label'),
        inputContent = doc.createElement('textarea'),
        labelTextURL = doc.createElement('label'),
        inputTextURL = doc.createElement('input'),
        labelURL = doc.createElement('label'),
        inputURL = doc.createElement('input')

    tabItem.className = 'media-item media-item-' + index
    tabItem.dataset.index = index

    chooser.className = 'jetty-image-choose-action'

    sbutton.href = '#'
    sbutton.className = 'jetty-remove-image button button-secondary'
    sbutton.appendChild(doc.createTextNode(i18n.remove_text))

    button.href = '#'
    button.className = 'jiw_upload_file_button button button-primary'
    button.appendChild(doc.createTextNode(i18n.btn_text))

    chooser.appendChild(button)
    chooser.appendChild(sbutton)

    attachment.type = 'hidden'
    attachment.name = 'widget-jetty_widget_vertical_tab[' + wid + '][tabs][' + index + '][image]'
    attachment.className = 'jiw_repeatable_attachment_id_field'
    attachment.value = -1

    labelTitle.for = 'tab_title_' + index
    labelTitle.appendChild(doc.createTextNode(i18n.label_tab_title))
    inputTitle.type = 'text'
    inputTitle.id   = 'tab_title_' + index
    inputTitle.name = 'widget-jetty_widget_vertical_tab[' + wid + '][tabs][' + index + '][tab_title]'
    inputTitle.value = ''

    labelContent.for = 'content_' + index
    labelContent.appendChild(doc.createTextNode(i18n.label_content))
    inputContent.id   = 'content_' + index
    inputContent.name = 'widget-jetty_widget_vertical_tab[' + wid + '][tabs][' + index + '][content]'
    inputContent.rows = 5

    labelTextURL.for = 'text_url_' + index
    labelTextURL.appendChild(doc.createTextNode(i18n.label_url_text))
    inputTextURL.type = 'text'
    inputTextURL.id   = 'text_url_' + index
    inputTextURL.name = 'widget-jetty_widget_vertical_tab[' + wid + '][tabs][' + index + '][text_url]'
    inputTextURL.value = ''

    labelURL.for = 'url_' + index
    labelURL.appendChild(doc.createTextNode(i18n.label_url))
    inputURL.type = 'url'
    inputURL.id   = 'url_' + index
    inputURL.name = 'widget-jetty_widget_vertical_tab[' + wid + '][tabs][' + index + '][url]'
    inputURL.value = ''

    //tabItem.appendChild(attachment)
    tabItem.appendChild(chooser)
    //tabItem.appendChild(figure)
    tabItem.appendChild(labelTitle)
    tabItem.appendChild(inputTitle)

    tabItem.appendChild(labelContent)
    tabItem.appendChild(inputContent)

    tabItem.appendChild(labelTextURL)
    tabItem.appendChild(inputTextURL)

    tabItem.appendChild(labelURL)
    tabItem.appendChild(inputURL)

    return tabItem
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

    var container   = findAncestor(e.currentTarget, 'jetty-widget-vertical-tab-form'),
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
        container  = findAncestor(e.currentTarget, 'jetty-widget-vertical-tab-form')

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
      .on('click', '.jetty-widget-vertical-tab-form .jiw_upload_file_button', fileUploadHandler)
      .on('click', '.jetty-widget-vertical-tab-form .jiw-add-more', addMoreHandler)
      .on('click', '.jetty-widget-vertical-tab-form .jetty-remove-image', removeImageHandler)
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, jw_admin_vertical_tab)
