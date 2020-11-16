<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Pricing::class, function (Faker $faker) {
    return [
        'token' => 1000,
        'price' => 100,
        'ccy' => 'HKD',
    ];
});
