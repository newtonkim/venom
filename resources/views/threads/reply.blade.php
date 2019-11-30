<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex"> 
                <a href="{{route('profile', $reply->owner)}}">
                    {{$reply->owner->name }}
                </a> said {{$reply->created_at->diffForHumans()}}...
            </h5>
            <div>
               {{--  {{ $reply->favorites()->count() }} --}}
                
                <form method="POST" action="/replies/{{ $reply->id }}/favorite">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                       {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
         {{ $reply->body }}
    </div>
</div>
