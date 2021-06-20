<x-app-layout>
    <div class="flex flex items-center text-gray-900 bg-blue-100 rounded">
        <div class="px-4 py-3 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform -rotate-12" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
        </div>
        <div class="marquee overflow-hidden whitespace-nowrap">
            <div>
                Hello this is really large banner 1 and these numbers are here to just 2 make sure that nothing
                get cut off between that largeness 3 to make sure this animation works fine 4 all these numbers
                must be present at the end 5 im gong to make this even large to just make sure all of this 6
                works fine no matter how long it is 7
            </div>
        </div>
    </div>
    {{-- FAB --}}

    @auth
    <x-social-media.create-fab />
    @endauth

    <x-partials.grid responsiveLeft='true'>
        @auth
        <x-slot name="left">
            <livewire:social-media.user-card />
        </x-slot>
        @endauth

        @guest
        <x-slot name="left">
            <div class="bg-white rounded shadow overflow-hidden text-center">
            </div>
        </x-slot>
        @endguest

        <livewire:social-media.post type='post' />
        <livewire:social-media.post type='quote' />
        <livewire:social-media.post type='image' />

        <x-slot name="right">
            <div class="bg-white rounded-lg shadow-xl h-64">

            </div>
            <div class="bg-white rounded-lg shadow-xl h-64">

            </div>
        </x-slot>
    </x-partials.grid>
</x-app-layout>