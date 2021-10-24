<div class="p-4 bg-white rounded border-b border-gray-200">
    <div class="flex flex-col lg:flex-row gap-x-2">
        @if (!$compact)
            <img class="h-32 w-full lg:w-36 object-contain"
                src="{{ $order->product->getMedia('images')->first()->getUrl() }}">
        @endif
        <div class="flex flex-col flex-1">
            <strong>{{ $order->product->title }}</strong>
            <div><strong>Quanity:</strong> {{ $order->quantity }}</div>
            <div><strong>Placed At:</strong>
                {{ $order->created_at->setTimezone('Asia/Kolkata')->format('d-M-Y h:i a') }}
            </div>
            <div>
                <strong>Order Total:</strong> ₹ {{ \number_format($order->amount, 2) }}/-
            </div>
            @if ($compact)
                <div><strong>Customer:</strong> {{ $order->details['name'] ?: '--' }}
                    ({{ $order->details['city'] . '/' . $order->details['state'] }})</div>
            @else
                <div><strong>Status:</strong> {{ $order->readable_status }}</div>
            @endif
            <div><strong>Order ID:</strong> {{ $order->order_id }}</div>
            @if (!$compact)
                <div class="p-1 flex flex-col lg:flex-row gap-y-4 items-center justify-between">
                    <a href="{{ route('shop.order.receipt', $order->id) }}" class="text-blue-700"
                        target="_blank">Print
                        Receipt</a>
                    @if ($order->product->type === 'download' && $order->status === 'success')
                        <a class="bg-green-200 text-green-700 border border-green-700 flex justify-center items-center rounded-full py-2 px-4"
                            href="https://api.whatsapp.com/send?phone=918208980784&text={{ urlencode('Hello, I\'ve purchased ' . $order->product->title . ' from taxglobe.in and my order id is ' . $order->order_id . ', and I would like to get my product activated.') }}"
                            target="_blank">
                            <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            <span>ACTIVATE</span>
                        </a>
                        <x-jet-button wire:click="download">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            {{ __('Download') }}
                        </x-jet-button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
