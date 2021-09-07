<div>
    <x-common.news />

    <x-partials.grid>
        <x-slot name="left"></x-slot>

        <div class="bg-white rounded p-4">
            <div>
                <h3 class="inline text-lg font-bold">Checkout</h3>
                <span class="text-red-500 text-sm">(Please confirm all the details before paying)</span>
            </div>
            <hr>

            <div class="flex flex-col lg:flex-row mt-4 gap-y-2 lg:gap-y-0 lg:gap-x-2">
                <div class="border border-gray-300 rounded p-4 flex-1">
                    <strong>Product Details</strong>
                    <hr>
                    <table class="table-fixed w-full">
                        <tbody>
                            <tr>
                                <td colspan="2" class="p-2">
                                    <img class="max-h-32 lg:max-h-24 mx-auto"
                                        src="{{ $product->getMedia('images')->first()->getUrl() }}" />
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Product</td>
                                <td class="p-1">{{ $product->title }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Unit Price</td>
                                <td class="p-1">₹ {{ $product->final_price }} /-</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Quantity</td>
                                <td class="p-1">
                                    {{ $quantity }}
                                    {{-- <x-jet-input class="w-full" type="number" wire:model.debounce.1s="quantity" /> --}}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Shipping Cost</td>
                                <td class="p-1">
                                    {{ $shippingDetails['shipping_cost'] ?? 0 ?: 'Free' }}
                                    {{-- <x-jet-input class="w-full" type="number" wire:model.debounce.1s="quantity" /> --}}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Payble Amount</td>
                                <td class="p-1">₹ {{ $amount }} /-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border border-gray-300 rounded p-4 flex-1">
                    <strong class="p-1">Shipping/Billing Details</strong>
                    <hr>
                    <table class="table-fixed w-full">
                        <tbody>
                            <tr>
                                <td class="font-bold p-1">Name</td>
                                <td>{{ $shippingDetails['name'] ?: '-- REQUIRED --' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Email</td>
                                <td>{{ $shippingDetails['email'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Contact</td>
                                <td class="p-1">{{ $shippingDetails['contact'] ?: '-- REQUIRED --' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Address</td>
                                <td class="p-1">{{ $shippingDetails['address'] ?: '-- REQUIRED --' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">City</td>
                                <td class="p-1">{{ $shippingDetails['city'] ?: '-- REQUIRED --' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">PIN code</td>
                                <td class="p-1">{{ $shippingDetails['pin_code'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">State</td>
                                <td class="p-1">{{ $shippingDetails['state'] ?: '-- REQUIRED --' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold p-1">Shipping Notes</td>
                                <td class="p-1">{{ $shippingDetails['shipping_notes'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($canBuy)
                <div class="p-2 mt-2">
                    <x-jet-button onclick="startCheckout()" class="w-full flex justify-center" wire:loading.remove>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Proceed to pay ₹ {{ $amount }}
                    </x-jet-button>
                </div>
            @else
                <div class="text-gray-500 p-2">
                    Note: Your missing required billing details. To update your shipping details and other information
                    please visit <a class="text-blue-500" href="{{ route('profile.show') }}">
                        Update Profile
                    </a>.
                </div>
            @endif

            @if ($product->type === 'download')
                <small class="mt-2 text-red-600">Please note this product is a software/download copy and no physical
                    copy
                    will be delivered. Once you complete the payment you will be able to download this from your <a
                        class="underline" href="{{ route('shop.order.list') }}">purchase history</a> any
                    time</small>
            @endif
        </div>

        <x-slot name="right"></x-slot>
    </x-partials.grid>

    @push('scripts')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            function startCheckout() {
                Swal.fire({
                    title: 'Processing Order..',
                    html: 'Please hold on <strong>DO NOT CLOSE Window</strong>, Once this is finsihed you will gievn options for payment',
                    allowOutsideClick: false,
                    didOpen: () => {
                        @this.call('startCheckout');
                        Swal.showLoading();
                    },
                })
            }

            window.addEventListener('order-placed', function(event) {
                Swal.close();
                options = event.detail.options;
                options.handler = function(response) {
                    @this.call('finalizeOrder', response.razorpay_payment_id, response.razorpay_signature);
                };
                var rzp = new Razorpay(options);
                rzp.open();
            });
        </script>
    @endpush
</div>
