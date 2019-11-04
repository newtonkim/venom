<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

     protected $fillable = [
        'body', 'user_id', 'thread_id'
        ];

    protected $gaurded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}