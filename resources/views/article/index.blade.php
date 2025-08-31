<div class="space-y-6">
  <div class="flex justify-between items-center">
    <h2 class="text-2xl font-bold">News Management</h2>
    <a href="{{ route('admin.news.create') }}">
      <button class="flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M12 4v16m8-8H4" />
        </svg>
        Add News Article
      </button>
    </a>
  </div>

  @if($news->isEmpty())
    <p class="text-gray-500">No news articles found.</p>
  @else
    <div class="grid gap-4">
      @foreach($news as $item)
        <div class="bg-white border border-gray-200 rounded-lg shadow">
          <div class="p-4 border-b flex justify-between items-start">
            <div>
              <h3 class="text-lg font-semibold">{{ $item->title }}</h3>
              <div class="mt-2 flex flex-wrap gap-2">
                <span class="px-2 py-1 text-xs rounded {{ $item->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                  {{ $item->published ? 'Published' : 'Draft' }}
                </span>
                @if($item->category_name)
                  <span class="px-2 py-1 text-xs border rounded text-gray-600">
                    {{ $item->category_name }}
                  </span>
                @endif
              </div>
            </div>
            <div class="flex space-x-2">
              <form method="POST" action="{{ route('admin.news.toggle', $item->id) }}">
                @csrf
                <button type="submit" class="p-2 border rounded hover:bg-gray-100" title="Toggle Publish">
                  @if($item->published)
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.026.154-2.015.437-2.948m6.232 2.796a3 3 0 104.243 4.243" />
                      <path d="M15 12a3 3 0 013 3m0 0a3 3 0 01-3 3m3-3H9" />
                    </svg>
                  @else
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path d="M15 12a3 3 0 01-3 3m0-3a3 3 0 003-3m0 6a3 3 0 01-3 3m0-3a3 3 0 003-3" />
                      <path d="M3 3l18 18" />
                    </svg>
                  @endif
                </button>
              </form>

              <a href="{{ route('admin.news.edit', $item->id) }}">
                <button class="p-2 border rounded hover:bg-gray-100" title="Edit">
                  <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l11-11a2.828 2.828 0 10-4-4L5 17z" />
                  </svg>
                </button>
              </a>

              <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button class="p-2 border rounded hover:bg-red-50" title="Delete">
                  <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                    <path d="M9 3h6a1 1 0 011 1v1H8V4a1 1 0 011-1z" />
                  </svg>
                </button>
              </form>
            </div>
          </div>

          <div class="p-4 space-y-2">
            @if($item->summary)
              <p class="text-sm text-gray-700">{{ $item->summary }}</p>
            @endif
            <div class="flex justify-between text-xs text-gray-500">
              <span>By {{ $item->author }}</span>
              <span>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
