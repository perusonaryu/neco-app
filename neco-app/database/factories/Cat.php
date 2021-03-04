<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cat;
use Faker\Generator as Faker;

$factory->define(Cat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'age' => '7',
        'image' => 'sample.jpg',
        'personality' => 'おとなしい',
        'gender' => 'オス',
        'user_id' => 1,
    ];
});
