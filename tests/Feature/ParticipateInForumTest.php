<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

   /**@test */

   function unauthenticated_users_may_not_add_replies()
   {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/thread/1/replies', []);
   }

    function authenticated_user_may_participate_in_forum()
    {
        // have an authenticated user
        $this->be($user = factory('App\User')->create());

        $user = factory('App\User')->create();

        //And an existing thread

        $thread = factory('App\Thread')->create();

       // when user adds areply to the thread

        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/replies', $reply->toArray()); // submit request to the server

        // then their reply should be visible on the page

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
