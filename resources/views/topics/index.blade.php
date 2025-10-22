<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            Explore Topics
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success mb-4" style="border-left: 4px solid #10b981; background: linear-gradient(to right, #d1fae5, #ecfdf5); border-radius: 16px; padding: 1rem 1.5rem; animation: slideDown 0.3s ease-out; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);">
                    <div class="d-flex align-items-center gap-2">
                        <svg style="width: 20px; height: 20px; color: #10b981;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <strong style="color: #065f46;">{{ session('status') }}</strong>
                    </div>
                </div>
            @endif
            
            <!-- Search and Filter Section -->
            <div class="mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2.5rem; border-radius: 24px; box-shadow: 0 20px 25px -5px rgba(102, 126, 234, 0.3); position: relative; overflow: hidden;">
                <!-- Decorative Elements -->
                <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; filter: blur(40px);"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; filter: blur(30px);"></div>
                
                <div style="position: relative; z-index: 1;">
                    <div class="text-center mb-4">
                        <h3 style="color: white; font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            Discover Amazing Topics
                        </h3>
                        <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.1rem; margin: 0;">
                            Search, filter, and explore thousands of discussions
                        </p>
                    </div>
                    
                    <form class="d-flex gap-3 flex-wrap justify-content-center" method="GET" action="{{ route('topics.index') }}">
                        <div style="flex: 1; min-width: 300px; max-width: 500px;">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                class="form-control" 
                                placeholder="🔍 Search by title or category..."
                                style="border-radius: 16px; border: none; padding: 1rem 1.5rem; font-size: 1rem; background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;"
                                onfocus="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.2)'"
                                onblur="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'"
                            >
                        </div>
                        <div style="min-width: 200px;">
                            <select 
                                name="sort" 
                                class="form-select"
                                style="border-radius: 16px; border: none; padding: 1rem 1.5rem; font-size: 1rem; background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;"
                                onfocus="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.2)'"
                                onblur="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'"
                            >
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>🆕 Newest First</option>
                                <option value="most_reviewed" {{ request('sort') === 'most_reviewed' ? 'selected' : '' }}>💬 Most Reviewed</option>
                                <option value="highest_rated" {{ request('sort') === 'highest_rated' ? 'selected' : '' }}>⭐ Highest Rated</option>
                            </select>
                        </div>
                        <button 
                            type="submit"
                            class="btn"
                            style="border-radius: 16px; padding: 1rem 2.5rem; background: white; color: #667eea; border: none; font-weight: 700; font-size: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s; white-space: nowrap;"
                            onmouseover="this.style.transform='translateY(-4px) scale(1.05)'; this.style.boxShadow='0 20px 25px -5px rgba(0,0,0,0.2)'"
                            onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'"
                        >
                            Search Now
                        </button>
                        @auth
                            <a 
                                href="{{ route('topics.create') }}" 
                                class="btn"
                                style="border-radius: 16px; padding: 1rem 2rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; font-weight: 700; font-size: 1rem; box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.4); transition: all 0.3s; white-space: nowrap;"
                                onmouseover="this.style.transform='translateY(-4px) scale(1.05)'; this.style.boxShadow='0 20px 25px -5px rgba(245, 158, 11, 0.5)'"
                                onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 6px -1px rgba(245, 158, 11, 0.4)'"
                            >
                                ✨ Create Topic
                            </a>
                        @endauth
                    </form>
                </div>
            </div>
            
            <!-- Topics Grid -->
            <div class="row g-4">
                @forelse($topics as $topic)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.4s; background: white;" onmouseover="this.style.transform='translateY(-12px) rotate(1deg)'; this.style.boxShadow='0 25px 50px -12px rgba(0,0,0,0.25)'" onmouseout="this.style.transform='translateY(0) rotate(0deg)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'">
                            <!-- Image Section -->
                            @if($topic->image)
                                <div style="height: 220px; overflow: hidden; position: relative; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <img 
                                        src="{{ asset('storage/'.$topic->image) }}" 
                                        class="card-img-top" 
                                        alt="{{ $topic->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                        onmouseover="this.style.transform='scale(1.15) rotate(2deg)'"
                                        onmouseout="this.style.transform='scale(1) rotate(0deg)'"
                                    >
                                    <!-- Gradient Overlay -->
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 50%; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);"></div>
                                    <!-- Category Badge -->
                                    <div style="position: absolute; top: 16px; left: 16px;">
                                        <span style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #667eea; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                            {{ ucfirst($topic->category) }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div style="height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                    <!-- Animated Background Pattern -->
                                    <div style="position: absolute; width: 100%; height: 100%; opacity: 0.1;">
                                        <div style="position: absolute; top: 20%; left: 10%; width: 100px; height: 100px; background: white; border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
                                        <div style="position: absolute; top: 60%; right: 15%; width: 80px; height: 80px; background: white; border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
                                    </div>
                                    <svg style="width: 96px; height: 96px; color: rgba(255,255,255,0.4); position: relative; z-index: 1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                    <!-- Category Badge -->
                                    <div style="position: absolute; top: 16px; left: 16px;">
                                        <span style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #667eea; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                            {{ ucfirst($topic->category) }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column" style="padding: 1.75rem;">
                                <h5 class="card-title mb-3" style="font-weight: 800; font-size: 1.35rem; color: #1f2937; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $topic->title }}
                                </h5>
                                <p class="card-text flex-grow-1 mb-4" style="color: #6b7280; line-height: 1.7; font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $topic->description }}
                                </p>
                                
                                <!-- Stats Section -->
                                <div class="d-flex gap-2 mb-4 flex-wrap">
                                    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 10px 16px; border-radius: 12px; flex: 1; min-width: 100px; text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        <div style="font-size: 1.5rem; line-height: 1;">⭐</div>
                                        <div style="font-weight: 800; font-size: 1.1rem; color: #92400e; margin-top: 4px;">{{ number_format($topic->averageRating(), 1) }}</div>
                                        <div style="font-size: 0.7rem; color: #b45309; font-weight: 600; text-transform: uppercase;">Rating</div>
                                    </div>
                                    <div style="background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); padding: 10px 16px; border-radius: 12px; flex: 1; min-width: 100px; text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        <div style="font-size: 1.5rem; line-height: 1;">💬</div>
                                        <div style="font-weight: 800; font-size: 1.1rem; color: #3730a3; margin-top: 4px;">{{ $topic->reviews_count }}</div>
                                        <div style="font-size: 0.7rem; color: #4338ca; font-weight: 600; text-transform: uppercase;">Reviews</div>
                                    </div>
                                </div>
                                
                                <!-- View Button -->
                                <a 
                                    href="{{ route('topics.show', $topic) }}" 
                                    class="btn w-100"
                                    style="border-radius: 14px; padding: 0.875rem; font-weight: 700; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; transition: all 0.3s; position: relative; overflow: hidden;"
                                    onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 12px 24px -6px rgba(102, 126, 234, 0.5)'; this.querySelector('.btn-text').style.transform='translateX(5px)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'; this.querySelector('.btn-text').style.transform='translateX(0)'"
                                >
                                    <span class="btn-text" style="transition: transform 0.3s; display: inline-flex; align-items: center; gap: 8px;">
                                        View Details
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div style="border-radius: 24px; border: none; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 4rem 2rem; text-align: center; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1); position: relative; overflow: hidden;">
                            <!-- Decorative Elements -->
                            <div style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; filter: blur(40px);"></div>
                            <div style="position: absolute; bottom: -20px; left: -20px; width: 120px; height: 120px; background: rgba(147, 197, 253, 0.2); border-radius: 50%; filter: blur(30px);"></div>
                            
                            <div style="position: relative; z-index: 1;">
                                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.3);">
                                    <svg style="width: 64px; height: 64px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <h3 style="color: #1e40af; font-weight: 800; font-size: 2rem; margin-bottom: 1rem;">No Topics Found</h3>
                                <p style="color: #3b82f6; font-size: 1.1rem; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                                    We couldn't find any topics matching your criteria. Try adjusting your search or create a new topic!
                                </p>
                                @auth
                                    <a 
                                        href="{{ route('topics.create') }}" 
                                        class="btn"
                                        style="border-radius: 16px; padding: 1rem 2.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; font-weight: 700; font-size: 1rem; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4); transition: all 0.3s;"
                                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 25px -5px rgba(59, 130, 246, 0.5)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px -3px rgba(59, 130, 246, 0.4)'"
                                    >
                                        Create Your First Topic
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $topics->links() }}
            </div>
        </div>
    </div>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .card {
            will-change: transform;
        }
        
        .card-img-top {
            will-change: transform;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</x-app-layout>