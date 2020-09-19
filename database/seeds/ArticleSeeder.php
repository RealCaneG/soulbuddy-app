<?php

use App\Article;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        /** @var Factory $factory */
    {
        $factory->define(Article::class, function (Faker $faker) {
            return [
                'user_id' => $faker->numberBetween(1, 50),
                'title' => $faker->unique()->sentence,
                'body' => $faker->unique()->text(200),
                'overall_rating' => 0, // password
                'is_rated' => false,
                'is_free' => true,
                'is_locked' => false,
            ];
        });
    }
}
