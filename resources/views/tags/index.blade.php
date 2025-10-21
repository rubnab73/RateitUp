<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tags
            </h2>
            @auth
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-tag')">
                    Create New Tag
                </x-primary-button>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($tags as $tag)
                            <div class="p-4 border rounded-lg hover:shadow-md transition">
                                <a href="{{ route('tags.show', $tag) }}" class="block">
                                    <h3 class="font-semibold text-lg mb-2">{{ $tag->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $tag->description ?? 'No description available.' }}
                                    </p>
                                    <div class="text-sm text-gray-500">
                                        {{ $tag->topics_count }} {{ Str::plural('topic', $tag->topics_count) }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Tag Modal -->
    <x-modal name="create-tag" :show="$errors->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('tags.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                Create New Tag
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="Description" />
                <x-textarea id="description" name="description" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Create Tag
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>