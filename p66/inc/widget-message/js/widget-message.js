(function (doc, $, i18n) {
  'use strict'
  var frame, imageinput, thumbnail, index

  function selectPage() {
    console.log('change')
  }

  function main() {
    console.log('message');
    $( "refinery-select-page" ).change(function() {
        console.log('ok');
    });
  }
  // load on first animation frame, effectively it wait documents body ready
  requestAnimationFrame(main)
})(document, jQuery, jw_admin_message)
