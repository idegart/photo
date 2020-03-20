<?php

use App\Http\Controllers\Api;

Route::name('api.')->group(function () {
    Route::apiResource('posts', Api\PostController::class)->except('show');
    Route::apiResource('images', Api\ImageController::class)->except('show');
    Route::apiResource('likes', Api\LikeController::class)->only(['store', 'destroy']);
});
