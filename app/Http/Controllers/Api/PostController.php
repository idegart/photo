<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\DestroyRequest;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\ShowRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\Api\PostReource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(IndexRequest $request)
    {
        return PostReource::collection(Post::all());
    }

    public function store(StoreRequest $request)
    {
        $post = Post::create($request->validated());

        return new PostReource($post);
    }

    public function show(ShowRequest $request, Post $post)
    {
        return new PostReource($post);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response('ok');
    }

    public function destroy(DestroyRequest $request, Post $post)
    {
        $post->delete();

        return response('ok');
    }
}
