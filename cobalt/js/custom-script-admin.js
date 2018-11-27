(function ($) {
	'use strict';

  function supports_video() {
    return !!document.createElement('video').canPlayType;
  }
})(jQuery);