@props(['active'])

@php
$classes =
    $active ?? false
        ? 'inline-flex items-center px-1 pt-1 border-b-4 border-indigo-400 text-sm font-medium leading-5 text-gray-900
focus:outline-none focus:border-indigo-700 text-indigo-700 transition flex-col items-center justify-center gap-y-1 px-8 h-full w-24'
        : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition flex flex-col text-sm items-center justify-center gap-y-1 px-8 h-full w-24';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
