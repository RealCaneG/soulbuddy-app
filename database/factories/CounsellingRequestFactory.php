<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\CounsellingRequest::class, function (Faker $faker) {
    return [
        'subject' => $faker->text(50),
        'category_id' => $faker->numberBetween(1, 7),
        'expiry_date' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'description' => $faker->paragraph(5),
        'maker_id' => $faker->numberBetween(1, 30)
    ];
});
