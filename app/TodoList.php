<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todo_lists';

    public function items()
    {
        return $this->hasMany(\App\Item::class, 'list_id');
    }
}
