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

@endsection
