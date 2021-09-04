<?php

namespace App\Service;

use App\Models\Website;

class WebsiteService{


    public function create(string $url, string $name)
    {
        return Website::create([
            'url' => $url,
            'name' => $name
        ])->toArray();

    }

    public function all()
    {
        return Website::all()->toArray();
    }
}