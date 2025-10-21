<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topic;
use App\Models\Review;
use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'topics' => Topic::count(),
            'reviews' => Review::count(),
            'comments' => Comment::count(),
        ];

        $latestUsers = User::latest()->take(5)->get();
        $latestTopics = Topic::with('user')->latest()->take(5)->get();
        $latestReviews = Review::with(['user', 'topic'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestTopics', 'latestReviews'));
    }

    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function topics()
    {
        $topics = Topic::with('user')->withCount('reviews')->paginate(15);
        return view('admin.topics.index', compact('topics'));
    }

    public function reviews()
    {
        $reviews = Review::with(['user', 'topic'])->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id !== auth()->id()) {
            $user->is_admin = !$user->is_admin;
            $user->save();
        }

        return back()->with('status', 'Admin status updated successfully.');
    }

    public function destroyTopic(Topic $topic)
    {
        $topic->delete();
        return back()->with('status', 'Topic deleted successfully.');
    }

    public function destroyReview(Review $review)
    {
        $review->delete();
        return back()->with('status', 'Review deleted successfully.');
    }
}