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
        $this->product->loadAvg('reviews', 'rating');
        return view('components.shop.product-details', \compact('reviews'));
    }

    public function redirectCheckout()
    {
        return \redirect()->route('shop.checkout', [
            'product' => $this->product->id,
            'quantity' => $this->order_quantity,
        ]);
    }

    public function downloadDemo()
    {
        if (!auth()->check()) {
            return \redirect()->route('login');
        }
        \abort_unless($this->product->type === 'download', 403);
        $item = $this->product->getMedia('download')->first();
        $this->product->increment('download_count');
        return \response()->download($item->getPath(), $item->name);
    }
}
