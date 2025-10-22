<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side - Logo -->
            <div class="flex items-center">
    <a href="{{ route('home') }}" class="flex items-center space-x-3">
        <div class="w-10 h-10 flex items-center justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="RateItUp Logo" class="w-10 h-10 object-contain">
        </div>
        <span class="text-xl font-bold text-gray-900">RateItUp</span>
    </a>
</div>

            <!-- Right Side - Navigation and User Actions -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Navigation Links -->
                    <div class="hidden sm:flex items-center space-x-2">
                        <a href="{{ route('dashboard') }}" 
                           class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('topics.index') }}" 
                           class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Topics
                        </a>
                        <a href="{{ route('tags.index') }}" 
                           class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Tags
                        </a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-3 py-2 text-sm font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors">
                                Admin
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" 
                           class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Profile
                        </a>
                    </div>

                    <!-- Notification Bell -->
                    <x-notification-bell />

                    <!-- Simple Sign Out -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Sign Out
                        </button>
                    </form>
                @else
                    <!-- Guest Links -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" 
                           class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            Get Started
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="sm:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="sm:hidden">
        @auth
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                <a href="{{ route('dashboard') }}" 
                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    Dashboard
                </a>
                <a href="{{ route('topics.index') }}" 
                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    Topics
                </a>
                <a href="{{ route('tags.index') }}" 
                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    Tags
                </a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-3 py-2 text-base font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg">
                        Admin
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" 
                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="block w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg">
                        Sign Out
                    </button>
                </form>
            </div>
        @else
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                <a href="{{ route('login') }}" 
                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    Sign In
                </a>
                <a href="{{ route('register') }}" 
                   class="block px-3 py-2 text-base font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Get Started
                </a>
            </div>
        @endauth
    </div>
</nav>
