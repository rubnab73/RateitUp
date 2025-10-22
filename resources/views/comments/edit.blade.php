<x-app-layout>
    <x-slot name="header">
    <h2 class="font-bold text-2xl sm:text-3xl text-black dark:text-white leading-tight">Edit Comment</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <form method="POST" action="{{ route('comments.update', $comment) }}" class="card p-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment_text" rows="4" class="form-control" required>{{ old('comment_text', $comment->comment_text) }}</textarea>
                    @error('comment_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-secondary" href="{{ route('reviews.show', $comment->review_id) }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


