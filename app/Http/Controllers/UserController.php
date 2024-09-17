<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        $valid = request()->validate([
            'login_email' => ['required'],
            'login_password' => ['required'],
        ]);
        if (Auth::attempt([
            'email' => $valid['login_email'],
            'password' => $valid['login_password'],
        ])) {
            request()->session()->regenerate();
            return redirect('/')->with('success', 'You have been logged in!');
        } else {
            return redirect('/')->with('error', 'Invalid credentials!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out!');
    }

    public function homeView()
    {
        return Auth::check() ? view('auth-home') : view('guest-home');
    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'username' => ['required', 'min:4', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $newUser = User::create($validated);
        Auth::login($newUser);
        return redirect('/')->with('success', 'Your account has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
