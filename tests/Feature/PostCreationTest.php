<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Subscriber;
use App\Models\SubscriberPost;
use App\Models\Website;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCreationTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostCreatePostForWebsite()
    {
        $website = Website::factory()->create();
        $subscriber = Subscriber::factory()->create();
        $subscriber->websites()->attach($website);
        $this->request['method'] = 'POST';
        $this->request['uri'] = '/api/website/' . $website->id . '/post';
        $this->request['body'] = [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->sentence(100)
        ];

        $response = $this->fire();
        
        $response->assertStatus(201);

        // dd($response->getContent());
        $response->assertJson($this->request['body']);

        $subscriber_post = SubscriberPost::latest('id')->first();

        $this->assertEquals($subscriber_post->subscriber_id, $subscriber->id);
        $this->assertEquals($subscriber_post->post_id, Post::latest('id')->first()->id);

        app('DocGen')->make(__FUNCTION__, $this->request, $response);
    }
}
