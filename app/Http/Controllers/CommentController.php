<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $reviewId = $request->query('review_id');
        $review = Review::with('topic')->findOrFail($reviewId);
        return view('comments.create', compact('review'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'review_id' => ['required', 'exists:reviews,id'],
            'comment_text' => ['required', 'string'],
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'review_id' => $validated['review_id'],
            'comment_text' => $validated['comment_text'],
        ]);

        return redirect()->route('reviews.show', $comment->review_id)->with('status', 'Comment added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'review.topic']);
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        abort_unless(Auth::id() === $comment->user_id, 403);
        $comment->load('review.topic');
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        abort_unless(Auth::id() === $comment->user_id, 403);
        $validated = $request->validate([
            'comment_text' => ['required', 'string'],
        ]);
        $comment->update($validated);
        return redirect()->route('comments.show', $comment)->with('status', 'Comment updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        abort_unless(Auth::id() === $comment->user_id, 403);
        $reviewId = $comment->review_id;
        $comment->delete();
        return redirect()->route('reviews.show', $reviewId)->with('status', 'Comment deleted.');
    }
}
