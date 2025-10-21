<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="mb-0">{{ $stats['users'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Topics</h5>
                            <h2 class="mb-0">{{ $stats['topics'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Reviews</h5>
                            <h2 class="mb-0">{{ $stats['reviews'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Comments</h5>
                            <h2 class="mb-0">{{ $stats['comments'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">Manage Users</a>
                                <a href="{{ route('admin.topics') }}" class="btn btn-outline-success">Manage Topics</a>
                                <a href="{{ route('admin.reviews') }}" class="btn btn-outline-warning">Manage Reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Latest activity will be shown here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Latest Users</h5>
                        </div>
                        <div class="card-body">
                            @forelse($latestUsers as $user)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ $user->name }}</span>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            @empty
                                <p class="text-muted">No users yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Latest Topics</h5>
                        </div>
                        <div class="card-body">
                            @forelse($latestTopics as $topic)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ Str::limit($topic->title, 20) }}</span>
                                    <small class="text-muted">{{ $topic->created_at->diffForHumans() }}</small>
                                </div>
                            @empty
                                <p class="text-muted">No topics yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Latest Reviews</h5>
                        </div>
                        <div class="card-body">
                            @forelse($latestReviews as $review)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ Str::limit($review->review_text, 20) }}</span>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            @empty
                                <p class="text-muted">No reviews yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>