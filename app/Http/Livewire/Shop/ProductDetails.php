<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{

    public Product $product;

    public $orderQuantity = 1;

    public function render()
    {
        return view('components.shop.product-details');
    }
}
