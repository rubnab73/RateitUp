<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications') }}
            </h2>
            <div class="flex space-x-2">
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <x-secondary-button type="submit">
                        {{ __('Mark All as Read') }}
                    </x-secondary-button>
                </form>
                <form action="{{ route('notifications.clearAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit" onclick="return confirm('Are you sure you want to clear all notifications?')">
                        {{ __('Clear All') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($notifications->isEmpty())
                        <p class="text-gray-500 text-center py-6">{{ __('No notifications yet.') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-center justify-between p-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }} border rounded-lg">
                                    <div class="flex-1">
                                        @if($notification->type === 'App\\Notifications\\NewReviewNotification')
                                            <p class="font-medium">
                                                {{ $notification->data['reviewer_name'] }} left a {{ $notification->data['rating'] }}-star review on
                                                <a href="{{ route('topics.show', $notification->data['topic_id']) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $notification->data['topic_title'] }}
                                                </a>
                                            </p>
                                        @elseif($notification->type === 'App\\Notifications\\NewCommentNotification')
                                            <p class="font-medium">
                                                {{ $notification->data['commenter_name'] }} commented on your review for
                                                <a href="{{ route('topics.show', $notification->data['topic_id']) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $notification->data['topic_title'] }}
                                                </a>
                                            </p>
                                        @elseif($notification->type === 'App\\Notifications\\NewFollowerNotification')
                                            <p class="font-medium">
                                                <a href="{{ route('profile.show', $notification->data['follower_id']) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $notification->data['follower_name'] }}
                                                </a>
                                                is now following you
                                            </p>
                                        @endif
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    
                                    <div class="flex items-center space-x-2">
                                        @unless($notification->read_at)
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <x-secondary-button type="submit">
                                                    {{ __('Mark as Read') }}
                                                </x-secondary-button>
                                            </form>
                                        @endunless

                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>