<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGet()
    {
        $todo_count = 2;

        $todos = factory(\App\TodoList::class, $todo_count)->create()
            ->each(function ($todo) {
                factory(\App\Item::class, 4)->make()
                ->each(function ($item) use ($todo) {
                    $item->todoList()->associate($todo)->save();
                });
            });
        //extract the ids that were just created
        $ids = implode(',', $todos->pluck('id')->all());
        $response = $this->json('GET', '/todos', ['ids' => $ids]);
        $json = json_decode($response->getContent(), true);

        $this->assertTrue(is_array($json));
        $this->assertEquals($todo_count, count($json));

        for ($i = 0; $i < $todo_count; $i++) {
            $this_todo = $todos->get($i);
            $this->assertEquals($this_todo->title, $json[$i]['title']);
            $this->assertEquals($this_todo->items->count(), count($json[$i]['items']));
        }
    }
}
