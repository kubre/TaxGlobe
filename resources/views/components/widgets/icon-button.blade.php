@props(['active'])

@php
$classes = $active ?? false ? 'flex-col justify-center space-y-1 block pl-3 pr-4 py-3 border-t-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition flex item-center flex-1 items-center' : 'items-center justify-center space-y-1 flex flex-col block pl-3 pr-4 py-3 border-t-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition flex-1';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
