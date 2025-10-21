<div class="space-y-4">
    <div class="flex flex-wrap gap-2">
        @foreach($topic->tags as $tag)
            <div class="inline-flex items-center bg-gray-100 rounded-full px-3 py-1 text-sm">
                <a href="{{ route('tags.show', $tag) }}" class="text-gray-700 hover:text-indigo-600">
                    {{ $tag->name }}
                </a>
                @if(auth()->check() && auth()->id() === $topic->user_id)
                    <form action="{{ route('topics.tags.detach', [$topic, $tag]) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    @if(auth()->check() && auth()->id() === $topic->user_id)
        <form action="{{ route('topics.tags.attach', $topic) }}" method="POST" class="flex gap-2">
            @csrf
            <div class="flex-1">
                <x-input-label for="tag_name" value="Add Tag" class="sr-only" />
                <x-text-input
                    id="tag_name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Enter a new tag or select existing"
                    list="existing-tags"
                    required
                />
                <datalist id="existing-tags">
                    @foreach($existingTags as $tag)
                        <option value="{{ $tag->name }}">
                    @endforeach
                </datalist>
            </div>
            <x-primary-button type="submit">
                Add
            </x-primary-button>
        </form>
    @endif
</div>