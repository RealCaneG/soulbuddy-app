<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\UserBalance::class, function (Faker $faker) {
    return [
        'balance' => $faker->unique()->numberBetween(0.0, 1000.0),
        'is_locked' => false,
    ];
});
