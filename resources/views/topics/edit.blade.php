<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Topic</h2>
    </x-slot>
    <div class="py-6">
        <div class="container">
            <form method="POST" action="{{ route('topics.update', $topic) }}" enctype="multipart/form-data" class="card p-3">
                @csrf
                @method('PATCH')
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
                    <label class="form-label">Description (Brief Summary)</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $topic->description) }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <x-rich-editor
                        name="content"
                        label="Content (Detailed Information)"
                        :value="old('content', $topic->content)"
                    />
                    @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="draft" @selected(old('status', $topic->status)==='draft')>Draft</option>
                        <option value="published" @selected(old('status', $topic->status)==='published')>Published</option>
                        <option value="archived" @selected(old('status', $topic->status)==='archived')>Archived</option>
                    </select>
                    @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Images</label>
                    <x-image-gallery :images="$topic->images" :editable="true" />
                    @error('images')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-secondary" href="{{ route('topics.show', $topic) }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


