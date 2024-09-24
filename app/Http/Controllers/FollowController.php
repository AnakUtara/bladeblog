<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
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
    public function create(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return redirect("/profile/{$user->username}")->with('error', 'You cannot follow yourself!');
        }

        if (Follow::where([
            ['user_id', '=', Auth::user()->id,],
            ['following_id', '=', $user->id],
        ])->exists()) {
            return redirect("/profile/{$user->username}")->with('warning', 'You are already following: ' . $user->username);
        }

        Follow::create([
            'user_id' => Auth::user()->id,
            'following_id' => $user->id
        ]);

        return redirect("/profile/{$user->username}")->with('success', 'You are now following: ' . $user->username);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Follow::where([
            ['user_id', '=', Auth::user()->id,],
            ['following_id', '=', $user->id],
        ])->delete();
        return redirect("/profile/{$user->username}")->with('success', 'You have unfollowed: ' . $user->username);
    }
}
