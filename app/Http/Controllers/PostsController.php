<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Tag;
use Auth;

class PostsController extends Controller
{

    /**
     * PostsController constructor.
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
        return Post::published()
            ->orderBy('publish_date', 'desc')
            ->get()
            ->load('tags')
            ->each(function (Post $post) {
                $post->withDates();
            });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unpublished()
    {
        return Post::unpublished()
            ->orderBy('publish_date', 'desc')
            ->get()
            ->load('tags')
            ->each(function (Post $post) {
                $post->withDates();
            });
    }

    /**
     * Displays a post.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /** @var Post $post */
        $post = Post::findBySlugOrIdOrFail($slug)->load('tags');
        $post->withDates();

        return $post;
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
