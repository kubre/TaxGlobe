@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0 border-b border-indigo-200 focus:ouline-none bg-indigo-50 foucs:bg-indigo-100 focus:ring-0 rounded-lg']) !!}>
