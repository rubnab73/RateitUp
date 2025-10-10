<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Topic</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <form method="POST" action="{{ route('topics.update', $topic) }}" enctype="multipart/form-data" class="card p-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="{{ old('title', $topic->title) }}" class="form-control" required>
                    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        @php($cats = ['books','movies','tech','foods','places'])
                        @foreach($cats as $cat)
                            <option value="{{ $cat }}" @selected(old('category', $topic->category)===$cat)>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $topic->description) }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    @if($topic->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$topic->image) }}" alt="{{ $topic->title }}" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-secondary" href="{{ route('topics.show', $topic) }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


