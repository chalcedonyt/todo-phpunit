<?php

namespace Tests\Feature\Events;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Log;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_key_is_generated()
    {
        Log::shouldReceive('debug')->once();
        $user = factory(\App\User::class)->create();
        $this->assertGreaterThan(strlen($user->api_key), 60);
    }

    public function test_api_token_is_not_changed_on_save()
    {
        $user = factory(\App\User::class)->create();
        $api_token = $user->api_token;
        $user->touch();
        $this->assertEquals($api_token, $user->fresh()->api_token);
    }
}
