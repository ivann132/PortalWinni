<div class="space-y-6">
  <!-- Header -->
  <div class="flex justify-between items-center">
    <h2 class="text-2xl font-bold">Category Management</h2>
    <button
      type="button"
      class="flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg"
      data-modal-target="createCategoryModal"
      data-modal-toggle="createCategoryModal"
    >
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M12 4v16m8-8H4" />
      </svg>
      Add Category
    </button>
  </div>

  <!-- Create Modal -->
  <div id="createCategoryModal" tabindex="-1" aria-hidden="true"
       class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full bg-black/40">
    <div class="relative w-full max-w-md h-full md:h-auto">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 border-b rounded-t">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Create New Category
          </h3>
          <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900" data-modal-hide="createCategoryModal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6 space-y-4">
          @csrf
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"/>
          </div>
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div class="flex justify-end space-x-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"/>
              </svg>
              Save
            </button>
            <button type="button" class="px-4 py-2 border rounded" data-modal-hide="createCategoryModal">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Category List -->
  <div class="grid gap-4">
    @foreach($categories as $category)
      <div class="bg-white border rounded-lg shadow p-4">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
          @csrf
          @method('PUT')
          <div class="flex justify-between items-start">
            <div class="flex-1 space-y-2">
              <input
                type="text"
                name="name"
                value="{{ old("name", $category->name) }}"
                class="w-full text-lg font-semibold border-none focus:ring-0 focus:outline-none"
              />
              <textarea
                name="description"
                rows="2"
                class="w-full text-sm text-gray-600 border-none focus:ring-0 focus:outline-none resize-none"
              >{{ old("description", $category->description) }}</textarea>
            </div>
            <div class="flex space-x-2 ml-4">
              <button type="submit" class="p-2 border rounded hover:bg-green-50" title="Save">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M5 13l4 4L19 7" />
                </svg>
              </button>
              <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                    onsubmit="return confirm('Are you sure you want to delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 border rounded hover:bg-red-50" title="Delete">
                  <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                    <path d="M9 3h6a1 1 0 011 1v1H8V4a1 1 0 011-1z" />
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </form>
        <div class="mt-2 text-xs text-gray-500">
          Created: {{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y') }}
          @if($category->updated_at !== $category->created_at)
            • Updated: {{ \Carbon\Carbon::parse($category->updated_at)->format('M d, Y') }}
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>
