(function ($, Task, settings) {
  'use strict'
  function replaceInputWithSelect(option) {
    return new Task(function (reject, resolve) {
      var data = $('input#member_value')
      if (data.length) {
        var name = data.attr('name')
        var id = data.attr('id')
        data.replaceWith('<select id="'+ id + '" name="' + name + '"><option value="">Select an option</option>' + option + '</select>')
        resolve({})
      } else {
        reject({})
      }
    })
  }
  function buildSelectOptions(data) {
    return Object.keys(data).reduce(function (acc, current) {
      var sel = current === settings.previous_option ? 'selected' : ''
      return acc + '<option value="' + current + '"'+ sel +'>' + data[current] + '</option>'
    }, '')
  }
  var ajaxTask = new Task(function (reject, resolve) {
    var data = {
      url: ajaxurl,
      type: 'GET',
      async: true,
      data: {
        action : 'ocala_get_member_type'
      },
      success: function (response) {
        resolve(response)
      },
      error: function (xhr,textStatus,e) {
        reject(textStatus)
      }
    }
    $.ajax(data)
  })
  function noop() {}
  function compose(f, g) {
    return function (x) {
      return f(g(x))
    }
  }
  function main() {
    ajaxTask.map(compose(buildSelectOptions, JSON.parse)).chain(replaceInputWithSelect).fork(noop, noop)
  }
  // run on next request animation frame
  requestAnimationFrame(main)
})(jQuery, jonggrang.Task, partnership_settings)