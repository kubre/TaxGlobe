<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order;
use App\Models\User;
use App\Traits\CustomWithPagination;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public ?User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('components.shop.order-list', [
            'orders' => $this->user->orders()
                ->with('product.media')
                ->orderBy('id', 'desc')
                ->paginate(),
        ]);
    }
}
