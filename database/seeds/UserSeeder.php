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
            $user->userBalance()->save(factory(\App\UserBalance::class)->make());
            $user->rating()->save(factory(\App\CounsellingHelperRating::class)->make());
        });
    }
}
