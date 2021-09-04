<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscribers = [
            [
                'email' => 'cybersrikanth001@gmail.com'
            ]
        ];

        DB::table('subscribers')->upsert($subscribers, ['email'], ['email']);
    }
}
