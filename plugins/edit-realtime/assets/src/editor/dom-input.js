const EventEmitter = require('eventemitter3')
const TextOperation = require('ot/lib/text-operation')

const {toWPFormat, operationPairFromText } = require('./../diff-text')
const {inherits} = require('./../utils')


function DomInput(dom) {
	if (!this instanceof DomInput) return new DomInput(dom)
  EventEmitter.call(this)

  this._dom = dom
  this._ignoreNextChange = false

  this._onChanges = this.onChanges.bind(this)
  this._lastContent = dom.value
  dom.addEventListener('input', this._onChanges)
}

inherits(DomInput, EventEmitter)

DomInput.prototype.getContent = function () {
  return this._dom.value
}

DomInput.prototype.onChanges = function (e) {
  if (!this._ignoreNextChange) {
    const content = this.getContent().trim()
    const _lastContent = this._lastContent.trim()
    if (content !== _lastContent) {
      const pair = operationPairFromText(_lastContent, content)
      this.emit('change', pair[0], pair[1])
      this._lastContent = this.getContent()
    }
  }
  this._ignoreNextChange = false
}

DomInput.prototype.applyOperation = function (operation) {
  var start = 0, end = 0, content = this.getContent().trim(), ops = operation.ops, index = 0

  this._ignoreNextChange = true
  if (this._dom === document.activeElement) {
    start = this._dom.selectionStart
    end = this._dom.selectionEnd
  }

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

  if (this._dom === document.activeElement) {
    this._dom.setSelectionRange(start, end)
  }
  this._dom.value = content
  this._lastContent = this.getContent()
}

module.exports = DomInput