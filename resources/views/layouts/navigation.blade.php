<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-gray-200/50 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">RateItUp</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:flex sm:ml-10">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('topics.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('topics.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fas fa-comments mr-2"></i>Topics
                    </a>
                    <a href="{{ route('tags.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('tags.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fas fa-tags mr-2"></i>Tags
                    </a>
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-red-100 text-red-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                                <i class="fas fa-shield-alt mr-2"></i>Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Search Bar -->
                    <div class="hidden md:block">
                        <div class="relative">
                            <input type="text" placeholder="Search topics..." 
                                   class="w-64 pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Bell -->
                    <x-notification-bell />

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-user mr-3 text-gray-400"></i>
                                Profile Settings
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
                                Dashboard
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-sm">
                            Get Started
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
            </a>
            <a href="{{ route('topics.index') }}" 
               class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('topics.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <i class="fas fa-comments mr-2"></i>Topics
            </a>
            <a href="{{ route('tags.index') }}" 
               class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('tags.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <i class="fas fa-tags mr-2"></i>Tags
            </a>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.*') ? 'bg-red-100 text-red-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fas fa-shield-alt mr-2"></i>Admin
                    </a>
                @endif
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-medium">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-user mr-2"></i>Profile Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" 
                       class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block px-4 py-2 text-base font-medium bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700">
                        Get Started
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
