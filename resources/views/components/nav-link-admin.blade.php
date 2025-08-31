@props(['active'])

    @php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium leading-5 text-white focus:outline-none focus:border-indigo-200 transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-indigo-200 hover:text-white hover:border-indigo-300 focus:outline-none focus:text-white focus:border-indigo-300 transition duration-150 ease-in-out';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>