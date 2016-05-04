<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Youtube;

class VideosController extends Controller
{
    public function index()
    {
        return view('videos.index');
    }

    public function show($id)
    {
        return "video $id";
    }

    public function latestUploads()
    {
        $uploads = Youtube::getPlaylistItemsByPlaylistId(env('YOUTUBE_UPLOADS_ID'), false, 5);
        $uploads = $uploads['results'];

        return $uploads;
    }
}
