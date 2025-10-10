<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
    </x-slot>
    
    <div class="py-6">
        <div class="container">
            <div class="row g-4">
                <!-- Your Topics Card -->
                <div class="col-md-4">
                    <div class="card h-100" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'">
                        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); padding: 1.5rem;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1" style="color: white; font-weight: 700; font-size: 1.25rem;">Your Topics</h5>
                                    <p style="color: rgba(255,255,255,0.8); font-size: 0.875rem; margin: 0;">Create and manage your topics</p>
                                </div>
                                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                            </div>
                            <a 
                                href="{{ route('topics.create') }}" 
                                class="btn btn-sm btn-light mt-3"
                                style="border-radius: 8px; font-weight: 600; padding: 0.5rem 1rem; border: none; transition: all 0.2s;"
                                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)'"
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'"
                            >
                                + Create Topic
                            </a>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            @forelse(auth()->user()->topics()->latest()->limit(5)->get() as $t)
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 1rem 1.5rem; border: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <a href="{{ route('topics.show', $t) }}" style="color: #374151; font-weight: 500; text-decoration: none; flex: 1; transition: color 0.2s;" onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#374151'">
                                        {{ $t->title }}
                                    </a>
                                    <span class="badge" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 11px;">
                                        💬 {{ $t->reviews()->count() }}
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-center" style="padding: 2rem; color: #9ca3af; border: none;">
                                    <svg style="width: 48px; height: 48px; color: #d1d5db; margin: 0 auto 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p style="margin: 0; font-size: 0.875rem;">No topics yet</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Your Reviews Card -->
                <div class="col-md-4">
                    <div class="card h-100" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'">
                        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 1.5rem;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1" style="color: white; font-weight: 700; font-size: 1.25rem;">Your Reviews</h5>
                                    <p style="color: rgba(255,255,255,0.8); font-size: 0.875rem; margin: 0;">Latest reviews you've written</p>
                                </div>
                                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 24px; height: 24px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            @forelse(auth()->user()->reviews()->latest()->limit(5)->get() as $r)
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 1rem 1.5rem; border: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <a href="{{ route('reviews.show', $r) }}" style="color: #374151; font-weight: 500; text-decoration: none; flex: 1; transition: color 0.2s;" onmouseover="this.style.color='#f59e0b'" onmouseout="this.style.color='#374151'">
                                        {{ \Illuminate\Support\Str::limit($r->review_text, 40) }}
                                    </a>
                                    <span class="badge" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 11px;">
                                        ⭐ {{ $r->rating }}/5
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-center" style="padding: 2rem; color: #9ca3af; border: none;">
                                    <svg style="width: 48px; height: 48px; color: #d1d5db; margin: 0 auto 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    <p style="margin: 0; font-size: 0.875rem;">No reviews yet</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Your Comments Card -->
                <div class="col-md-4">
                    <div class="card h-100" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)'">
                        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 1.5rem;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1" style="color: white; font-weight: 700; font-size: 1.25rem;">Your Comments</h5>
                                    <p style="color: rgba(255,255,255,0.8); font-size: 0.875rem; margin: 0;">Recent comments you've made</p>
                                </div>
                                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 24px; height: 24px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            @forelse(auth()->user()->comments()->latest()->limit(5)->get() as $c)
                                <li class="list-group-item" style="padding: 1rem 1.5rem; border: none; border-bottom: 1px solid #f3f4f6; color: #374151; line-height: 1.5; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <div style="display: flex; align-items: start; gap: 0.75rem;">
                                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; margin-top: 0.5rem; flex-shrink: 0;"></div>
                                        <span style="font-weight: 400; font-size: 0.9rem;">{{ \Illuminate\Support\Str::limit($c->comment_text, 60) }}</span>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center" style="padding: 2rem; color: #9ca3af; border: none;">
                                    <svg style="width: 48px; height: 48px; color: #d1d5db; margin: 0 auto 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p style="margin: 0; font-size: 0.875rem;">No comments yet</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>