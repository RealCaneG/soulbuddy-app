<?php

use App\Article;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 100)->create();
    }
}
