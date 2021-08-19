<?php

namespace App\Http\Livewire\Shop;

use App\Traits\CustomWithPagination;
use Livewire\Component;

class ProductList extends Component
{
    // use CustomWithPagination;

    public function render()
    {
        return view('components.shop.product-list');
    }
}
