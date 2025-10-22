<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-shield-alt text-red-500 mr-3"></i>Admin Dashboard
                </h2>
                <p class="text-gray-600 mt-1">Manage your platform and monitor activity</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <div class="text-sm text-gray-500">Last updated</div>
                    <div class="text-sm font-medium text-gray-900">{{ now()->format('M j, Y g:i A') }}</div>
                </div>
                <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <i class="fas fa-sync-alt text-gray-600"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-green-800 font-medium">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Users Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['users'] }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+12% from last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Topics Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Topics</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['topics'] }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+8% from last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-comments text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Reviews Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Reviews</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['reviews'] }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+15% from last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-star text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Comments Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Comments</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['comments'] }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+22% from last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-comment text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('admin.users') }}" 
                               class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 group">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Manage Users</div>
                                    <div class="text-sm text-gray-600">View and manage user accounts</div>
                                </div>
                                <i class="fas fa-arrow-right text-gray-400 ml-auto group-hover:text-blue-500 transition-colors duration-200"></i>
                            </a>
                            
                            <a href="{{ route('admin.topics') }}" 
                               class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 group">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                                    <i class="fas fa-comments text-white"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Manage Topics</div>
                                    <div class="text-sm text-gray-600">Moderate and organize topics</div>
                                </div>
                                <i class="fas fa-arrow-right text-gray-400 ml-auto group-hover:text-green-500 transition-colors duration-200"></i>
                            </a>
                            
                            <a href="{{ route('admin.reviews') }}" 
                               class="flex items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-xl transition-all duration-200 group">
                                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-200">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Manage Reviews</div>
                                    <div class="text-sm text-gray-600">Review and moderate content</div>
                                </div>
                                <i class="fas fa-arrow-right text-gray-400 ml-auto group-hover:text-yellow-500 transition-colors duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-line text-green-500 mr-2"></i>System Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">Database</span>
                                </div>
                                <span class="text-sm text-green-600 font-medium">Online</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">Cache</span>
                                </div>
                                <span class="text-sm text-green-600 font-medium">Active</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">Email Service</span>
                                </div>
                                <span class="text-sm text-green-600 font-medium">Running</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">Backup</span>
                                </div>
                                <span class="text-sm text-yellow-600 font-medium">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Latest Users -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user-plus text-blue-500 mr-2"></i>Latest Users
                        </h3>
                    </div>
                    <div class="p-6">
                        @forelse($latestUsers as $user)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-users text-gray-300 text-3xl mb-2"></i>
                                <p class="text-gray-500">No users yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Latest Topics -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-comments text-green-500 mr-2"></i>Latest Topics
                        </h3>
                    </div>
                    <div class="p-6">
                        @forelse($latestTopics as $topic)
                            <div class="py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900 mb-1">{{ Str::limit($topic->title, 30) }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($topic->content, 50) }}</div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">{{ $topic->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-comments text-gray-300 text-3xl mb-2"></i>
                                <p class="text-gray-500">No topics yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Latest Reviews -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>Latest Reviews
                        </h3>
                    </div>
                    <div class="p-6">
                        @forelse($latestReviews as $review)
                            <div class="py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-1">
                                            <div class="flex text-yellow-400 mr-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $review->rating }}/5</span>
                                        </div>
                                        <div class="text-sm text-gray-600">{{ Str::limit($review->review_text, 40) }}</div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-star text-gray-300 text-3xl mb-2"></i>
                                <p class="text-gray-500">No reviews yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>