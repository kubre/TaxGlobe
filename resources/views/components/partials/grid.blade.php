@props(['isCompact', 'responsiveLeft'])

<div {!! $attributes->merge(['class' => ($isCompact ?? false) ? 'py-4' :
    'sm:py-6'])
    !!}>
    <div
        class="{{ ($isCompact ?? false) ? 'w-full' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row space-x-0 lg:space-x-4'}}">
        <div class="w-full lg:w-64 flex-none
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
            <div class="flex space-x-4 md:space-x-2 text-xs pt-12 md:pt-8 justify-center flex-wrap">
                <div>
                    <a href="{{ route('about.show') }}" class="text-gray-600 hover:text-gray-800">About</a>
                </div>
                <div>
                    <a href="{{ route('terms.show') }}" class="text-gray-600 hover:text-gray-800">Terms of
                        Service</a>
                </div>
                <div>
                    <a href="{{ route('policy.show') }}" class="text-gray-600 hover:text-gray-800">Privacy
                        Policy</a>
                </div>
            </div>
        </div>
    </div>
</div>