<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a few todo lists
        $todos = factory(\App\TodoList::class, rand(3, 4))
            ->create()
            //for every todo list, assign a few items
            ->each(function ($todo) {
                factory(\App\Item::class, rand(4, 7))
                    ->make()
                    //assign the item to the todo list
                    ->each(function ($item) use ($todo) {
                        $item->todoList()
                            ->associate($todo)
                            ->save();
                    });
            });
    }
}
