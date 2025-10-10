<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">New Topic</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <form method="POST" action="{{ route('topics.store') }}" enctype="multipart/form-data" class="card p-3">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="{{ old('title') }}" class="form-control" required>
                    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        @php($cats = ['books','movies','tech','foods','places'])
                        @foreach($cats as $cat)
                            <option value="{{ $cat }}" @selected(old('category')===$cat)>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Create</button>
                    <a class="btn btn-secondary" href="{{ route('topics.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


