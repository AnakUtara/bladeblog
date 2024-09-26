<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\NewPostEmail;
use Cocur\Slugify\Slugify;
use Snortlin\NanoId\NanoId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    private String $allowedTags = '<p><pre><br><b><strong><del><em><i><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><code><div><a><span><img><figure><figcaption><table><thead><tbody><th><tr><td>';
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
        $validate['slug'] = $slugify->slugify($validate['title']) . '-' . NanoId::nanoId(8);
        $validate['user_id'] = Auth::user()->id;

        $newPost = Post::create($validate);

        Mail::to(Auth::user()->email)->send(new NewPostEmail([
            'title' => $newPost->title,
            'slug' => $newPost->slug,
            'username' => Auth::user()->username
        ]));

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
        return view('edit-post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $slugify = new Slugify();
        $validate = request()->validate([
            'title' => ['required', 'min:4', 'max:300'],
            'content' => ['required', 'min:4', 'max:10000'],
        ]);

        $validate['slug'] = $slugify->slugify($validate['title']) . '-' . NanoId::nanoId(8);
        $validate['title'] = strip_tags($validate['title']);
        $validate['content'] = strip_tags(
            $validate['content'],
            allowed_tags: $this->allowedTags
        );
        $post->update($validate);
        return redirect("/post/{$post->slug}/edit")->with('success', "This post has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();
        $post->delete();
        return redirect("/profile/{$user->username}")->with('success', 'Your post has been deleted!');
    }

    public function search()
    {
        $posts = Post::search(request()->query('search'))->latest()->get();
        $posts->load('user:id,username,avatar,email')->take(7);
        return $posts;
    }
}
