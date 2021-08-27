<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order;
use Illuminate\Http\Response;
use Livewire\Component;

class OrderStatus extends Component
{
    public ?Order $order;

    public function mount(Order $order)
    {
        \abort_unless($order->user_id === auth()->id(), Response::HTTP_FORBIDDEN);
        $this->order = $order;
    }

    public function render()
    {
        return view('components.shop.order-status');
    }
}
