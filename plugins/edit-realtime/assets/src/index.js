const EditorClient = require('./client')
const Tinymce = require('./editor/tinymce')
const DomInput = require('./editor/dom-input')
const AjaxAdapter = require('./server/ajax-adapter')
$ = jQuery


function askContentToServer() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: ajaxurl,
      method: 'GET',
      success: (res) => resolve(res),
      error: (_, e) => reject(e),
      data: {
        post_id: document.getElementById('post_ID').value,
        action: 'jte_ajax_ask_current_post_info'
      }
    })
  })
}

function captureTinyMce(id) {
  return Promise.resolve(tinyMCE.get(id))
}

function main() {
  const postid = document.getElementById('post_ID').value
  const APP_KEY = 'a93b916c848e1743e492'
  const pusher = new Pusher(APP_KEY, {encrypted: true, authEndpoint: '/jte-pusher/v1/auth' })
  const channelName = 'jte-operation-post-editing-' + postid

  askContentToServer().then((doc) => {
    return captureTinyMce('content').then((editor) => Promise.resolve({doc, editor}))
  }).then((data) => {
    console.log(data)
    const editor = data.editor
    const doc = data.doc

    if (doc.title !== 'Auto Draft') {
      document.getElementById('title').value = doc.title
    }

    // tinymce
    const tinyeditor = new Tinymce(editor)
    editor.setContent(wp.editor.autop(doc.content), {format: "html"})
    tinyeditor._lastContent = tinyeditor.getContent()

    // document title
    const docTitle = new DomInput(document.getElementById('title'))
    docTitle._lastContent = docTitle.getContent()

    // ajax
    const transport = new AjaxAdapter(pusher, channelName, JTEC.current_uid, {
      url: ajaxurl,
      action: 'jte_ajax_receive_content_operation',
      delete_action: 'jte_ajax_delete_content_operation',
      channel: 'operation-content'
    })
    const client = new EditorClient(Number(doc.revision_content), postid, tinyeditor, transport)

    // title
    const transportTitle = new AjaxAdapter(pusher, channelName, JTEC.current_uid, {
      url: ajaxurl,
      action: 'jte_ajax_receive_title_operation',
      delete_action: 'jte_ajax_delete_title_operation',
      channel: 'operation-title'
    })
    const clientTitle = new EditorClient(Number(doc.revision_title), postid, docTitle, transportTitle)

    return Promise.resolve({client, clientTitle})
  })
}

requestAnimationFrame(main)