<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     public function like(Request $request)
    {
        $post = Post::find($request->postId);
        $likeStat;
        $myLike = $post->likes->where('user_id', $request->user()->id)->first();
        if ($myLike) {
            $like = $post->usersLiked()->detach($request->user()->id);
            $likeStat = false;
        } else {
            $like = $post->usersLiked()->attach($request->user()->id);
            $likeStat = true;
        }
        return response()->json(['status' => true, 'likeStat' => $likeStat]);
    }
 /*    public function unlike(Request $request)
    {
        $post = Post::find($request->postId);
        $like = $post->usersLiked()->detach($request->user()->id);
        return true;
    }  */

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::orderByDesc('id')->get();
        foreach ($posts as $post) {
            $likes = $post->likes;
            foreach ($likes as $like) {
                if ($like->user_id == $request->user()->id) {
                    $post->liked = true;
                } else {
                    $post->liked = false;
                }
            }
        }
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $request['user_id'] = $user->id;
        $post = Post::create($request->all());
        if ($post) {
            return response()->json(['status' => true, 'post' => $post]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function myPost(Request $request)
    {
        $user = $request->user();
        return response()->json(['MyPosts' => $user->posts]);
    }
}
