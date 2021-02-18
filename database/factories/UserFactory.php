<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Guilherme',
        'email' => 'email@email.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$bXBJCt7NhkdZjd2zLqWxxehYb9p5nBKofHckEC2q1W6bMZ4HV/MG.', // password
        'remember_token' => Str::random(10),
    ];
});
