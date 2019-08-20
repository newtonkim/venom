<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth')->except(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *@param Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel)//route model binding
    {
        // $threads = Thread::latest()->filter($filters);
         // $threads = $this->getThreads($channel, $filters);

        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        }else{
            $threads = Thread::latest();
        }

        if ($username = request('by')){
            $user = \App\User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $user->id);

        }

        $threads = $threads->get();

        return view('threads.index', compact('threads'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title'   => request('title'),
            'body'    => request('body'),
            'channel_id' => request('channel_id')
        ]);

        return redirect($thread->path());
    }
    /**
     * Display the specified resource.
     *@param  $channeId
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channeId, Thread $thread)
    {

        return view('threads.show', compact('thread'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        // Do some editing all in here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        // return view('threads.upate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }


}
