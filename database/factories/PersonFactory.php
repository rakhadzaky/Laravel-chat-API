<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Persons;
use Faker\Generator as Faker;

$factory->define(Persons::class, function (Faker $faker) {
    $listUserId = App\User::pluck('id');
    $listRoomId = App\Rooms::pluck('room_id');

    return [
        'room_id' => $faker->randomElement($listRoomId),
        'user_id' => $faker->randomElement($listUserId),
    ];
});
