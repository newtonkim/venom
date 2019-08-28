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

    function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
                ->assertSee($threadInChannel->title)
                ->assertDontSee($threadNotInChannel->title);
    }

    function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'newtonkim']));
            $threadByNewtonkim = create('App\Thread', ['user_id' => auth()->id()]);
            $threadNotByNewtonkim = create('App\Thread');

            $this->get('threads?by=newtonkim')
                ->assertSee($threadByNewtonkim->title)
                ->assertDontSee($threadNotByNewtonkim->title);
    }

    /** @test */

    function a_user_can_filter_thread_by_popular()
    {
            //given we have 3 threeds
            // with 2 replies, 3 replies, and 0 replies
            $threadWithTwoReplies = create('App\Thread');
            create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

            $threadWithThreeReplies = create('App\Thread');
            create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

             $threadWithNoReplies = $this->thread; // assosiate

            // when  i filter all threads by popularity
             $response = $this->getJson('threads?popularity=1')->json();
            // they should return from most replies to least

             $this->assertEquals([3, 2, 0], array_column($response, 'reply_count'));
    }

}

