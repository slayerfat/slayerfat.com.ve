<?php

Route::get('/', function () {
    $paths      = File::files(public_path('images/backgrounds'));
    $path       = $paths[array_rand($paths, 1)];
    $pathInfo   = pathinfo($path);
    $background = "images/backgrounds/{$pathInfo['basename']}";

    return view('index', compact('background'));
});

Route::get('/videos', ['as' => 'videos.index', 'uses' => 'VideosController@index']);
Route::get('/videos/{id}', ['as' => 'videos.index', 'uses' => 'VideosController@show']);
Route::get('/videos/uploads/latest', ['as' => 'videos.index', 'uses' => 'VideosController@latestUploads']);
