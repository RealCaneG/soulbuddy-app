<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\CounsellingHelperRating::class, function (Faker $faker) {
    return [
        'rating' => 0.0
    ];
});
