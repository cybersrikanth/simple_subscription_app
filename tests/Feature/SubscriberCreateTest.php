<?php

namespace Tests\Feature;

use App\Models\Website;
use App\Models\WebsiteSubscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriberCreateTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSubscribeSubscribeWebsite()
    {
        $website = Website::factory()->create();
        $this->request['method'] = 'POST';
        $this->request['uri'] = '/api/subscribe';
        $this->request['body'] = [
            'email' => $this->faker->email(),
            'website_ids' => [$website->id]
        ];
        // dd($this->request['body']);

        $response = $this->fire();
        
        // dd($response->getContent());
        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Subscribed'
        ]);
        $website_subscriber = WebsiteSubscriber::latest('id')->first();

        $this->assertEquals($website_subscriber->subscriber->email, $this->request['body']['email']);
        $this->assertEquals($website_subscriber->website->id, $this->request['body']['website_ids'][0]);

        $this->assertEquals($website_subscriber->subscriber->email, $this->request['body']['email']);

        app('DocGen')->make(__FUNCTION__, $this->request, $response);
    }

    public function testSubscribeSubscribeWebsiteValidation()
    {
        $website = Website::factory()->create();
        $this->request['method'] = 'POST';
        $this->request['uri'] = '/api/subscribe';
        $this->request['body'] = [
            'email' => $this->faker->email(),
            'website_ids' => [$website->id,200]
        ];
        // dd($this->request['body']);

        $response = $this->fire();
        
        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'Given website Id\'s "200" doesnt exists',
            'errors' => null
        ]);
    }

}
