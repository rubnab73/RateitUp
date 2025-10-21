<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topic;
use App\Models\Review;
use App\Models\Comment;
use App\Models\ReviewModeration;
use App\Notifications\ReviewModerationNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

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
        $users = User::withCount(['topics', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'expertise_level' => ['required', 'string', 'in:beginner,intermediate,advanced,expert'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('status', 'User updated successfully.');
    }

    public function topics()
    {
        $topics = Topic::with(['user', 'tags', 'reviews.comments'])
            ->withCount(['reviews'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $topics->each(function ($topic) {
            $topic->total_comments = $topic->reviews->sum(function ($review) {
                return $review->comments->count();
            });
        });
        
        return view('admin.topics.index', compact('topics'));
    }

    public function reviews()
    {
        $reviews = Review::with(['user', 'topic'])
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id !== auth()->id()) {
            $user->is_admin = !$user->is_admin;
            $user->save();
            return back()->with('status', 'Admin status has been updated successfully.');
        }
        return back()->with('error', 'You cannot modify your own admin status.');
    }

    public function editTopic(Topic $topic)
    {
        $topic->load(['user', 'tags']);
        return view('admin.topics.edit', compact('topic'));
    }

    public function updateTopic(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'status' => ['required', 'string', 'in:draft,published,archived'],
        ]);

        $topic->update($validated);

        return redirect()->route('admin.topics')
            ->with('status', 'Topic updated successfully.');
    }

    public function destroyTopic(Topic $topic)
    {
        try {
            $topic->delete();
            return back()->with('status', 'Topic has been deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete topic. Please try again.');
        }
    }

    public function editReview(Review $review)
    {
        $review->load(['user', 'topic']);
        return view('admin.reviews.edit', compact('review'));
    }

    public function updateReview(Request $request, Review $review)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', 'in:flag,warning'],
            'reason' => ['required', 'string', 'min:10'],
        ]);

        $moderation = ReviewModeration::create([
            'review_id' => $review->id,
            'admin_id' => auth()->id(),
            'action' => $validated['action'],
            'reason' => $validated['reason'],
        ]);

        $review->user->notify(new ReviewModerationNotification($moderation));

        return redirect()->route('admin.reviews')
            ->with('status', 'Review moderation notice sent successfully.');
    }

    public function destroyReview(Review $review)
    {
        try {
            $review->delete();
            return back()->with('status', 'Review has been deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete review. Please try again.');
        }
    }
}