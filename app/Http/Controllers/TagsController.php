<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TagRequest;
use App\Post;
use App\Tag;

class TagsController extends Controller
{

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['posts']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->all());

        return $tag;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        /** @var Tag $tag */
        $tag       = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();

        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        if ($this->destroyPrototype($tag, 'delete') === true) {
            return response()->json('ok');
        }

        return response()->json('Integrity Violation.');
    }

    /**
     * returns the related tag posts.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        return Tag::findOrFail($id)->load('posts', 'posts.tags')->posts->each(function (Post $post) {
            $post->withDates();
        });
    }
}
