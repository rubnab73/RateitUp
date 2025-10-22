<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        Auth::user()->following()->attach($user->id);

        return back()->with('status', "You are now following {$user->name}.");
    }

    public function destroy(User $user)
    {
        Auth::user()->following()->detach($user->id);

        return back()->with('status', "You have unfollowed {$user->name}.");
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->latest()->paginate(20);
        return view('users.followers', compact('user', 'followers'));
    }

    public function following(User $user)
    {
        $following = $user->following()->latest()->paginate(20);
        return view('users.following', compact('user', 'following'));
    }
}