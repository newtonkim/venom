<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
   use DatabaseMigrations;

   /*@test*/
   function guest_may_not_create_threads()
   {
      $this->withExceptionHandling();

      $this->get('/threads/create')
          ->assertRedirect('/login');

          $this->post('/threads')
            ->assertRedirect('/login');

   }
   /**@test*/
    function authenticated_user_can_create_new_forum_thread()
    {
        // Given we have a sign in user
        $this->signIn();

        // When we hit the endpoint to create a new thread

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        //Then, when we visit the thread page.

        $this->get($response->header->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
    /** @test */
    function a_thread_requires_a_title()
    {
      $this->publishThread(['title' => null])
            ->assertSeesionHasErrors('title');
    }
    /** @test */
    function a_thread_requires_a_body()
    {
      $this->publishThread(['body' => null])
            ->assertSeesionHasErrors('body');
    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {
      factory('App\channel', 2)->create();

      $this->publishThread(['chanel_id' => null])
            ->assertSeesionHasErrors('channel_id');

      $this->publishThread(['chanel_id' => 999])
            ->assertSeesionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
      $this->withExceptionHandling()->signIn();

      $thread = make ('App\Thread', $overrides);

      return $this->post('/threads', $thread->toArray());
    }
}
