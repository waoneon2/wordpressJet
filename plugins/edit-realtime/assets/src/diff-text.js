const diff = require('fast-diff')
const TextOperation = require('ot/lib/text-operation')


function toLength(op) {
  return TextOperation.isRetain(op)     ? op
  :      TextOperation.isDelete(op)     ? op
  :      /** otherwise */                 op.length
}

function operationPairFromText(t1, t2) {
  var delta = diff(t1, t2),
      operation = operationFromDiff(delta),
      invert = operation.invert(t1)
  return [operation, invert]
}

function operationFromDiff(delta) {
  var ops = new TextOperation()
  var offset = 0
  for (let i = 0, len = delta.length; i < len; i++) {
    switch (delta[i][0]) {
      case diff.INSERT:
        ops.insert(delta[i][1])
        offset += delta[i][1].length
        break
      case diff.DELETE:
        ops['delete'](delta[i][1].length)
        offset += delta[i][1].length
        break
      case diff.EQUAL:
        ops.retain(delta[i][1].length)
        offset += delta[i][1].length
        break
    }
  }
  return ops
}

function toWPFormat(text) {
  var lines = text.match(/[^\r\n]+/g)
  return Array.isArray(lines) ? lines.join("\r\n\r\n") : ''
}

module.exports = {
  operationFromDiff,
  operationPairFromText,
  toWPFormat
}
