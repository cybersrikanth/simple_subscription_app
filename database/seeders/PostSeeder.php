<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'id' => 1,
                'website_id' => Website::first()->id,
                'title' => 'This is test title',
                'description' => 'This is test description'
            ],
            [
                'id' => 2,
                'website_id' => Website::latest('id')->first()->id,
                'title' => 'This is test title 1',
                'description' => 'This is test description 1'
            ]
        ];

        DB::table('posts')->upsert($posts, ['id'], ['id', 'website_id', 'title', 'description']);
    }
}
