<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ArticleSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(CounsellingRequestSeeder::class);
        $this->call([SecretSeeder::class,
            ArticleSeeder::class,
            CategorySeeder::class,
            CounsellingRequestSeeder::class,
            TransactionTypeSeeder::class,
            ]);
    }
}
