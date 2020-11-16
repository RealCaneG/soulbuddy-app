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
        $this->call([
            UserSeeder::class,
            SecretSeeder::class,
            ArticleSeeder::class,
            CategorySeeder::class,
            CounsellingRequestSeeder::class,
            TransactionTypeSeeder::class,
            TransactionStatusSeeder::class,
            PricingSeeder::class,
            NotificationTypeSeeder::class,
            ]);
    }
}
