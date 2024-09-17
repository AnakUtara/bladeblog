<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private String $allowedTags = '<p><br><b><strong><del><em><i><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><code><div><a><span><img><figure><figcaption><table><thead><tbody><th><tr><td>';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slugify = new Slugify();
        $validate = request()->validate([
            'title' => ['required', 'min:4', 'max:300'],
            'content' => ['required', 'min:4', 'max:10000'],
        ]);

        $validate['title'] = strip_tags($validate['title']);
        $validate['content'] = strip_tags(
            $validate['content'],
            allowed_tags: $this->allowedTags
        );
        $validate['slug'] = $slugify->slugify($validate['title']);
        $validate['user_id'] = Auth::user()->id;

        $newPost = Post::create($validate);

        return redirect("/post/{$newPost->slug}")->with('success', 'Your post has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('show-post', ['post' => $post]);
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
        $user = Auth::user();
        Gate::authorize('delete', $post);
        $post->delete();
        return redirect("/profile/{$user->username}")->with('success', 'Your post has been deleted!');
    }
}
