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
}
