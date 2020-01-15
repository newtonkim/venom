@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
             @forelse ($threads as $thread)
            <div class="panel panel-default">
                 <div class="panel-heading">
                    <div class="level">
                        <h4 class="flex">
                            <a href="{{ $thread->path()}}">
                                {{ $thread->title}}
                            </a>
                        </h4>
                        <a href="{{ $thread->path() }}">
                            {{ $thread->replies_count }} {{ str_plural ('reply', $thread->replies_count)}}
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <hr>
                    <div class="body"> {{ $thread->body }}</div>
                    <hr> 
                    <br>
                </div>
            </div>
            @empty
                  <p>There are no Results at the Moment</p>
             @endforelse
        </div>
    </div>
</div>
@endsection
