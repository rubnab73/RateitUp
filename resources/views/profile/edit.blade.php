<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-user-circle text-indigo-500 mr-3"></i>Profile Settings
                </h2>
                <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-lg font-medium">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Overview Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ Auth::user()->email }}</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-1"></i>
                                Joined {{ Auth::user()->created_at->format('M Y') }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-comments mr-1"></i>
                                {{ Auth::user()->topics()->count() }} topics
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-star mr-1"></i>
                                {{ Auth::user()->reviews()->count() }} reviews
                            </span>
                        </div>
                    </div>
                    @if(Auth::user()->is_admin)
                        <div class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                            <i class="fas fa-shield-alt mr-1"></i>Admin
                        </div>
                    @endif
                </div>
            </div>

            <!-- Settings Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Navigation -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings</h3>
                        <nav class="space-y-2">
                            <a href="#profile-info" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg">
                                <i class="fas fa-user mr-3"></i>
                                Profile Information
                            </a>
                            <a href="#password" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
                                <i class="fas fa-lock mr-3"></i>
                                Password
                            </a>
                            <a href="#danger-zone" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
                                <i class="fas fa-exclamation-triangle mr-3"></i>
                                Danger Zone
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Profile Information -->
                    <div id="profile-info" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-user text-indigo-500 mr-2"></i>Profile Information
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Update your account's profile information and email address.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Update -->
                    <div id="password" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-lock text-green-500 mr-2"></i>Update Password
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div id="danger-zone" class="bg-white rounded-2xl shadow-sm border border-red-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-red-200 bg-red-50">
                            <h3 class="text-lg font-semibold text-red-900 flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>Danger Zone
                            </h3>
                            <p class="text-sm text-red-700 mt-1">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
