<div>
    <x-common.news />

    <x-partials.grid>
        <x-slot name="left"></x-slot>

        <div class="bg-white rounded p-4">
            <div>
                <h3 class="inline text-lg font-bold">Order Status</h3>
            </div>
            <hr>

            <div class="mt-4">
                @if ($order->status === 'success')
                    <div class="flex flex-col lg:flex-row items-center justify-center gap-x-2 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 h-20 w-20" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex flex-col text-center">
                            <strong>
                                Your order for {{ $order->product->title }} with quantity
                                {{ $order->quantity }} has been placed successfully. Your Order ID is
                                {{ $order->order_id }}.
                            </strong>
                            <p class="mt-2">
                                @if ($order->product->type === 'deliver')
                                    Please keep checking the <a href=""
                                        class="bg-blue-500 text-blue-100 rounded font-bold px-2 py-1 mx-1">Orders
                                        Page</a>
                                    for updates on delivery status.
                                @else
                                    Visit <a href=""
                                        class="bg-blue-500 text-blue-100 rounded font-bold px-2 py-1 mx-1">Orders
                                        Page</a> to download.
                                @endif
                            </p>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col lg:flex-row items-center justify-center gap-x-2 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 h-20 w-20 flex-none" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex flex-col text-center">
                            <strong>Your order for {{ $order->product->title }} has failed with Order ID:
                                {{ $order->order_id }}.</strong>
                            <div class="mt-2">If payment has been deducted please wait for while and if still not
                                refunded please
                                contact our support.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-partials.grid>
</div>
