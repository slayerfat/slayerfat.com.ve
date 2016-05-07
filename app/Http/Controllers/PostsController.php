<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Tag;
use Auth;
use Date;

class PostsController extends Controller
{

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all()->load('tags');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Post $post */
        $post  = Post::findOrFail($id)->load('tags');
        $dates = $this->makePostDates($post);

        $post->dates = $dates;

        return $post;
    }

    /**
     * @param $post
     * @return array
     */
    private function makePostDates($post)
    {
        $dates              = [];
        $date               = Date::parse($post->publish_date);
        $dates['formatted'] = $date->diffForHumans();
        $dates['formal']    = 'Caracas, ' . $date->format('l j F \d\e Y');

        return $dates;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $tags = Tag::find($request->input('tag_id'));
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->save();

        $post->tags()->attach($tags);

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $post->fill($request->all());
        $post->save();

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($this->destroyPrototype($post, 'delete') === true) {
            return response()->json('ok');
        }

        return response()->json('Integrity Violation.');
    }
}
