<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Thread;
use App\User;

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
         'user_id'=> function (){
            return factory('App\User')->create()->id;
        },
        'channel_id' =>function(){

            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body'=> $faker->paragraph,
    ];
});

$factory->define(App\Channel::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => $name
    ];
});

$factory->define(App\Reply::class, function (Faker $faker){
return [
        'user_id' => function (){
            return factory('App\User')->create()->id;
        },

        'Thread_id' => function (){
            return factory('App\Thread')->create()->id;

        },

        'body' => $faker->paragraph,

        ];
});