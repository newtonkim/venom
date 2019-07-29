<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Thread;
use App\User;

use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
         'user_id'=> function (){
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body'=> $faker->paragraph,
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
