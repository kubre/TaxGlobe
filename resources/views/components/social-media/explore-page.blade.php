<div>
    <x-common.news />

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
                <div class="bg-white rounded shadow overflow-hidden text-center">
                </div>
            </x-slot>
        @endguest
        
        @forelse ($posts as $post)
            <livewire:social-media.post :post='$post' :show='false' :wire:key="'post-'.$post->id" />
        @empty
            <div class="px-4 lg:px-8 py-4 mt-2">
                <div class="text-3xl">This page seems empty!</div>
                <div class="mt-2 text-lg">
                    It will fill with the posts of people you admire. Start <a class="text-blue-500" href="{{ route('explore.index') }}">exploring</a> and follow people to receive their latest posts here.
                </div>
            </div>
        @endforelse
        <div class="px-4 py-2">
            {{ $posts->links() }}
        </div>

        <x-slot name="right">
            <div class="bg-white rounded-lg h-64 px-6 py-4">
                <h3 class="text-xl">Tax Calendar</h3>
            </div>
            <div class="h-64">
                <div class="bg-blue-200 flex flex-col justify-center items-center max-h-full">

                    <div class=" mx-auto relative" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }">
                        <!-- Slides -->
                        <template x-for="slide in slides" :key="slide">
                            <div x-show="activeSlide === slide"
                                class="p-24 font-bold text-4xl h-64 flex items-center bg-teal-500 text-white rounded-lg">
                                <span class="w-6 text-center" x-text="slide"></span>
                                <span class="text-teal-300">/</span>
                                <span class="w-6 text-center" x-text="slides.length"></span>
                            </div>
                        </template>

                        <!-- Buttons -->
                        <div class="absolute w-full flex items-center justify-center px-4">
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
</div>
