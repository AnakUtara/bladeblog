<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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
        $validate['content'] = strip_tags($validate['content']);
        $validate['slug'] = $slugify->slugify($validate['title']);
        $validate['user_id'] = Auth::user()->id;

        // Post::create($validate);

        dd($validate);
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
}
