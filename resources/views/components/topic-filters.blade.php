<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('topics.index') }}" method="GET" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div>
                <x-input-label for="search" value="Search" />
                <x-text-input id="search" name="search" type="text" class="mt-1 block w-full"
                    :value="request('search')" placeholder="Search topics..." />
            </div>

            <!-- Category Filter -->
            <div>
                <x-input-label for="category" value="Category" />
                <x-select id="category" name="category" class="mt-1 block w-full">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <!-- Sort Options -->
            <div>
                <x-input-label for="sort" value="Sort By" />
                <x-select id="sort" name="sort" class="mt-1 block w-full">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Highest Rated</option>
                    <option value="most_reviewed" {{ request('sort') == 'most_reviewed' ? 'selected' : '' }}>Most Reviewed</option>
                    <option value="most_viewed" {{ request('sort') == 'most_viewed' ? 'selected' : '' }}>Most Viewed</option>
                    <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured Only</option>
                </x-select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Rating Filter -->
            <div>
                <x-input-label for="rating" value="Minimum Rating" />
                <x-select id="rating" name="rating" class="mt-1 block w-full">
                    <option value="">Any Rating</option>
                    @foreach(range(5, 1) as $rating)
                        <option value="{{ $rating }}" {{ request('rating') == $rating ? 'selected' : '' }}>
                            {{ $rating }}+ Stars
                        </option>
                    @endforeach
                </x-select>
            </div>

            <!-- Status Filter -->
            <div>
                <x-input-label for="status" value="Status" />
                <x-select id="status" name="status" class="mt-1 block w-full">
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                </x-select>
            </div>

            <!-- Featured Filter -->
            <div class="flex items-center mt-8">
                <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    {{ request('featured') ? 'checked' : '' }}>
                <label for="featured" class="ml-2 text-sm text-gray-600">
                    Show Featured Only
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <x-secondary-button type="reset" onclick="window.location='{{ route('topics.index') }}'">
                Reset
            </x-secondary-button>
            <x-primary-button type="submit">
                Apply Filters
            </x-primary-button>
        </div>
    </form>
</div>