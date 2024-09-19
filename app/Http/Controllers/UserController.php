<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

    public function profile(User $user)
    {
        return view('profile', ['user' => $user, 'posts' => $user->posts()->latest()->paginate(20)]);
    }

    public function avatarStore()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $publicStorage = Storage::disk('public');
        request()->validate([
            'avatar' => ['required', 'max:3072', 'image',]
        ]);
        //Instantiate new Intervention ImageManager and read uploaded image
        $imgManager = new ImageManager(new Driver());
        $upload = request()->file('avatar');
        $filename = strtolower($user->username) . "_" . uniqid() . ".jpg";
        $image = $imgManager->read($upload);
        //Resize image
        $resized = $image->cover(120, 120)->toJpeg();
        //Delete old image
        $oldAvatarPath = str_replace("/storage/", "", $user->avatar);
        if ($publicStorage->exists($oldAvatarPath) && $user->avatar) {
            $publicStorage->delete($oldAvatarPath);
        };
        //Save image
        $publicStorage->put("avatars/{$filename}", $resized);
        //Update user avatar in database
        $user->avatar = $filename;
        $user->save();
        //Redirect to profile page with updated avatar and success message
        return redirect("/profile/{$user->username}")->with('success', 'Your avatar has been updated!');
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
            'username' => ['required', 'alpha_dash:ascii', 'min:4', Rule::unique('users', 'username')],
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
    public function show()
    {
        $authUser = Auth::user();
        $posts = $authUser ? Post::query()->where('user_id', $authUser->id)->get() : [];
        if (Auth::check()) {
            return $authUser && $posts->count() > 0 ? redirect("/profile/{$authUser->username}") : view('auth-home');
        } else {
            return view('guest-home');
        }
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
