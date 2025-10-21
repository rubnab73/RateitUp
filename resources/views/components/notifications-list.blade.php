@props(['notifications'])

<div class="px-4 py-2 space-y-3 max-h-96 overflow-y-auto">
    @forelse($notifications as $notification)
        <div class="flex items-start space-x-3 {{ $notification->read_at ? 'opacity-75' : 'bg-blue-50' }} p-2 rounded">
            <div class="flex-1">
                @if($notification->type === 'App\Notifications\NewReviewNotification')
                    <a href="{{ route('reviews.show', $notification->data['review_id']) }}" class="block hover:text-blue-600">
                        <strong>{{ $notification->data['reviewer_name'] }}</strong> posted a {{ $notification->data['rating'] }}-star review on <strong>{{ $notification->data['topic_name'] }}</strong>
                    </a>
                @elseif($notification->type === 'App\Notifications\NewCommentNotification')
                    <a href="{{ route('reviews.show', $notification->data['review_id']) }}" class="block hover:text-blue-600">
                        <strong>{{ $notification->data['commenter_name'] }}</strong> commented on your review of <strong>{{ $notification->data['topic_name'] }}</strong>
                    </a>
                @elseif($notification->type === 'App\Notifications\ReviewModerationNotification')
                    <a href="{{ route('reviews.show', $notification->data['review_id']) }}" class="block hover:text-blue-600">
                        Your review has been flagged for moderation
                    </a>
                @endif
                <div class="text-xs text-gray-500 mt-1">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
            @unless($notification->read_at)
                <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="flex-shrink-0">
                    @csrf
                    <button type="submit" class="text-xs text-gray-500 hover:text-gray-700">
                        Mark as read
                    </button>
                </form>
            @endunless
        </div>
    @empty
        <div class="text-gray-500 text-center py-4">
            No notifications
        </div>
    @endforelse
</div>