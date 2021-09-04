<?php

namespace Tests\Feature;

use App\Models\Website;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createWebsiteTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWebsiteCreateWebsite()
    {
        $this->request['method'] = 'POST';
        $this->request['uri'] = '/api/website';
        $this->request['body'] = [
            'url' => $this->faker->domainName(),
            'name' => $this->faker->sentence()
        ];

        $response = $this->fire();
        
        $response->assertStatus(201);

        // dd($response->getContent());
        $response->assertJson($this->request['body']);
        $website_in_db = Website::latest('id')->first();
        $this->assertEquals($website_in_db->name, $this->request['body']['name']);
        $this->assertEquals($website_in_db->url, $this->request['body']['url']);

        app('DocGen')->make(__FUNCTION__, $this->request, $response);
    }

    public function testWebsiteGetAvailableWebsites()
    {
        Website::factory()->create();
        $this->request['method'] = 'GET';
        $this->request['uri'] = '/api/website';

        $response = $this->fire();
        
        $response->assertStatus(200);
        $response->assertJson(Website::all()->toArray());

        app('DocGen')->make(__FUNCTION__, $this->request, $response);
    }

    public function testWebsiteCreateValidation()
    {
        $this->request['method'] = 'POST';
        $this->request['uri'] = '/api/website';
        $this->request['body'] = [
            'url' => 'a',
            'name' => $this->faker->sentence(100)
        ];

        $response = $this->fire();
        
        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name must not be greater than 191 characters.'],
                'url' => ['The url must be at least 3 characters.']
            ]
        ]);
    }
}
