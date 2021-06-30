@props(['variant'])

@php
$types = [
'white' => 'bg-white border-none focus:outline-none active:outline-none
text-gray-700',
'secondary' => 'text-gray-700 bg-gray-200 text-gray-700 border border-gray-700
hover:text-white hover:bg-gray-700',
'success' => 'text-green-700 bg-green-200 text-green-700 border border-green-700
hover:text-white hover:bg-green-700',
'warning' => 'text-yellow-700 bg-yellow-200 text-yellow-700 border
border-yellow-700 hover:text-white hover:bg-yellow-700',
];
$classes = $types[$variant ?? 'secondary'];
@endphp

<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 rounded-full font-semibold text-xs uppercase tracking-widest shadow-sm disabled:opacity-25 transition '. $classes]) }}>
    {{ $slot }}
</button>