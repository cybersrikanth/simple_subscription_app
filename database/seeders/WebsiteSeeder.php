<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            [
                'name' => 'Medium',
                'url' => 'medium.com'
            ],
            [
                'name' => 'Youtube',
                'url' => 'youtube.com'
            ],
        ];

        DB::table('websites')->upsert($websites, ['url'], ['name', 'url']);
    }
}
