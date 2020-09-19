<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->create()->each(function ($user) {
            $userBalance = factory(\App\UserBalance::class)->make();
            $user->userBalance()->save($userBalance);
        });
    }
}
