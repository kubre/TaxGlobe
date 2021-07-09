@props(['isCompact', 'responsiveLeft'])

<div {!! $attributes->merge(['class' => ($isCompact ?? false) ? 'py-4' :
    'py-6'])
    !!}>
    <div
        class="{{ ($isCompact ?? false) ? 'w-full' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row space-x-0 space-y-4 lg:space-y-0 lg:space-x-4'}}">
        <div class=" w-full lg:w-64 flex-none
        {{ ($responsiveLeft ?? false) ? 'hidden lg:block' : '' }}">
            {{ $left ?? '' }}
        </div>
        <div class="flex-auto">
            <div
                class="bg-white rounded-lg {{ ($isCompact ?? false) ? '' : '' }}">
                {{ $slot }}
            </div>
        </div>
        <div
            class="{{ ($isCompact ?? false) ? 'hidden' : 'w-full lg:w-64 flex flex-col flex-none space-y-4' }}">
            {{ $right ?? '' }}
        </div>
    </div>
</div>