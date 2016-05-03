<?php

Route::get('/', function () {
    $paths      = File::files(public_path('images/backgrounds'));
    $path       = $paths[array_rand($paths, 1)];
    $pathInfo   = pathinfo($path);
    $background = "images/backgrounds/{$pathInfo['basename']}";

    return view('index', compact('background'));
});
