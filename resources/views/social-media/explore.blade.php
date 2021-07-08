<x-app-layout>
    <div class="flex flex items-center text-gray-900 bg-blue-100 rounded">
        <div class="px-4 py-3 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 transform -rotate-12" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
        </div>
        <div class="marquee overflow-hidden whitespace-nowrap">
            <div>
                Hello this is really large banner 1 and these numbers are here
                to just 2 make sure that nothing
                get cut off between that largeness 3 to make sure this animation
                works fine 4 all these numbers
                must be present at the end 5 im gong to make this even large to
                just make sure all of this 6
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
            <livewire:social-media.user-card :user='Auth::user()' />
        </x-slot>
        @endauth

        @guest
        <x-slot name="left">
            <div class="bg-white rounded overflow-hidden text-center">
            </div>
        </x-slot>
        @endguest

        <h1 class="text-2xl lg:text-3xl pt-6 px-8">Explore whats new today!</h1>
        @foreach ($posts as $post)
        <livewire:social-media.post :post='$post' />
        @endforeach


        <x-slot name="right">
            <div x-data='' class="bg-white rounded-lg h-64 p-4">
                <h3 class="text-xl">Tax Calendar</h3>
                <div class="py-2 flex flex-col space-y-2">
                    <template x-for='i in [1, 2, 3, 4]'>
                        <div class="bg-red-200 rounded p-2">
                            <span
                                class="text-sm mr-1 bg-red-500 rounded-full px-2 text-white"
                                x-text='i + " Jun"'></span>
                            <span class="font-bold"
                                x-text='"Event " + i'></span>
                        </div>
                    </template>
                </div>
            </div>
            <div class="h-64">
                <div
                    class="bg-blue-200 flex flex-col justify-center items-center max-h-full">

                    <div class=" mx-auto relative"
                        x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }">
                        <!-- Slides -->
                        <template x-for="slide in slides" :key="slide">
                            <div x-show="activeSlide === slide"
                                class="p-24 font-bold text-4xl h-64 flex items-center bg-teal-500 text-white rounded-lg">
                                <span class="w-6 text-center"
                                    x-text="slide"></span>
                                <span class="text-teal-300">/</span>
                                <span class="w-6 text-center"
                                    x-text="slides.length"></span>
                            </div>
                        </template>

                        <!-- Buttons -->
                        <div
                            class="absolute w-full flex items-center justify-center px-4">
                            <template x-for="slide in slides" :key="slide">
                                <button
                                    class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                                    :class="{  'bg-blue-600': activeSlide === slide, 'bg-blue-300': activeSlide !== slide }"
                                    x-on:click="activeSlide = slide"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-partials.grid>
</x-app-layout>