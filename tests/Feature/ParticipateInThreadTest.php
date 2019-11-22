<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInThreadTest extends TestCase
{
  use DatabaseMigrations;

   /**
    * @test
    */

   function unauthenticated_users_may_not_add_replies()
   {
        // $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->withExceptionHandling()
              ->post('/thread/some-channel/1/replies', [])
              ->assertRedirect('/login');
   }

    function authenticated_user_may_participate_in_forum()
    {
        // have an authenticated user
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray()); // submit request to the server

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    function a_reply_requires_a_body()
    {
         $this->withExceptionhandling()->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply', ['body']);

        $this->post($thread->path() . '/replies', $reply->toArray()) // submit request to the server
              ->assertSessionHasErrors('body');


    }
}
