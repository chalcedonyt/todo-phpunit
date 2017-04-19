# Todo app demo

## A demo app to illustrate benefits of testing

There are three models in the app:

* `App\TodoList` is a todo list that contains a `title`
* `App\Item` are the contents of a TodoList associated via `list_id`.
  * When an `App\Item` is created, its parent `App\TodoList` should update its `last_item_updated_at` value.
* `App\User` contains user information. When a user is created, a key is generated in `api_key` and is used to authenticate via the `Authorization` header.