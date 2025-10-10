<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('topics.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $topicId = $request->query('topic_id');
        $topic = Topic::findOrFail($topicId);
        return view('reviews.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic_id' => ['required', 'exists:topics,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string'],
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'topic_id' => $validated['topic_id'],
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
        ]);

        return redirect()->route('topics.show', $review->topic_id)->with('status', 'Review posted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'topic', 'comments.user']);
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        abort_unless(Auth::id() === $review->user_id, 403);
        $review->load('topic');
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        abort_unless(Auth::id() === $review->user_id, 403);
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string'],
        ]);
        $review->update($validated);
        return redirect()->route('reviews.show', $review)->with('status', 'Review updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        abort_unless(Auth::id() === $review->user_id, 403);
        $topicId = $review->topic_id;
        $review->delete();
        return redirect()->route('topics.show', $topicId)->with('status', 'Review deleted.');
    }
}
