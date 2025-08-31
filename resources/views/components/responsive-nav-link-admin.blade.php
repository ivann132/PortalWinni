@props(['active'])

    @php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-white text-left text-base font-medium text-white bg-indigo-500 focus:outline-none focus:text-white focus:bg-indigo-700 focus:border-indigo-200 transition duration-150 ease-in-out'
                : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-indigo-200 hover:text-white hover:bg-indigo-500 hover:border-indigo-300 focus:outline-none focus:text-white focus:bg-indigo-500 focus:border-indigo-300 transition duration-150 ease-in-out';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>