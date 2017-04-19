<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Log;

class Item extends Model
{
    public function todoList()
    {
        return $this->belongsTo(\App\TodoList::class, 'list_id');
    }

    protected static function boot()
    {
        static::saving(function (Item $item) {
            $todo = $item->todoList;
            $todo->last_item_updated_at = new \DateTime();
            $todo->save();
            Log::info(sprintf("The list %s was updated", $todo->getKey()));
        });
    }
}
