<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware to all except index and show
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $search = request('search');
        $category = request('category');
        $sort = request('sort', 'newest');
        $rating = request('rating');
        $status = request('status', 'active');
        $featured = request('featured');

        $query = Topic::withCount('reviews')
            ->with(['reviews' => fn($q) => $q->select('id', 'topic_id', 'rating')]);

        // Status filtering
        if (!Auth::user()?->is_admin) {
            $query->where(function($q) {
                $q->where('status', 'published')
                  ->orWhere(function($q) {
                      $q->whereIn('status', ['draft', 'archived'])
                        ->where('user_id', Auth::id());
                  });
            });
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereFullText(['title', 'description'], $search)
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category) $query->where('category', $category);
        if ($featured) $query->where('is_featured', true);

        if ($rating) {
            $query->whereHas('reviews', function($q) use ($rating) {
                $q->select('topic_id')
                  ->groupBy('topic_id')
                  ->havingRaw('ROUND(AVG(rating)) = ?', [$rating]);
            });
        }

        switch ($sort) {
            case 'most_reviewed':
                $query->orderByDesc('reviews_count');
                break;
            case 'highest_rated':
                $query->withAvg('reviews', 'rating')
                      ->orderByDesc('reviews_avg_rating');
                break;
            case 'most_viewed':
                $query->orderByDesc('view_count');
                break;
            case 'featured':
                $query->where('is_featured', true)
                      ->orderByDesc('created_at');
                break;
            default:
                $query->latest();
        }

        $topics = $query->paginate(12)->withQueryString();

        return view('topics.index', compact('topics', 'search', 'category', 'sort'));
    }

    public function create() { return view('topics.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'status' => ['required', 'string', 'in:draft,published,archived'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')?->store('topics', 'public');

        $topic = Topic::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'status' => $validated['status'],
            'image' => $path,
        ]);

        return redirect()->route('topics.show', $topic)->with('status', 'Topic created successfully.');
    }

    public function show(Topic $topic)
    {
        $topic->increment('view_count');
        $topic->load(['user', 'reviews.user', 'reviews.comments.user']);
        $averageRating = $topic->averageRating();
        return view('topics.show', compact('topic', 'averageRating'));
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'status' => ['required', 'string', 'in:draft,published,archived'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($topic->image) Storage::disk('public')->delete($topic->image);
            $topic->image = $request->file('image')->store('topics', 'public');
        }

        $topic->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('topics.show', $topic)->with('status', 'Topic updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        if ($topic->image) Storage::disk('public')->delete($topic->image);
        $topic->delete();

        return redirect()->route('topics.index')->with('status', 'Topic deleted successfully.');
    }
}
