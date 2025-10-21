<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $tags = Tag::withCount('topics')->orderByDesc('topics_count')->paginate(20);
        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $topics = $tag->topics()->with('user')->latest()->paginate(12);
        return view('tags.show', compact('tag', 'topics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'description' => 'nullable|string',
        ]);

        $tag = Tag::create($validated);

        if ($request->has('topic_id')) {
            $topic = Topic::findOrFail($request->topic_id);
            $topic->tags()->attach($tag->id);
            return back()->with('status', 'Tag added successfully.');
        }

        return redirect()->route('tags.show', $tag)->with('status', 'Tag created successfully.');
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'description' => 'nullable|string',
        ]);

        $tag->update($validated);

        return redirect()->route('tags.show', $tag)->with('status', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('status', 'Tag deleted successfully.');
    }
}