var assert = require('assert'),
  op = require('../src/diff-text'),
  TextOperation = require('ot/lib/text-operation')


describe('Operation', () => {
  describe('diffting', () => {
    it('can invert', function () {
      var pair = op.operationPairFromText('Good morning', 'Bad morning')

      var s = pair[0].apply('Good morning');
      var d = pair[1].apply('Bad morning');
      assert.equal(s, 'Bad morning')
      assert.equal(d, 'Good morning')
    })
  })
})
