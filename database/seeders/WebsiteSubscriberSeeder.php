<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_subscribers = [
            [
                'subscriber_id' => Subscriber::first()->id,
                'website_id' => Website::first()->id 
            ],
            [
                'subscriber_id' => Subscriber::first()->id,
                'website_id' => Website::latest('id')->first()->id 
            ]
        ];

        DB::table('website_subscribers')->upsert($website_subscribers, ['website_id', 'subscriber_id'], ['website_id', 'subscriber_id']);
    }
}
