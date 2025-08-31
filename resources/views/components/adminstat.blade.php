@props(['title', 'value'])

<div class="bg-white shadow rounded-lg p-5 flex items-center space-x-4">
    <div>
        <dt class="text-sm font-medium text-gray-500">{{ $title }}</dt>
        <dd class="text-xl font-semibold text-gray-900">{{ $value }}</dd>
    </div>
</div>
