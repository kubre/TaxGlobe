<div class="">
    <div class="bg-indigo-50 lg:bg-white relative rounded-lg max-h-full overflow-hidden py-2 border-t">
        <strong class="block px-4 text-center lg:text-left">Shop</strong>
        <div class="mx-auto relative" x-data="{ activeSlide: 0, slides: @entangle('slides').defer }">
            <!-- Slides -->
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" x-show="activeSlide === {{ $loop->index }}"
                    class="z-10 font-bold p-4 min-h-80 flex flex-col items-center w-full space-y-2 flex-1" x-on:click>
                    <img class="max-h-48 lg:max-h-36 mx-auto rounded"
                        src="{{ $product->getMedia('images')->first()->getUrl() }}" />
                    <span class="text-center max-w-full">{{ $product->title }}</span>
                </a>
            @endforeach

            <!-- Buttons -->
            <button class="absolute top-0 bottom-0 left-2 px-2 rounded-full overflow-hidden text-gray-700"
                x-on:click="activeSlide = activeSlide == 0 ?  slides.length - 2 : activeSlide - 1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="absolute top-0 bottom-0 right-2 px-2 rounded-full overflow-hidden text-gray-700"
                x-on:click="activeSlide = activeSlide < slides.length - 2 ? activeSlide + 1 : 0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
