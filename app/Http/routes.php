<?php

// Authentication Routes...
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        $paths      = File::files(public_path('images/backgrounds'));
        $pathInfo   = pathinfo($paths[array_rand($paths, 1)]);
        $background = "images/backgrounds/{$pathInfo['basename']}";

        return view('index', compact('background'));
    });

    Route::get('/users/current', function () {
        return Auth::user();
    });

    Route::get('/videos', ['as' => 'videos.index', 'uses' => 'VideosController@index']);
    Route::get('/videos/{id}', ['as' => 'videos.index', 'uses' => 'VideosController@show']);
    Route::get('/videos/uploads/latest', ['as' => 'videos.index', 'uses' => 'VideosController@latestUploads']);

    Route::get('/tags', ['as' => 'tags.index', 'uses' => 'TagsController@index']);
    Route::post('tags', ['as' => 'tags.store', 'uses' => 'TagsController@store']);
    Route::get('/tags/{id}/posts', ['as' => 'tags.posts', 'uses' => 'TagsController@posts']);
    Route::put('tags/{id}', ['as' => 'tags.store', 'uses' => 'TagsController@update']);
    Route::delete('tags/{id}', ['as' => 'tags.store', 'uses' => 'TagsController@destroy']);

    Route::get('/posts', ['as' => 'posts.index', 'uses' => 'PostsController@index']);
    Route::get('/posts/{id}', ['as' => 'posts.index', 'uses' => 'PostsController@show']);
    Route::post('posts', ['as' => 'posts.store', 'uses' => 'PostsController@store']);
    Route::put('posts/{id}', ['as' => 'posts.store', 'uses' => 'PostsController@update']);
    Route::delete('posts/{id}', ['as' => 'posts.store', 'uses' => 'PostsController@destroy']);
});
