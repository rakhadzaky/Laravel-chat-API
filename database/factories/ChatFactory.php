<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Chats;
use Faker\Generator as Faker;

$factory->define(Chats::class, function (Faker $faker) {
    $listPersonId = App\Persons::all();
    $random = $faker->randomElement($listPersonId, $count = 1);

    return [
        'user_id' => $random->user_id,
        'room_id' => $random->room_id,
        'message' => $faker->paragraph(),
    ];
});
