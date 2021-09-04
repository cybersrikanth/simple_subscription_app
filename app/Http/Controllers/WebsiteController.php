<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWebsiteRequest;
use App\Service\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    private $website_service;

    public function __construct(WebsiteService $website_service)
    {
        $this->website_service = $website_service;
    }

    public function create(CreateWebsiteRequest $request)
    {
        $validated = (object)$request->validated();

        $website = $this->website_service->create($validated->url, $validated->name);

        return $this->json($website, 201);
    }

    public function read()
    {
        $websites = $this->website_service->all();

        return $this->json($websites, 200);
    }
}
