<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();
    //global scope is a query scope that is automatically applied to all the queries
        static::addGlobalScope('replyCount', function ($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });

        static::created(function ($thread){

            $thread->recordActivity('created');
        });

    }

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Channel()
    {
        return $this->belongsTo(Channel::class);
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
