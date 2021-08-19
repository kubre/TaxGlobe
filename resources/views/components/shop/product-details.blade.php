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

        <div class="flex flex-col space-y-4 justify-between h-auto w-100 p-4">
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
                <div class="flex justify-center items-center flex-1 order-first lg:order-1">
                    <img class="max-h-80 object-fill" x-bind:src="image" x-on:click="openImage(image)" />
                </div>
            </div>

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
                            Save ₹ {{ $product->discount }} ({{ $product->discount_percentage }}%)
                        </small>
                    @endif
                @else
                    <strong class="text-red-900 text-lg">
                        Out of Stock
                    </strong>
                @endif
            </div>

            @if ($product->in_stock)
                <div class="flex space-x-2" x-data x-init>
                    <div>
                        <x-jet-input wire:model.lazy="orderQuantity" class="max-w-24 w-24" type="number">
                        </x-jet-input>
                    </div>
                    <x-jet-button class="flex justify-center items-center w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Buy Now
                    </x-jet-button>
                </div>
            @endif

            <div class="description py-4 border-t border-gray-300">
                <div class="mb-1">Details:</div>
                {!! $product->full_description !!}
            </div>

            <div>
                <div>Reviews:</div>
                No Reviews
            </div>
        </div>
        <x-slot name="right">
            <strong class="text-center">Other Products</strong>
            <livewire:widgets.product-slider />
        </x-slot>

    </x-partials.grid>
</div>
