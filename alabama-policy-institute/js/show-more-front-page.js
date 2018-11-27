(function ($, settings) {
	'use strict';

  function sendAjaxReadmore(wrapper, page, cb) {

    $.ajax({
      url: settings.ajax_url + '?action=alabama_policy_institute_readmore_ajax',
      data: {
        offset: items,
        per_page: 3,
        settings: settings,
        page: page,
      },
      success: function (res) {
        if (res.success) {
          return  res.data;
        }
      }
    })
  }

})(jQuery, api_fp_readmore)