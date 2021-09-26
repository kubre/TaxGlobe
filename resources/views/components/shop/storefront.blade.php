<div>
    <x-common.news />

    <x-partials.grid>

        {{-- Left Side --}}
        <x-slot name="left">
            @auth
                <livewire:widgets.notification-panel />
            @endauth
        </x-slot>

        {{-- Products --}}
        <div class="flex justify-between items-center">
            @if ($searchTerm)
                @if ($searchTerm === " OR 1==1 --'")
                    <small class="px-4">No SQL injections here 🤗 - vaibhav</small>
                @endif
                <h3 class="text-lg px-4 py-2 border-b">
                    Results for products containing <span class="font-bold">{{ $searchTerm }}</span>.
                </h3>
            @else
                <h3 class="text-lg font-bold px-4 py-2 border-b">
                    Latest Products
                </h3>
            @endif
            <x-widgets.share align="right"
                whatsapp="Check out this product on taxglobe {{ route('shop.index', ['q' => $searchTerm]) }}"
                copy="{{ route('shop.index', ['q' => $searchTerm]) }}">
            </x-widgets.share>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-8 p-4 lg:mb-16">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product->slug) }}"
                    class="flex flex-col space-y-2 justify-between h-full">
                    <div class="flex justify-center max-h-64 h-64 flex-1">
                        <img class="object-fill" src="{{ $product->getMedia('images')->first()->getUrl() }}" />
                    </div>

                    <div class="px-4">
                        <div class="text-gray-900">
                            {{ $product->title }}
                        </div>
                        <div class=" text-gray-700 text-xs">
                            {{ Str::limit($product->short_description, 200) }}
                        </div>
                    </div>
                    <div class="px-4">
                        @if ($product->in_stock)
                            <strong class="text-red-900 text-lg">
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
                    <x-jet-secondary-button class="flex justify-center items-center w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Show More
                    </x-jet-secondary-button>
                </a>
            @empty
                <div class="px-4 lg:px-8 py-4 mt-2">
                    <div class="text-3xl">This page seems empty!</div>
                    <div class="mt-2 text-lg">
                        Seems like we currently don't have any products for you.
                    </div>
                </div>
            @endforelse
            <div class="px-4 py-2">
                {{ $products->links() }}
            </div>
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            <livewire:widgets.tax-calendar />
        </x-slot>
    </x-partials.grid>
</div>
