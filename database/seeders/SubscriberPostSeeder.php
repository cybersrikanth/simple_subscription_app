<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriber_posts = [
            [
                'subscriber_id' => Subscriber::first()->id,
                'post_id' => Post::first()->id,
            ],
            [
                'subscriber_id' => Subscriber::first()->id,
                'post_id' => Post::latest('id')->first()->id,
            ]
        ];

        DB::table('subscriber_posts')->upsert($subscriber_posts, ['subscriber_id', 'post_id'], ['subscriber_id', 'post_id']);
    }
}
