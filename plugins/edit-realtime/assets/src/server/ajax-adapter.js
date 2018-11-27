const EventEmitter = require('eventemitter3')
const TextOperation = require('ot/lib/text-operation')
const $ = jQuery

const {inherits} = require('./../utils')


function AjaxAdapter(pusher, name, userid, options) {
  if (!this instanceof AjaxAdapter) return new AjaxAdapter(pusher, userid, postid)
  EventEmitter.call(this)
  this._userid = userid
  this._pusher = pusher
  this._name = 'presence-' + name
  this._options = options
  this._socket = undefined
  this._setupConnection()
}

inherits(AjaxAdapter, EventEmitter)

AjaxAdapter.prototype._setupConnection = function () {
  this._socket = this._pusher.subscribe(this._name)
  this._socket.bind(this._options.channel, (data) => {
    if (data.user_id === this._userid) {
      return this.emit('ack')
    }
    this.emit('operation', data.operation)
  })
  this._socket.bind('pusher:subscription_succeeded', (data) => {
    this.emit('room_members', Object.keys(data.members).map(k => data.members[k]))
  })
  this._socket.bind('pusher:member_added', (member) => {
    this.emit('member_added', member.info)
  })
  this._socket.bind('pusher:member_removed', (member) => {
    this.emit('member_removed', member.info)
  })
}

AjaxAdapter.prototype.sendOperation = function (revision, operation, postid) {
  const onError = () =>
    setTimeout(() => { this.sendOperation(revision, operation, postid) }, 500)

  const onSuccess = (res) => {
    if (!res.success) onError()
  }

  const url = this._options.url
  const action = this._options.action
  const userid = this._userid
  $.ajax({
    url,
    type: 'POST',
    data: {
      action,
      revision,
      operation: JSON.stringify(operation),
      post_id: postid,
      user_id: userid,
      timestamp: Date.now()
    },
    success: onSuccess,
    error: onError
  })
}

AjaxAdapter.prototype.sendDeleteOperation = function (postid) {
  const url = this._options.url
  const action = this._options.delete_action
  const onSuccess = (res) => {
    if (res.success) {
      this.emit('revision_updated', res.revision)
    }
  }
  $.ajax({
    url,
    type: 'POST',
    data: {
      action,
      post_id: postid,
      timestamp: Date.now()
    },
    error: () => ({}),
    success: onSuccess
  })
}

module.exports = AjaxAdapter
