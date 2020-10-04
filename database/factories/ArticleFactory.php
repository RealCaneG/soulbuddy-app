<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'title' => $faker->unique()->sentence,
        'body' => $faker->unique()->paragraph(100),
        'category_id' => $faker->numberBetween(1, 7),
        'overall_rating' => 0,
        'is_rated' => false,
        'is_locked' => false,
        'is_free' => true
    ];
});
