<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            People {{ $user->name }} Follows
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($following->isEmpty())
                        <p class="text-gray-500">Not following anyone yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($following as $followed)
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($followed->name) }}" alt="{{ $followed->name }}">
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold">{{ $followed->name }}</h4>
                                            <p class="text-sm text-gray-500">Following since {{ $followed->pivot->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->id() !== $followed->id)
                                            @if(auth()->user()->isFollowing($followed))
                                                <form action="{{ route('users.unfollow', $followed) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-secondary-button type="submit">Unfollow</x-secondary-button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.follow', $followed) }}" method="POST">
                                                    @csrf
                                                    <x-primary-button type="submit">Follow</x-primary-button>
                                                </form>
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $following->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>