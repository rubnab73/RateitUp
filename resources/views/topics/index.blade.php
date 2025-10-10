<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Topics</h2>
    </x-slot>
    
    <div class="py-6">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success mb-4" style="border-left: 4px solid #10b981; background: linear-gradient(to right, #d1fae5, #ecfdf5); border-radius: 12px; animation: slideDown 0.3s ease-out;">
                    <strong>✓</strong> {{ session('status') }}
                </div>
            @endif
            
            <div class="d-flex justify-content-between align-items-center mb-4 gap-2" style="background: white; padding: 1.5rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <form class="d-flex gap-2 flex-grow-1" method="GET" action="{{ route('topics.index') }}">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control" 
                        placeholder="Search by title or category"
                        style="border-radius: 12px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                    >
                    <select 
                        name="sort" 
                        class="form-select"
                        style="border-radius: 12px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem; min-width: 180px; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                    >
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>🆕 Newest</option>
                        <option value="most_reviewed" {{ request('sort') === 'most_reviewed' ? 'selected' : '' }}>💬 Most Reviewed</option>
                        <option value="highest_rated" {{ request('sort') === 'highest_rated' ? 'selected' : '' }}>⭐ Highest Rated</option>
                    </select>
                    <button 
                        class="btn btn-primary"
                        style="border-radius: 12px; padding: 0.75rem 2rem; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border: none; font-weight: 600; transition: all 0.2s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px -4px rgba(99,102,241,0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
                    >
                        Search
                    </button>
                </form>
                @auth
                    <a 
                        href="{{ route('topics.create') }}" 
                        class="btn btn-success"
                        style="border-radius: 12px; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-weight: 600; white-space: nowrap; transition: all 0.2s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px -4px rgba(16,185,129,0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
                    >
                        + New Topic
                    </a>
                @endauth
            </div>
            
            <div class="row g-4">
                @forelse($topics as $topic)
                    <div class="col-md-4">
                        <div class="card h-100" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'">
                            @if($topic->image)
                                <div style="height: 200px; overflow: hidden; position: relative;">
                                    <img 
                                        src="{{ asset('storage/'.$topic->image) }}" 
                                        class="card-img-top" 
                                        alt="{{ $topic->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'"
                                    >
                                    <div style="position: absolute; top: 12px; left: 12px;">
                                        <span style="background: white; padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.2);">
                                            {{ ucfirst($topic->category) }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                                    <svg style="width: 80px; height: 80px; color: rgba(255,255,255,0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                    <div style="position: absolute; top: 12px; left: 12px;">
                                        <span style="background: white; padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ ucfirst($topic->category) }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                                <h5 class="card-title mb-2" style="font-weight: 700; font-size: 1.25rem; color: #1f2937;">
                                    {{ $topic->title }}
                                </h5>
                                <p class="card-text flex-grow-1" style="color: #6b7280; line-height: 1.6; margin-bottom: 1rem;">
                                    {{ \Illuminate\Support\Str::limit($topic->description, 120) }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                                    <span class="badge" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); padding: 8px 14px; border-radius: 10px; font-weight: 600; font-size: 13px;">
                                        ⭐ {{ number_format($topic->averageRating(), 1) }}
                                    </span>
                                    <span class="badge" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); padding: 8px 14px; border-radius: 10px; font-weight: 600; font-size: 13px;">
                                        💬 {{ $topic->reviews_count }} reviews
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-footer" style="background: transparent; border: none; padding: 0 1.5rem 1.5rem;">
                                <a 
                                    href="{{ route('topics.show', $topic) }}" 
                                    class="btn btn-outline-primary w-100"
                                    style="border-radius: 12px; padding: 0.75rem; font-weight: 600; border: 2px solid #6366f1; color: #6366f1; background: white; transition: all 0.2s;"
                                    onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.transform='scale(1.02)'"
                                    onmouseout="this.style.background='white'; this.style.color='#6366f1'; this.style.transform='scale(1)'"
                                >
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info" style="border-radius: 16px; border: none; background: linear-gradient(to right, #dbeafe, #eff6ff); padding: 3rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                            <svg style="width: 64px; height: 64px; color: #3b82f6; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <h4 style="color: #1e40af; font-weight: 700; margin-bottom: 0.5rem;">No topics found</h4>
                            <p style="color: #3b82f6; margin: 0;">Try adjusting your search or filters to find what you're looking for.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                {{ $topics->links() }}
            </div>
        </div>
    </div>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-img-top {
            transition: transform 0.5s ease;
        }
        
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
    </style>
</x-app-layout>