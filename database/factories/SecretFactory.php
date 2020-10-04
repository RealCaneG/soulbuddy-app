<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Secret::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'title' => $faker->unique()->sentence,
        'body' => $faker->paragraph(5),
        'category' => $faker->numberBetween(1, 7),
        'description' => $faker->paragraph(2),
        'overall_rating' => 0,
        'is_rated' => false,
        'is_free' => false,
        'price' => $faker->numberBetween(1, 10),
    ];
});
