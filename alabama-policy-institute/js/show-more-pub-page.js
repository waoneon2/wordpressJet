(function ($, settings) {
	'use strict';

  function getDisplayedItems(wrapper) {
    var items = wrapper.querySelectorAll('.content__box');
    return items.length;
  }

  function findParent(node, cls) {
    var curr
    while (curr = node.parentNode) {
      if (curr.classList.contains(cls)) {
        return curr
      }
    }
  }

  function sendAjaxReadmore(wrapper, page, cb) {
    var items = getDisplayedItems(wrapper),
       offset = items / 10;
    if (wrapper.classList.contains('content__wrapper')) {
      items += 1;
    }
    $.ajax({
      url: settings.ajax_url + '?action=alabama_policy_institute_readmore_ajax',
      data: {
        offset: items,
        per_page: 10,
        settings: settings,
        page: page,
      },
      success: function (res) {
        if (res.success) {
          return cb(null, res.data);
        }
        var msg = res.data && res.data.error ? res.data.error : 'Server error'
        cb(new Error(msg))
      },
      error: function (_, status) {
        cb(new Error(status))
      }
    })
  }

  function handleReadMoreEvent (e) {
    e.preventDefault()
    e.stopPropagation();

    var wrapper = findParent(e.currentTarget, 'content__wrapper'),
        ref       = e.currentTarget,
        clicked   = e.currentTarget.dataset.page;

    sendAjaxReadmore(wrapper, clicked, function (err, data) {

      if (!err) {
        var div = document.createElement('div');
        div.innerHTML = data.html;
        var elements = div.childNodes;

        Array.prototype.forEach.call(elements, function (item) {

          if (item.nodeType === 1) {
            wrapper.insertBefore(item, ref)
          }
        })

        // change text show more if no more data
        if (data.next_available == false) {
            ref.classList.add('btn--show-more-end')
        }
      } else {
        // console.log('error')
      }
    })
  }

  function main() {
    var button = document.querySelectorAll('.content__wrapper .btn--show-more2')
    Array.prototype.forEach.call(button, function (item) {
      item.addEventListener('click', handleReadMoreEvent)
    })
  }
  requestAnimationFrame(main)
})(jQuery, api_fp_readmore2)