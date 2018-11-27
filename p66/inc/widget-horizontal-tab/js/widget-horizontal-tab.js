(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index, widthTotal

  function findAncestor(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

  function createTabItem(wid, index) {
    var tabItem  = doc.createElement('div'),
        chooser    = doc.createElement('div'),
        sbutton    = doc.createElement('a'),

        labelTitle    = doc.createElement('label'),
        inputTitle    = doc.createElement('input'),
        labelContent1 = doc.createElement('label'),
        inputContent1 = doc.createElement('textarea'),
        labelContent2 = doc.createElement('label'),
        inputContent2 = doc.createElement('textarea')

    tabItem.className = 'media-item media-item-' + index
    tabItem.dataset.index = index

    chooser.className = 'jetty-image-choose-action'

    sbutton.href = '#'
    sbutton.className = 'jetty-remove-image button button-secondary'
    sbutton.appendChild(doc.createTextNode(i18n.remove_text))

    chooser.appendChild(sbutton)

    labelTitle.for = 'tab_title_' + index
    labelTitle.appendChild(doc.createTextNode(i18n.label_tab_title))
    inputTitle.type = 'text'
    inputTitle.id   = 'tab_title_' + index
    inputTitle.name = 'widget-jetty_widget_horizontal_tab[' + wid + '][tabs][' + index + '][tab_title]'
    inputTitle.value = ''

    labelContent1.for = 'content1_' + index
    labelContent1.appendChild(doc.createTextNode(i18n.label_content1))
    /*inputContent1.type = 'text'*/
    inputContent1.id   = 'content1_' + index
    inputContent1.name = 'widget-jetty_widget_horizontal_tab[' + wid + '][tabs][' + index + '][content1]'
    inputContent1.rows = 5

    labelContent2.for = 'content2_' + index
    labelContent2.appendChild(doc.createTextNode(i18n.label_content2))
    /*inputContent2.type = 'text'*/
    inputContent2.id   = 'content2_' + index
    inputContent2.name = 'widget-jetty_widget_horizontal_tab[' + wid + '][tabs][' + index + '][content2]'
    inputContent2.rows = 5

    //tabItem.appendChild(attachment)
    tabItem.appendChild(chooser)
    //tabItem.appendChild(figure)
    tabItem.appendChild(labelTitle)
    tabItem.appendChild(inputTitle)

    tabItem.appendChild(labelContent1)
    tabItem.appendChild(inputContent1)

    tabItem.appendChild(labelContent2)
    tabItem.appendChild(inputContent2)

    return tabItem
  }

  function addMoreHandler(e) {

    e.preventDefault()

    var container   = findAncestor(e.currentTarget, 'jetty-widget-horizontal-tab-form'),
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
        container  = findAncestor(e.currentTarget, 'jetty-widget-horizontal-tab-form')

    container.removeChild(box);
    var items = container.querySelectorAll('.media-item')
    if (items.length < 8) {
      var button = container.querySelector('.jiw-add-more')
      button.classList.remove('hidden')
    }
  }

  function main() {
    $(doc.body)
      .on('click', '.jetty-widget-horizontal-tab-form .jiw-add-more', addMoreHandler)
      .on('click', '.jetty-widget-horizontal-tab-form .jetty-remove-image', removeImageHandler)
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, jw_admin_horizontal_tab)
