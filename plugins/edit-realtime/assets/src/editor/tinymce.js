const EventEmitter = require('eventemitter3')
const TextOperation = require('ot/lib/text-operation')

const {toWPFormat, operationPairFromText } = require('./../diff-text')
const {inherits} = require('./../utils')


function TinymceEditor(editor) {
  if (!this instanceof TinymceEditor) return new TinymceEditor(editor)
  EventEmitter.call(this)
  this._tinymce = editor
  this._ignoreNextChange = false
  this._onChanges = this.onChanges.bind(this)
  this._lastContent = this.getContent()
  editor.on('input keyup cut paste change', this._onChanges)
}

inherits(TinymceEditor, EventEmitter)

TinymceEditor.prototype.getContent = function () {
  const text = wp.editor.removep(this._tinymce.getContent({format:'html'}))
  return toWPFormat(text)
}

TinymceEditor.prototype.onChanges = function (e) {
  if (!this._ignoreNextChange) {
    const content = this.getContent()
    if (content !== this._lastContent) {
      const pair = operationPairFromText(this._lastContent, content)
      this.emit('change', pair[0], pair[1])
      this._lastContent = content
    }
  }
  this._ignoreNextChange = false
}

TinymceEditor.prototype.applyOperation = function (operation) {
  this._ignoreNextChange = true;
  var editor = this._tinymce,
    selection = editor.selection,
    content = this.getContent(),
    bookmark = selection.getBookmark(2, true),
    ops = operation.ops, index = 0

  for (var i = 0, l = ops.length; i < l; i++) {
    var op = ops[i];
    if (TextOperation.isRetain(op)) {
      index += op;
    } else if (TextOperation.isInsert(op)) {
      content = content.slice(0, index) + op + content.slice(index)
      index += op.length;
    } else if (TextOperation.isDelete(op)) {
      content = content.substr(0, index) + content.substr(index - op)
    }
  }

  editor.setContent(wp.editor.autop(content))
  selection.moveToBookmark(bookmark)
  this._lastContent = this.getContent()
}

module.exports = TinymceEditor
