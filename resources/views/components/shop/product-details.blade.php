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
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-jet-secondary-button variant='white'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </x-jet-secondary-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link class="flex items-center"
                            href="https://api.whatsapp.com/send?text={{ urlencode('Check out this product on taxglobe ' . route('products.show', $product->slug)) }}"
                            target="_blank" ata-action="share/whatsapp/share">
                            <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            {{ __('Whatsapp') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link data-clipboard-text="{{ route('products.show', $product->slug) }}"
                            class="flex items-center copy-link">
                            <svg class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            {{ __('Copy Link') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
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
            </div>

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

        </x-slot>

    </x-partials.grid>
</div>
