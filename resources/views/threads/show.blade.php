@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#">{{ $thread->creator->name }} </a> posted:..
                    {{ $thread->title }}
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>
</div>
    <br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>
    </div>
</div>
@if(auth()->check())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <form method="POST" action="{{ $thread->path() . '/replies' }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Hello Jamokes" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Post</button>
               </form>
            </div>
        </div>
    </div>
</div>
@else
<br>
    <p class="text-center">Please <a href="{{ route('login') }}">Sign in </a>to participate in this discussion.</p>
@endif

@endsection
