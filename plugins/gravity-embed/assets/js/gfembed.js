(function () {
  'use strict';

  var iframes = document.getElementsByTagName('iframe')

  function addListener(el, eventType, handler) {
    if (typeof el.addEventListener === 'function') {
      el.addEventListener(eventType, handler, false)
    } else {
      el.attachEvent( 'on' + eventType, handler )
    }
  }

  addListener(window, 'message', function (e) {
    var data, iframe, parts = e.data.split(':')
    if ( 'size' === parts[0] ) {
      data = parts[1].split( ',' )

      iframe = iframes[data[0]]
      if (typeof iframe !== 'undefined') {
        iframe.height = data[2]
        iframe.scrolling = 'no'
      }
    }
  })

  function initIframeWatch(i) {
    iframes[i].onload = iframes[i].onreadystatechange = function() {
      if (this.readyState && 'complete' !== this.readyState && 'loaded' !== this.readyState ) {
        return
      }
      setInterval(function() {
        // Send a message to the iframe to ask it to return its size.
        iframes[i].contentWindow.postMessage('size?' + i, '*')
      }, 500)
    }
  }

  if ( iframes.length ) {
    for ( var i = 0; i < iframes.length; i ++ ) {
      if ( -1 === iframes[ i ].className.indexOf( 'gfiframe' ) ) {
        continue
      }
      initIframeWatch(i)
    }
  }
})();