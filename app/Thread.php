<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/threads/{$this->channel->slug }/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function Channel()
    {
        return $this->BelongsTo(Channel::class);
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);

    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
