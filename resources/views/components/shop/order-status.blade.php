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
                    <div class="flex flex-col items-center justify-center gap-y-2 px-2">
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
                                    Please keep checking the <a href="{{ route('shop.order.list') }}"
                                        class="bg-blue-500 text-blue-100 rounded font-bold px-2 py-1 mx-1">Purchase
                                        History</a>
                                    for updates on delivery status.
                                @else
                                    Visit <a href="{{ route('shop.order.list') }}"
                                        class="bg-blue-500 text-blue-100 rounded font-bold px-2 py-1 mx-1">Purchase
                                        History</a> to download.
                                    <a class="block text-lg mt-4 bg-green-200 p-2 rounded"
                                        href="https://api.whatsapp.com/send?phone=918208980784&text={{ urlencode('Hello, I\'ve purchased ' . $order->product->title . ' from taxglobe.in and my order id is ' . $order->order_id . ', and I would like to get my product activated.') }}"
                                        target="_blank">Please Whatsapp on
                                        <span class="flex justify-center items-center px-2 text-green-700">
                                            <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                            </svg>
                                            {{ __('+91-8208980784') }}
                                        </span> to get your product activated. <br><small class="text-green-700">You can
                                            tap/click on this
                                            green
                                            box to start whatsapp too</small>
                                    </a>
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
                            <div class="mt-2">If payment has been deducted please wait for while and if still
                                not
                                refunded please
                                contact our support.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-partials.grid>
</div>
