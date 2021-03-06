@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Thread</div>

                <div class="card-body">
                    @forelse ($threads as $thread)
                            <article>
                                <div class="level">
                                    <h4 class="flex">
                                        <a href="{{ $thread->path()}}">
                                            {{ $thread->title}}
                                        </a>
                                    </h4>
                                   <a href="{{ $thread->path() }}">
                                        {{ $thread->replies_count }} {{ str_plural ('reply', $thread->replies_count)}}</a>
                                </div>
                                <div class="card-body"> {{ $thread->body }}</div>
                            </article>
                            @empty

                            <p>There are no Results at the Moment</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
