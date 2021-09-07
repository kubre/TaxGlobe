<div class="p-4 bg-white rounded">
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
                <strong>Amount Paid:</strong> ₹ {{ \number_format($order->amount, 2) }}/-
            </div>
            @if ($compact)
                <div><strong>Customer:</strong> {{ $order->details['name'] ?: '--' }}
                    ({{ $order->details['city'] . '/' . $order->details['state'] }})</div>
            @else
                <div><strong>Status:</strong> {{ $order->readable_status }}</div>
            @endif
            <div><strong>Order ID:</strong> {{ $order->order_id }}</div>
            @if (!$compact)
                <div class="p-1 flex items-center justify-between">
                    <a href="{{ route('shop.order.receipt', $order->id) }}" class="text-blue-700"
                        target="_blank">Print
                        Receipt</a>
                    @if ($order->product->type === 'download' && $order->status === 'success')
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
