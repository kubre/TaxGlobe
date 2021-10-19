<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductDetails extends Component
{
    use WithPagination;

    public Product $product;

    public $order_quantity = 1;

    public $canBuy = true;

    public function updatedOrderQuantity($value)
    {
        if ($this->product->type === 'deliver') {
            $this->canBuy = $this->product->stock >= $value;
        }
    }

    public function render()
    {
        $reviews = $this->product->reviews()->orderBy('id', 'desc')->simplePaginate(5);
        return view('components.shop.product-details', \compact('reviews'));
    }

    public function redirectCheckout()
    {
        return \redirect()->route('shop.checkout', [
            'product' => $this->product->id,
            'quantity' => $this->order_quantity,
        ]);
    }
}
