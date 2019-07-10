<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Rooms;
use Faker\Generator as Faker;

$factory->define(Rooms::class, function (Faker $faker) {
    return [
        'room_name' => $faker->title,
    ];
});
