@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} replied to thread

    @endslot

    @slot('body')
    	{{ $activity->subject }}
        {{-- {{$activity->body}} --}}

    @endslot

@endcomponent
