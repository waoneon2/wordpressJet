(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index, widthTotal
  function findAncestor(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

  function createTabItem(wid, index) {
    var tabItem     = doc.createElement('div'),
        chooser     = doc.createElement('div'),
        sbutton     = doc.createElement('a'),

        labelText   = doc.createElement('label'),
        inputText   = doc.createElement('input'),
        labelURL    = doc.createElement('label'),
        inputURL    = doc.createElement('input'),
        labelDesc   = doc.createElement('label'),
        inputDesc   = doc.createElement('textarea')

    tabItem.className = 'media-item media-item-' + index
    tabItem.dataset.index = index

    chooser.className = 'jetty-image-choose-action'

    sbutton.href = '#'
    sbutton.className = 'jetty-remove-image button button-secondary'
    sbutton.appendChild(doc.createTextNode(i18n.remove_text))

    chooser.appendChild(sbutton)

    labelText.for = 'widget-bcbst_widget_resources-'+ wid + '-text-' + index
    labelText.appendChild(doc.createTextNode(i18n.label_text))
    inputText.type = 'text'
    inputText.id   = 'widget-bcbst_widget_resources-'+ wid + '-text-' + index
    inputText.name = 'widget-bcbst_widget_resources[' + wid + '][items][' + index + '][text]'
    inputText.value = ''

    labelURL.for = 'widget-bcbst_widget_resources-'+ wid + '-url-' + index
    labelURL.appendChild(doc.createTextNode(i18n.label_url))
    inputURL.type = 'url'
    inputURL.id   = 'widget-bcbst_widget_resources-'+ wid + '-url-' + index
    inputURL.name = 'widget-bcbst_widget_resources[' + wid + '][items][' + index + '][url]'
    inputURL.value = ''

    labelDesc.for = 'widget-bcbst_widget_resources-'+ wid + '-desc-' + index
    labelDesc.appendChild(doc.createTextNode(i18n.label_desc))
    inputDesc.id   = 'widget-bcbst_widget_resources-'+ wid + '-desc-' + index
    inputDesc.name = 'widget-bcbst_widget_resources[' + wid + '][items][' + index + '][desc]'


    //tabItem.appendChild(attachment)
    tabItem.appendChild(chooser)
    //tabItem.appendChild(figure)
    tabItem.appendChild(labelText)
    tabItem.appendChild(inputText)
    tabItem.appendChild(labelURL)
    tabItem.appendChild(inputURL)
    tabItem.appendChild(labelDesc)
    tabItem.appendChild(inputDesc)


    return tabItem
  }

  function addMoreHandler(e) {

    e.preventDefault()

    var container   = findAncestor(e.currentTarget, 'bcbst_widget_resources_form'),
        items       = container.querySelectorAll('.media-item'),
        target      = e.currentTarget,
        wid         = target.dataset.widgetbase
         console.log(items.length);
    if (items.length < 15) {
      // find next id for index
      var nextid = 0;
      for (var i = 0, len = items.length; i < len; i++) {
        nextid = Math.max(items[i].dataset.index, nextid)
      }
      container.insertBefore(createTabItem(wid, nextid + 1), e.currentTarget)
      if (items.length === 14) {
        e.currentTarget.classList.add('hidden')
      }
    }
  }

  function removeImageHandler(e) {
    e.preventDefault()

    var box        = findAncestor(e.currentTarget, 'media-item'),
        container  = findAncestor(e.currentTarget, 'bcbst_widget_resources_form')

    container.removeChild(box);
    var items = container.querySelectorAll('.media-item')
    if (items.length < 15) {
      var button = container.querySelector('.jiw-add-more')
      button.classList.remove('hidden')
    }
  }

  function main() {
    $(doc.body)
      .on('click', '.bcbst_widget_resources_form .jiw-add-more', addMoreHandler)
      .on('click', '.bcbst_widget_resources_form .jetty-remove-image', removeImageHandler)
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, admin_resources)
