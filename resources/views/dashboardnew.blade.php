<x-app-layout>
    <main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Admin Dashboard</h1>
        <p class="text-gray-600">Manage your news website content and settings</p>
      </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-adminstat 
                title="Total Pengguna" 
                :value="$totalUsers" 
            />

            <x-adminstat 
                title="Pendapatan" 
                :value="'Rp ' . number_format($revenue, 0, ',', '.')"  
            />

            <x-adminstat 
                title="Pesanan Hari Ini" 
                :value="$todayOrders"  
            />

            <x-adminstat 
                title="Produk Aktif" 
                :value="$activeProducts"  
            />
        </div>

      <div class="mt-8">
  <!-- Tabs navigation -->
  <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 border-b border-gray-200" id="adminTab" data-tabs-toggle="#adminTabContent" role="tablist">
    <li class="me-2">
      <button class="inline-block p-4 rounded-t-lg border-b-2" id="overview-tab" data-tabs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
        Overview
      </button>
    </li>
    <li class="me-2">
      <button class="inline-block p-4 rounded-t-lg border-b-2" id="news-tab" data-tabs-target="#news" type="button" role="tab" aria-controls="news" aria-selected="false">
        News Management
      </button>
    </li>
    <li class="me-2">
      <button class="inline-block p-4 rounded-t-lg border-b-2" id="categories-tab" data-tabs-target="#categories" type="button" role="tab" aria-controls="categories" aria-selected="false">
        Categories
      </button>
    </li>
  </ul>

  <!-- Tabs content -->
  <div id="adminTabContent">
    <!-- Overview tab -->
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overview" role="tabpanel" aria-labelledby="overview-tab">
      <div class="grid gap-6 md:grid-cols-2">
        <!-- Quick Actions Card -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
          <div class="space-y-4">
            <a href="/admin/news" class="block w-full">
              <button class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Manage News Articles</button>
            </a>
            <a href="/admin/categories" class="block w-full">
              <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-lg">Manage Categories</button>
            </a>
          </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
          <p class="text-sm text-gray-600 dark:text-gray-300">
            View and manage your latest news articles and user interactions.
          </p>
        </div>
      </div>
    </div>

    <!-- News tab -->
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="news" role="tabpanel" aria-labelledby="news-tab">
      <!-- Replace with your NewsManagement blade/component -->
      @include('article.index')
    </div>

    <!-- Categories tab -->
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="categories" role="tabpanel" aria-labelledby="categories-tab">
      <!-- Replace with your CategoryManagement blade/component -->
      @include('category.index')
    </div>
  </div>
</div>

    </div>
    </main>
</x-app-layout>