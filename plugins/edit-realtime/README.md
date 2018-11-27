## Collaboration Editing in Wordpress

This collaboration editing use Wordpress and TinyMCE Editor, we don't replace the editor
with something else, so it should compatible with other plugins that customize the editor.

### Behaviour

Both content and title when you edit post are tracked by this plugin. So,
any update you made there, it will available to other users that currently edit same post.

Both post's content and title you are editing, not saved to original post table, but we store it on other database table,
it will saved to original post table only when you click update/save button on editor page. We save it on other database because:

- if new user edit that post, post's content and title they see should same as others (online) that editing it.
That's why you see in first load, the title and content updated.
- When you don't hit update/save, chance are you still editing that post. And you don't want that appear on frontend
until you decide to save/update it.

### Tansport Channel

Currently the transport channel used to communicate between windows are Ajax and Pusher. In
future we will try to implements it using Websocket.