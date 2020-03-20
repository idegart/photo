<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Like\DestroyRequest;
use App\Http\Requests\Api\Like\StoreRequest;
use App\Http\Resources\Api\LikeResource;
use App\Models\Like;
use Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(StoreRequest $request)
    {
        $like = Like::query()->create([
            'likeable_id' => $request->input('id'),
            'likeable_type' => $request->getModelOfType()->getMorphClass(),
        ]);

        return new LikeResource($like);
    }

    public function destroy(DestroyRequest $request, Like $like)
    {
        $like->delete();

        return response('ok');
    }
}
