<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->$thread = factory('App\Thread')->create();// assiging a thread to the object
    }

    /** @test */

    function a_user_can_view_all_threads()
    {

        $response = $this->get('/threads')
        ->assertSee($this->$thread->title);


    }

    /** @test */
    function a_user_can_read_a_single_threads()
    {

         $this->get('/threads/' .$thread->id)
            ->assertSee($this->$thread->title);

    }

    /** @test */

    function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // thread include replies
            $reply = factory('App\reply')->create(['thread_id' => $this->thread->id]);

        // when we visit a thread page
            $this->get('/threads/' .$this->thread->id)
                ->assertSee($reply->body);

        // we need to see the replies


    }

}
