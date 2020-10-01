<?php

use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionTypes = \Illuminate\Support\Collection::make(['Top Up', 'Purchase Secret', 'Selling Secret']);
        $i = 1;
        foreach ($transactionTypes as $transactionType) {
            DB::table('transaction_types')->insert([
                'type' => $transactionType
            ]);
        }
    }
}
