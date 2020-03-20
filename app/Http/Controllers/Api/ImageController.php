<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Image\DestroyRequest;
use App\Http\Requests\Api\Image\IndexRequest;
use App\Http\Requests\Api\Image\ShowRequest;
use App\Http\Requests\Api\Image\StoreRequest;
use App\Http\Requests\Api\Image\UpdateRequest;
use App\Http\Resources\Api\ImageReource;
use App\Models\Image;
use Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(IndexRequest $request)
    {
        return ImageReource::collection(Image::all());
    }

    public function store(StoreRequest $request)
    {
        $image = Image::query()->create([
            'title' => $request->input('title'),
            'path' => Storage::disk('local')->putFile('images', $request->getFile())
        ]);

        return new ImageReource($image);
    }

    public function show(ShowRequest $request, Image $image)
    {
        //
    }

    public function update(UpdateRequest $request, Image $image)
    {
        $image->update($request->validated());

        return response('ok');
    }

    public function destroy(DestroyRequest $request, Image $image)
    {
        return response('ok');
    }
}
