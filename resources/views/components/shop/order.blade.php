<div class="p-4">
    <div class="flex flex-col lg:flex-row gap-x-2">
        <img class="h-36 w-full lg:w-36 object-contain"
            src="{{ $order->product->getMedia('images')->first()->getUrl() }}">
        <div class="flex flex-col">
            <strong>{{ $order->product->title }}</strong>
            <div><strong>Quanity:</strong> {{ $order->quantity }}</div>
            <div><strong>Placed At:</strong>
                {{ $order->created_at->setTimezone('Asia/Kolkata')->format('d-M-Y h:i a') }}
            </div>
            <div>
                <strong>Amount Paid:</strong> ₹ {{ \number_format($order->amount, 2) }}/-
            </div>
            <div><strong>Status:</strong> {{ $order->readable_status }}</div>
            <div><strong>Order ID:</strong> {{ $order->order_id }}</div>
            <div class="p-1">
                <a href="" target="_blank" class="text-blue-700 w-full block text-center">Print Receipt</a>
            </div>
        </div>
    </div>
</div>
