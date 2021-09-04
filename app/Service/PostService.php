<?php

namespace App\Service;

use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;

class PostService{

    private function assignPostForWebsiteSubscribers(Post $post)
    {
        $subscriber_ids = $post->website->subscribers->pluck('id')->toArray();

        $post->subscribers()->attach($subscriber_ids);
        
        return true;
    }

    public function create(Website $website, string $title, string $description):array
    {
        $post = Post::create([
            'website_id' => $website->id,
            'title' => $title,
            'description' => $description
        ]);
        $this->assignPostForWebsiteSubscribers($post);
        return $post->toArray();
    }

 
}