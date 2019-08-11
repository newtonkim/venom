<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigration;

class ThreadTest extends TestCase
{
    use DatabaseMigration;

    protected $thread;

    public function setUp()
    {
        parent:setUp();

        $this->thread = create('App\Thread');

        /**@test */

        function a_thread_can_make_a_string_path()
        {

            $thread = create('App\Thread');

            $this->assertEquals(
                "/threads/{$thread->channel->slug}/{$thread->id}", $thread->path()
            );
        }

        $this->$thread = factory ('App\Thread')->create();

    }
    /**@Test*/

    function a_thread_has_a_reply()
    {

        $this->assertInstanceOf('Illuminate\Database\Collection', $this->$thread->replies);
    }

    function a_thread_has_a_creator()
    {

        $this->assertInstanceOf('App\User', $this->$thread->user);
    }

    public function a_thread_can_add_a_reply()
    {

        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => '1'

        ]);

        $this->assertCount(1, $this->$thread->replies);
    }

    /** @test */

    function a_thread_beleongs_to_a_channel()
    {
            $thread = create('App\Thread');
            $this->assertInstanceOf('App\Channel', $thread->channel);

    }
}
