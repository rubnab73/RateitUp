<x-app-layout>
    <x-slot name="header">
    <h2 class="font-bold text-2xl sm:text-3xl text-black dark:text-white leading-tight">Edit Review</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <form method="POST" action="{{ route('reviews.update', $review) }}" class="card p-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-select" required>
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}" @selected(old('rating', $review->rating)==$i)>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('rating')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Review</label>
                    <textarea name="review_text" rows="5" class="form-control" required>{{ old('review_text', $review->review_text) }}</textarea>
                    @error('review_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-secondary" href="{{ route('reviews.show', $review) }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


