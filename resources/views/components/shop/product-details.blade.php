<div>
    <x-common.news />

    @push('styles')
        <style>
            .description ul li {
                list-style-type: disc;
                margin-left: 20px;
            }

            .description ol li {
                list-style-type: decimal;
                margin-left: 20px;
            }

            .description ul li {
                list-style-type: disc;
                margin-left: 20px;
            }

            .description h2 {
                font-size: 1.5em;
                font-weight: bold;
            }

            .description h3 {
                font-size: 1.17em;
                font-weight: bold;
            }

            .description h4 {
                font-size: 1em;
                font-weight: bold;
            }

        </style>
    @endpush

    <x-slot name='head'>
        <meta property="og:title" content="{{ $product->title }}">
        <meta property="og:description" content="Shop on TaxGlobe.in">
        <meta property="og:image" content="{{ $product->getMedia('images')->first()->getUrl() }}">
        <meta property="og:url" content="{{ route('products.show', $product->slug) }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:site_name" content="TaxGlobe Professionals (Shop)">
    </x-slot>

    <x-partials.grid :responsiveLeft="true">

        <div class="flex flex-col space-y-2 justify-between h-auto w-100 p-4">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-gray-900 text-lg font-bold">
                        {{ $product->title }}
                    </div>
                    <div class="mb-1 text-gray-700">
                        {{ $product->short_description }}
                    </div>
                </div>

                <x-widgets.share align="right"
                    whatsapp="Check out this product on taxglobe {{ route('products.show', $product->slug) }}"
                    copy="{{ route('products.show', $product->slug) }}">
                </x-widgets.share>
            </div>
            <div class="flex space-x-1 items-center text-xs pb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 fill-current {{ $i <= $product->reviews_avg_rating ? 'text-yellow-500' : 'text-gray-300' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                @endfor
                <span class="font-bold pl-2">{{ round($product->reviews_avg_rating, 1) }}</span>
            </div>
            <div class="flex flex-col lg:flex-row"
                x-data="{ image: '{{ $product->getMedia('images')->first()->getUrl() }}' }">
                <div
                    class="flex flex-row lg:flex-col space-x-2 lg:space-x-0 space-y-0 lg:space-y-2 w-100 order-last lg:order-1 mr-0 lg:mr-2 mt-2 lg:mt-0">
                    @foreach ($product->getMedia('images') as $image)
                        <img x-on:click="image = '{{ $image->getUrl() }}'"
                            class="w-16 h-16 border border-gray-300 object-cover rounded"
                            x-bind:class="{ 'ring ring-yellow-500': image == '{{ $image->getUrl() }}' }"
                            src="{{ $image->getUrl() }}">
                    @endforeach
                </div>
                <div class="flex justify-center items-center flex-1 order-first lg:order-1 lg:px-2">
                    <img style="max-height: 90vh; height: auto" class="object-fill" x-bind:src="image"
                        x-on:click="openImage(image)" />
                </div>
            </div>

            <div class="flex space-x-4 items-center justify-between">
                <div class="px-4">
                    @if ($product->in_stock)
                        <strong class="text-red-900 text-xl">
                            ₹ {{ $product->final_price ?: 'Free' }}
                        </strong>
                        @if ($product->discount !== 0)
                            <span class="ml-2 mr-1 line-through text-gray-500 text-sm">
                                ₹ {{ $product->price }}
                            </span>
                            <small class="text-gray-900">
                                Save ₹ {{ $product->discount }} ({{ round($product->discount_percentage, 0) }}%)
                            </small>
                        @endif
                    @else
                        <strong class="text-red-900 text-lg">
                            Out of Stock
                        </strong>
                    @endif
                </div>
            </div>

            @if ($product->in_stock)
                <div class="flex space-x-2" x-data x-init>
                    @if ($product->type === 'deliver')
                        <x-jet-input wire:model.debounce.1s="order_quantity" class="max-w-24 w-24" type="number">
                        </x-jet-input>
                    @elseif($product->type === 'download' && $product->price !== 0)
                        <x-jet-secondary-button variant="success" wire:loading.remove wire:click="downloadDemo"
                            class="flex justify-center items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Demo</span>
                        </x-jet-secondary-button>
                    @endif
                    @if ($canBuy)
                        <x-jet-button wire:loading.remove wire:click="redirectCheckout"
                            class="flex justify-center items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            {{ $product->price === 0 ? 'Get for Free' : 'Buy Now' }}
                        </x-jet-button>
                    @else
                        <div class="text-center">We currently do not have specified stock, availble stock is only
                            {{ $product->stock }}</div>
                    @endif
                </div>
            @endif
            @if ($product->type === 'download')
                <div class="flex items-center text-gray-700 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>This product has been downloaded
                        <strong>{{ \number_format($product->download_count) }}</strong>x times.</span>
                </div>
            @endif

            <div class="description py-4 border-t border-gray-300">
                <div class="mb-1">Details:</div>
                {!! $product->full_description !!}
            </div>

            <hr class="my-4">
            <div>
                @can('create', [App\Models\Review::class, $product])
                    <div class="font-bold text-lg">Write a review</div>
                    <div>
                        <livewire:shop.review-form :productId="$product->id" :productSlug="$product->slug">
                        </livewire:shop.review-form>
                    </div>
                    <hr class="my-4">
                @endcan
                <div class="font-bold text-lg">Reviews:</div>
                <div>
                    @forelse ($reviews as $review)
                        <div class="py-2">
                            <div class="flex items-center space-x-2 pt-2">
                                <img class='h-8 w-8 rounded-full mr-2 border'
                                    src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}">
                                <div class="flex items-center">
                                    <span class="mr-1">
                                        {{ $review->user->name }}
                                    </span>
                                    <span
                                        class="text-xs text-gray-500 mr-2">({{ $review->created_at->diffForHumans(null, false, true) }}):
                                    </span>
                                </div>
                            </div>

                            <div class="pl-12 pt-2">
                                <div class="flex justify-between">
                                    <span class="flex space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 fill-current {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        @endfor
                                    </span>
                                    @can('delete', $review)
                                        <x-jet-dropdown-link class="flex items-center"
                                            wire:click="deleteReview({{ $review->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </x-jet-dropdown-link>
                                    @endcan
                                </div>
                                <p>{{ $review->body }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="py-2">No reviews yet</div>
                    @endforelse
                    {{ $reviews->links('components.common.load-more') }}
                </div>
            </div>
        </div>
        <x-slot name="right">
            <div class="space-y-4 pt-2 sm:pt-0 text-center">
                <strong class="text-center">Other Products</strong>
                <livewire:widgets.product-slider />
            </div>
        </x-slot>

    </x-partials.grid>
</div>
