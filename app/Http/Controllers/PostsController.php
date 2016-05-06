<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;

class PostsController extends Controller
{

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
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
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
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
