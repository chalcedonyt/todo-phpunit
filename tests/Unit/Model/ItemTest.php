<?php

namespace Tests\Feature\Events;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Log;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_todo_list_last_item_updated_at_and_log()
    {
        $todo = factory(\App\TodoList::class)->create();
        $item = factory(\App\Item::class)->create();
        $item->todoList()->associate($todo)->save();

        $todo = $todo->fresh();
        $this->assertNotNull($todo->last_item_updated_at);
    }
}
