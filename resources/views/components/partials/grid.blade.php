@props(['isCompact', 'responsiveLeft'])

<div {!! $attributes->merge(['class' => ($isCompact ?? false) ? 'py-4' :
    'sm:py-6'])
    !!}>
    <div
        class="{{ ($isCompact ?? false) ? 'w-full' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row space-x-0 lg:space-x-4'}}">
        <div class=" w-full lg:w-64 flex-none
        {{ ($responsiveLeft ?? false) ? 'hidden lg:block' : '' }}">
            {{ $left ?? '' }}
        </div>
        <div class="flex-auto">
            <div
                class="bg-white lg:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <div
            class="{{ ($isCompact ?? false) ? 'hidden' : 'w-full lg:w-64 flex flex-col flex-none sm:space-y-4' }}">
            {{ $right ?? '' }}
        </div>
    </div>
</div>