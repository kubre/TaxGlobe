<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order as OrderModel;
use Livewire\Component;

class Order extends Component
{
    public ?OrderModel $order;

    public function render()
    {
        return view('components.shop.order');
    }

    public function download()
    {
        \abort_unless($this->order->product->type === 'download' && $this->order->status === 'success', 403);
        $item = $this->order->product->getMedia('download')->first();
        return \response()->download($item->getPath(), $item->name);
    }
}
