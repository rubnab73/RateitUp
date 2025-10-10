<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Review on {{ $review->topic->title }}</h2>
            <div class="d-flex gap-2">
                @auth
                    @if(auth()->id() === $review->user_id)
                        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('reviews.destroy', $review) }}" onsubmit="return confirm('Delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>{{ $review->user->name }}</strong>
                            <span class="badge text-bg-warning">Rating: {{ $review->rating }}/5</span>
                        </div>
                        <a class="small" href="{{ route('topics.show', $review->topic) }}">Back to Topic</a>
                    </div>
                    <p class="mb-0 mt-2">{{ $review->review_text }}</p>
                </div>
            </div>

            <h5 class="mb-3">Comments</h5>
            @auth
            <form method="POST" action="{{ route('comments.store') }}" class="card p-3 mb-3">
                @csrf
                <input type="hidden" name="review_id" value="{{ $review->id }}">
                <div class="mb-2">
                    <textarea name="comment_text" class="form-control" rows="3" placeholder="Write a comment..." required>{{ old('comment_text') }}</textarea>
                    @error('comment_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div>
                    <button class="btn btn-primary btn-sm">Comment</button>
                </div>
            </form>
            @endauth

            @forelse($review->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <div>{{ $comment->comment_text }}</div>
                        </div>
                        @auth
                            @if(auth()->id() === $comment->user_id)
                                <div class="d-flex gap-2">
                                    <a href="{{ route('comments.edit', $comment) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" onsubmit="return confirm('Delete comment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No comments yet.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>


