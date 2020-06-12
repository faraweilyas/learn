<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Conversation;
use Faker\Generator as Faker;

$factory->define(Conversation::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
