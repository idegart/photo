<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::get('/posts/{post}/like', 'PostController@like')->name('post.like');
Route::get('/posts/{post}/unlike', 'PostController@unlike')->name('post.unlike');
