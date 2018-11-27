(function ($) {
	'use strict';

  function main() {
    $('.view-inquiry-detail-content').hide();
    $(document.body).on('click', '.print-report-link', function (e) {
      e.preventDefault();
      window.print();
    })
    $(document.body).on('click', '.view-inquiry-detail', function (e) {
      e.preventDefault();
      var ta = $(e.currentTarget).closest('div').find('.view-inquiry-detail-content');
      $(ta).toggle('slow', function(){
        var get_cls = $(ta).hasClass('open');
        if(get_cls === true){
          $(ta).removeClass('open');
        } else {
          $(ta).addClass('open');
        }
      });
    })
    var s = document.querySelector('#post-search-input');
    if (s) {
      s.setAttribute('maxlength', 100);
    }
  }
  $(document).ready(main)
})(jQuery)