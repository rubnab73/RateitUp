<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4 p-6 bg-white rounded-2xl shadow-lg border border-gray-200 w-full">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-user-circle text-indigo-500"></i> Profile Settings
                </h2>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Manage your account information and preferences.</p>
            </div>
            <div class="flex items-center gap-4">
                <!-- Header Avatar -->
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-[#4546e5] rounded-full flex items-center justify-center text-black text-3xl sm:text-4xl font-bold shadow-xl">
    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
</div>
                <div class="text-right">
                    <div class="text-sm sm:text-base font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs sm:text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen w-full">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-12 space-y-10">

            <!-- Profile Overview Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10 lg:p-12 w-full flex flex-col sm:flex-row items-center sm:items-start sm:space-x-10 text-center sm:text-left">
                <!-- Avatar -->
                <div class="w-36 h-36 sm:w-40 sm:h-40 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-6xl sm:text-7xl font-bold shadow-2xl">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="mt-6 sm:mt-0 flex-1">
                    <h3 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-2">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600 mb-5 text-base sm:text-lg">{{ Auth::user()->email }}</p>
                    <div class="flex flex-wrap gap-x-10 gap-y-3 text-base text-gray-500">
                        <span class="flex items-center gap-2"><i class="fas fa-calendar"></i> Joined {{ Auth::user()->created_at->format('M Y') }}</span>
                        <span class="flex items-center gap-2"><i class="fas fa-comments"></i> {{ Auth::user()->topics()->count() }} topics</span>
                        <span class="flex items-center gap-2"><i class="fas fa-star"></i> {{ Auth::user()->reviews()->count() }} reviews</span>
                    </div>
                </div>
                @if(Auth::user()->is_admin)
                    <div class="mt-6 sm:mt-0 px-6 py-3 bg-red-100 text-red-700 rounded-full text-base font-medium flex items-center gap-2 shadow">
                        <i class="fas fa-shield-alt"></i> Admin
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-10">
                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8 sticky top-6 hover:shadow-2xl transition-all">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-6">Settings</h3>
                        <nav class="space-y-4">
                            <a href="#profile-info" class="flex items-center px-5 py-4 text-base font-medium text-indigo-600 bg-indigo-50 rounded-2xl hover:bg-indigo-100 transition-all">
                                <i class="fas fa-user mr-3 text-indigo-500"></i> Profile Information
                            </a>
                            <a href="#password" class="flex items-center px-5 py-4 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-2xl transition-all">
                                <i class="fas fa-lock mr-3 text-gray-500"></i> Password
                            </a>
                            <a href="#danger-zone" class="flex items-center px-5 py-4 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-2xl transition-all">
                                <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i> Danger Zone
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Content -->
                <main class="lg:col-span-1 space-y-10">
                    <section id="profile-info" class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all p-8 sm:p-10 lg:p-12">
                        <header class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="text-2xl sm:text-3xl font-semibold text-gray-900 flex items-center gap-3">
                                <i class="fas fa-user text-indigo-500"></i> Profile Information
                            </h3>
                            <p class="text-base sm:text-lg text-gray-600 mt-2">Update your name, email, and other details.</p>
                        </header>
                        @include('profile.partials.update-profile-information-form')
                    </section>

                    <section id="password" class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all p-8 sm:p-10 lg:p-12">
                        <header class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="text-2xl sm:text-3xl font-semibold text-gray-900 flex items-center gap-3">
                                <i class="fas fa-lock text-green-500"></i> Update Password
                            </h3>
                            <p class="text-base sm:text-lg text-gray-600 mt-2">Keep your account secure with a strong password.</p>
                        </header>
                        @include('profile.partials.update-password-form')
                    </section>

                    <section id="danger-zone" class="bg-white rounded-3xl shadow-xl border border-red-200 overflow-hidden hover:shadow-2xl transition-all p-8 sm:p-10 lg:p-12">
                        <header class="border-b border-red-200 pb-4 mb-4">
                            <h3 class="text-2xl sm:text-3xl font-semibold text-red-900 flex items-center gap-3">
                                <i class="fas fa-exclamation-triangle text-red-500"></i> Danger Zone
                            </h3>
                            <p class="text-base sm:text-lg text-red-700 mt-2">Deleting your account is permanent. Proceed carefully.</p>
                        </header>
                        @include('profile.partials.delete-user-form')
                    </section>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
