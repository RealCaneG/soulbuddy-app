<?php

use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'completed', 'pending', 'rejected'
        $transactionStatus = \Illuminate\Support\Collection::make(['completed', 'pending', 'rejected']);
        foreach ($transactionStatus as $status) {
            DB::table('transaction_statuses')->insert([
                'status' => $status
            ]);
        }
    }
}
