<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-tachometer-alt text-indigo-500 mr-3"></i>Dashboard
                </h2>
                <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's what's happening on your platform.</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <div class="text-sm text-gray-500">Last activity</div>
                    <div class="text-sm font-medium text-gray-900">{{ now()->format('M j, Y') }}</div>
                </div>
                <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <i class="fas fa-sync-alt text-gray-600"></i>
                </button>
            </div>
        </div>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Your Topics</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->topics()->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-comments text-white text-lg"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Your Reviews</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->reviews()->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-star text-white text-lg"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Your Comments</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->comments()->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-comment text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Your Topics Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Your Topics</h3>
                                <p class="text-indigo-100 text-sm">Create and manage your topics</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-comments text-white text-lg"></i>
                            </div>
                        </div>
                        <a href="{{ route('topics.create') }}" 
                           class="inline-flex items-center px-4 py-2 mt-4 bg-white text-indigo-600 text-sm font-medium rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Create Topic
                        </a>
                    </div>
                    
                    <div class="p-6">
                        @forelse(auth()->user()->topics()->latest()->limit(5)->get() as $topic)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex-1">
                                    <a href="{{ route('topics.show', $topic) }}" 
                                       class="font-medium text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                                        {{ Str::limit($topic->title, 30) }}
                                    </a>
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($topic->content, 50) }}</p>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    <span class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-full">
                                        <i class="fas fa-comments mr-1"></i>
                                        {{ $topic->reviews()->count() }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $topic->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-comments text-gray-400 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900 mb-1">No topics yet</h4>
                                <p class="text-sm text-gray-500 mb-4">Start by creating your first topic</p>
                                <a href="{{ route('topics.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create Topic
                                </a>
                            </div>
                        @endforelse
                        
                        @if(auth()->user()->topics()->count() > 5)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('topics.index') }}" 
                                   class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                    View all topics <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Your Reviews Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
                    <div class="bg-gradient-to-br from-yellow-500 to-orange-500 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Your Reviews</h3>
                                <p class="text-yellow-100 text-sm">Latest reviews you've written</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-star text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @forelse(auth()->user()->reviews()->latest()->limit(5)->get() as $review)
                            <div class="py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <div class="flex text-yellow-400 mr-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }} text-xs"></i>
                                                @endfor
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $review->rating }}/5</span>
                                        </div>
                                        <a href="{{ route('reviews.show', $review) }}" 
                                           class="text-sm text-gray-600 hover:text-yellow-600 transition-colors duration-200">
                                            {{ Str::limit($review->review_text, 50) }}
                                        </a>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-star text-gray-400 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900 mb-1">No reviews yet</h4>
                                <p class="text-sm text-gray-500">Start reviewing topics you're interested in</p>
                            </div>
                        @endforelse
                        
                        @if(auth()->user()->reviews()->count() > 5)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('reviews.index') }}" 
                                   class="text-sm text-yellow-600 hover:text-yellow-700 font-medium">
                                    View all reviews <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Your Comments Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Your Comments</h3>
                                <p class="text-green-100 text-sm">Recent comments you've made</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-comment text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @forelse(auth()->user()->comments()->latest()->limit(5)->get() as $comment)
                            <div class="py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600">{{ Str::limit($comment->comment_text, 60) }}</p>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-comment text-gray-400 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900 mb-1">No comments yet</h4>
                                <p class="text-sm text-gray-500">Join the conversation by commenting on topics</p>
                            </div>
                        @endforelse
                        
                        @if(auth()->user()->comments()->count() > 5)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('comments.index') }}" 
                                   class="text-sm text-green-600 hover:text-green-700 font-medium">
                                    View all comments <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('topics.create') }}" 
                       class="flex items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-all duration-200 group">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Create Topic</div>
                            <div class="text-sm text-gray-600">Start a new discussion</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('topics.index') }}" 
                       class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 group">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Browse Topics</div>
                            <div class="text-sm text-gray-600">Explore all topics</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-all duration-200 group">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Edit Profile</div>
                            <div class="text-sm text-gray-600">Update your information</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>