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

    Route::get('/videos', ['as' => 'videos.index', 'uses' => 'VideosController@index']);
    Route::get('/videos/{id}', ['as' => 'videos.index', 'uses' => 'VideosController@show']);
    Route::get('/videos/uploads/latest', ['as' => 'videos.index', 'uses' => 'VideosController@latestUploads']);

    Route::get('/etiquetas', ['as' => 'tags.index', 'uses' => 'TagsController@index']);
});
