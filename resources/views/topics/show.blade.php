<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="fw-bold text-primary mb-0">{{ $topic->title }}</h2>
            <div class="d-flex gap-2 flex-wrap">
                @auth
                    @if(auth()->id() === $topic->user_id)
                        <a href="{{ route('topics.edit', $topic) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('topics.destroy', $topic) }}" onsubmit="return confirm('Delete this topic?')">
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
                <div class="alert alert-success shadow-sm">{{ session('status') }}</div>
            @endif

            <div class="row g-4">
                <!-- Left Column: Image & Info -->
                <div class="col-lg-4">
                    @if($topic->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$topic->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $topic->title }}">
                        </div>
                    @endif
                    <div class="p-3 bg-light rounded shadow-sm">
                        <p class="mb-2"><strong>Category:</strong> <span class="text-secondary">{{ ucfirst($topic->category) }}</span></p>
                        <p class="mb-2"><strong>By:</strong> <span class="text-secondary">{{ $topic->user->name }}</span></p>
                        <p class="mb-2"><strong>Average Rating:</strong> <span class="badge bg-warning text-dark">{{ number_format($averageRating,2) }}/5</span></p>
                        <p class="mb-0"><strong>Total Reviews:</strong> <span class="text-secondary">{{ $topic->reviews->count() }}</span></p>
                    </div>
                </div>

                <!-- Right Column: Description & Reviews -->
                <div class="col-lg-8">
                    <div class="mb-4 p-3 bg-white rounded shadow-sm">
                        <p class="mb-0">{{ $topic->description }}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="fw-semibold mb-0">Reviews</h4>
                        @auth
                            <a href="{{ route('reviews.create', ['topic_id'=>$topic->id]) }}" class="btn btn-primary btn-sm">Write Review</a>
                        @endauth
                    </div>

                    @forelse($topic->reviews as $review)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <div>
                                        <strong class="text-primary">{{ $review->user->name }}</strong>
                                        <span class="badge bg-warning text-dark ms-2">Rating: {{ $review->rating }}/5</span>
                                    </div>
                                    <a href="{{ route('reviews.show', $review) }}" class="small text-decoration-none">Open</a>
                                </div>
                                <p class="mt-2 mb-0">{{ $review->review_text }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info shadow-sm">No reviews yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
