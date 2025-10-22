<x-admin-layout>
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Review</h2>
            
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div class="bg-yellow-50 p-4 rounded mb-4">
                    <div class="font-medium text-gray-800">Current Review Content:</div>
                    <div class="mt-2">
                        <p class="text-gray-600"><strong>Rating:</strong> {{ $review->rating }}/5</p>
                        <p class="text-gray-600 mt-2"><strong>Text:</strong> {{ $review->review_text }}</p>
                    </div>
                </div>

                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700">Moderation Action</label>
                    <select name="action" id="action" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="">Select an action...</option>
                        <option value="warning">Issue Warning</option>
                        <option value="flag">Flag for Review</option>
                    </select>
                    @error('action')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Moderation</label>
                    <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required placeholder="Explain why this review needs moderation..."></textarea>
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.reviews') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>