<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Website;
use App\Service\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post_service;

    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function create(CreatePostRequest $request, Website $website)
    {
        $validated = (object)$request->validated();

        $post = $this->post_service->create($website, $validated->title, $validated->description);

        unset($post['website']);

        return $this->json($post, 201);
    }
}
