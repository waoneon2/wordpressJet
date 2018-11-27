(function ($) {
  'use strict';

  $(function() {
    var $checkbox = $( '#is_enabled', '#tab_gfiframe' )
    var $settingsRows = $checkbox.closest('tbody').find('tr[id^="gaddon"]').not($checkbox.closest( 'tr' )).find('th, td')

    $settingsRows.toggle($checkbox.is(':checked'));

    $checkbox.on('click', function() {
      if ( $checkbox.is(':checked' )) {
        $settingsRows.slideDown('fast');
      } else {
        $settingsRows.slideUp('fast');
      }
    })
  })
})(jQuery)