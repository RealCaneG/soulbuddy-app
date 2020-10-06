<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Pricing::class, function (Faker $faker) {
    return [
        'token' => $faker->numberBetween(200, 1000),
        'price' => $faker->numberBetween(50, 100),
        'ccy' => 'HKD',
    ];
});
