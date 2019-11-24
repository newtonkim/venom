@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }} </a> posted: A..
                                {{ $thread->title }}
                            </span>
                            @can('update', $thread)
                                <form action="{{$thread->path()}}" method="POST">

                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
                
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach

                    @if(auth()->check())
                        <form method="POST" action="{{ $thread->path() . '/replies' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" id="body" class="form-control" placeholder="Venom" rows="5"></textarea>
                            </div>
                                <button type="submit" class="btn btn-default">Post</button>
                        </form>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">Sign in </a>to participate in this discussion.</p>
                    @endif
                        <br>
                     {{ $replies->links()}}
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>This thread was published {{ $thread->created_at->diffForHumans()}} by <a href="#">{{ $thread->creator->name}}</a> and currently has {{$thread->replies_count}} {{ str_plural('comment', $thread->replies_count) }}  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
