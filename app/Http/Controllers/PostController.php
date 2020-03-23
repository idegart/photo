<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Resources\Api\PostReource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(StoreRequest $request)
    {
        Post::create($request->validated());

        return redirect()->to('home');
    }

    public function like(Post $post)
    {
        $post->likes()->firstOrCreate(['user_id' => \Auth::id()]);

        return redirect()->to('home');
    }

    public function unlike(Post $post)
    {
        $post->likes()->where(['user_id' => \Auth::id()])->delete();

        return redirect()->to('home');
    }
}
