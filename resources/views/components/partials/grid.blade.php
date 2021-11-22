@props(['isCompact', 'responsiveLeft', 'bg'])

<div {!! $attributes->merge(['class' => $isCompact ?? false ? '' : 'sm:py-6']) !!}>
    <div
        class="{{ $isCompact ?? false ? 'w-full' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row space-x-0 lg:space-x-4' }}">
        <div class="w-full lg:w-64 flex-none
        {{ $responsiveLeft ?? false ? 'hidden lg:block' : '' }}">
            {{ $left ?? '' }}
        </div>
        <div class="flex-auto">
            <div class="bg-{{ $bg ?? 'white' }} lg:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <div class="{{ $isCompact ?? false ? 'hidden' : 'w-full lg:w-64 flex flex-col flex-none space-y-4' }}">
            {{ $right ?? '' }}
            <div class="flex space-x-4 md:space-x-2 text-xs justify-center flex-wrap">
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
            <div class="flex flex-col px-4 text-xs justify-center">
                <div class="text-gray-600 hover:text-gray-800 flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +91-940-302-7988
                </div>
                <div class="text-gray-600 hover:text-gray-800 flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-none" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    2nd Floor, Eldora, Golden City Centre, Aurangabad
                </div>
            </div>
            <div class="text-center flex flex-col gap-y-1">
                <div class="font-bold">&copy; TaxGlobe India {{ date('Y') }}</div>
                <a href="https://kubre.in" target="_blank"
                    class="block {{ request()->has('dev') ? 'text-blue-700 font-bold text-sm' : 'text-gray-500 text-xs' }}">
                    Designed by Vaibhav Kubre
                </a>
            </div>
        </div>
    </div>
</div>
