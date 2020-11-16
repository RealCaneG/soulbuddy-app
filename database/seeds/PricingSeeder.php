<?php

use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pricings')->insert([
            'token' => 1000,
            'price' => 100,
            'ccy' => 'HKD',
        ]);
    }
}
