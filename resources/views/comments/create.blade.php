<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Comment on Review</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>{{ $review->user->name }}</strong>
                            <span class="badge text-bg-warning">Rating: {{ $review->rating }}/5</span>
                        </div>
                        <a class="small" href="{{ route('reviews.show', $review) }}">Back</a>
                    </div>
                    <p class="mb-0 mt-2">{{ $review->review_text }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('comments.store') }}" class="card p-3">
                @csrf
                <input type="hidden" name="review_id" value="{{ $review->id }}">
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment_text" rows="4" class="form-control" required>{{ old('comment_text') }}</textarea>
                    @error('comment_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Post</button>
                    <a class="btn btn-secondary" href="{{ route('reviews.show', $review) }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


