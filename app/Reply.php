<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

     protected $fillable = [
        'body', 'user_id', 'thread_id'
        ];

    protected $gaurded = [];
    protected $with =['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
