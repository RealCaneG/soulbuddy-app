<?php

use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notificationType = \Illuminate\Support\Collection::make(['event', 'info']);
        foreach ($notificationType as $nt) {
            DB::table('notification_types')->insert([
                'type' => $nt
            ]);
        }
    }
}
