<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $request = [
        "method" => "GET",
        "uri" => "",
        "headers" => ["Accept" => "application/json", "Content-Type" => "application/json"],
        "body" => []
    ];

    protected function setRequestHeader($key, $value)
    {
        $headers = $this->request["headers"];
        $headers[$key] = $value;
        $this->request['headers'] = $headers;
    }

    protected function fire()
    {
        return $this->call($this->request["method"], $this->request["uri"], $this->request["body"], $this->request["headers"]);
    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setUp();
        app('DocGen')->init(); // this method clears previously generated docs.
    }

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     // Uncomment bellow line if you want to use passport fake for authentication.
    //     // Artisan::call('passport:install'); 
    // }

}