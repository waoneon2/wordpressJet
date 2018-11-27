const Client = require('ot/lib/client')
const TextOperation = require('ot/lib/text-operation')

const {inherits} = require('./utils')


function EditorClient(revision, postid, editorAdapter, serverAdapter) {
  if (!this instanceof EditorClient)
    return new EditorClient(revision, postid, editorAdapter, serverAdapter)
  Client.call(this, revision)

  this._postid = postid
  this._editorAdapter = editorAdapter
  this._serverAdapter = serverAdapter
  this._usersEditing = []
  this._operationSended = false
  editorAdapter.on('change', (operation, inverse) => this.onChange(operation, inverse))

  serverAdapter.on('ack', () => this.serverAck())
  serverAdapter.on('operation', (operation) => this.applyServer(TextOperation.fromJSON(operation)))
  serverAdapter.on('revision_updated', (revision) => {
    this.revision = revision
    this._operationSended = false
  })
  serverAdapter.on('room_members', (users) => {
    this._usersEditing = users
    this._maybeDeleteOperation()
  })
  serverAdapter.on('member_added', (user) => {
    this._usersEditing.push(user)
  })
  serverAdapter.on('member_removed', (user) => {
    this._usersEditing = this._usersEditing.filter(u => u != user)
    this._maybeDeleteOperation()
  })
}

inherits(EditorClient, Client)

EditorClient.prototype.onChange = function (operation, inverse) {
  this.applyClient(operation)
}

EditorClient.prototype._maybeDeleteOperation = function() {
  if (this._usersEditing.length === 1 && this._operationSended) {
    this._serverAdapter.sendDeleteOperation(this._postid)
  }
}

EditorClient.prototype.sendOperation = function (revision, operation) {
  this._operationSended = true
  console.log(this._usersEditing)
  this._serverAdapter.sendOperation(revision, operation.toJSON(), this._postid)
}

EditorClient.prototype.applyOperation = function (operation) {
  this._editorAdapter.applyOperation(operation)
}

module.exports = EditorClient