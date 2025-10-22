<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Topics tagged with "{{ $tag->name }}"
            </h2>
            <div class="flex space-x-4">
                <span class="text-gray-500">
                    {{ $topics->total() }} {{ Str::plural('topic', $topics->total()) }}
                </span>
                @auth
                    <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-tag')">
                        Edit Tag
                    </x-secondary-button>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($tag->description)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        {{ $tag->description }}
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($topics->isEmpty())
                        <p class="text-gray-500">No topics found with this tag.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($topics as $topic)
                                <div class="border rounded-lg overflow-hidden hover:shadow-md transition">
                                    @if($topic->image)
                                        <img src="{{ Storage::url($topic->image) }}" alt="{{ $topic->title }}" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h3 class="font-semibold text-lg mb-2">
                                            <a href="{{ route('topics.show', $topic) }}" class="hover:text-indigo-600">
                                                {{ $topic->title }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            {{ Str::limit($topic->description, 100) }}
                                        </p>
                                        <div class="flex justify-between items-center text-sm text-gray-500">
                                            <span>By {{ $topic->user->name }}</span>
                                            <span>{{ $topic->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $topics->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tag Modal -->
    <x-modal name="edit-tag" :show="$errors->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('tags.update', $tag) }}" class="p-6">
            @csrf
            @method('PATCH')

            <h2 class="text-lg font-medium text-gray-900">
                Edit Tag
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$tag->name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="Description" />
                <x-textarea id="description" name="description" class="mt-1 block w-full">{{ $tag->description }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                    Cancel
                </x-secondary-button>

                <form method="POST" action="{{ route('tags.destroy', $tag) }}" class="mr-3">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit" onclick="return confirm('Are you sure you want to delete this tag?')">
                        Delete Tag
                    </x-danger-button>
                </form>

                <x-primary-button type="submit">
                    Update Tag
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>