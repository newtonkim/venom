<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigration;

class ThreadTest extends TestCase
{
    /**@Test*/

    function a_thread_has_a_reply()
    {
        $thread = factory ('App\Thread')->create();

        $this->assertInstanceOf('Illuminate\Database\Collection', $thread->replies);
    }

    function a_thread_has_a_creator()
    {
        $thread = factory ('App\Thread')->create();

        $this->assertInstanceOf('App\User', $thread->user);
    }
}
