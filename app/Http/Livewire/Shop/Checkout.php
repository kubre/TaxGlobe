<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Checkout extends Component
{
    public ?Product $product;
    public $quantity;
    public $shippingDetails = [];
    public $canBuy = false;

    public function mount(Request $request)
    {
        \abort_unless($request->has('product') && $request->has('quantity'), 404, 'Product not available!');
        $this->product = Product::findOrFail($request->product);
        $this->quantity = $this->product->type === 'download' ? 1 : $request->quantity;

        $this->shippingDetails['name'] = \auth()->user()->name;
        $this->shippingDetails['email'] = \auth()->user()->email;
        $this->shippingDetails['contact'] = \auth()->user()->contact;
        $this->shippingDetails['address'] = \auth()->user()->address;
        $this->shippingDetails['city'] = \auth()->user()->city;
        $this->shippingDetails['state'] = \auth()->user()->state;
        $this->shippingDetails['pin_code'] = \auth()->user()->pin_code;
        $this->shippingDetails['shipping_notes'] = \auth()->user()->shipping_notes;

        \abort_if(($this->product->type === 'deliver' && $request->quantity > $this->product->stock)
            || !$this->product->in_stock, 404);

        $this->canBuy = !(empty($this->shippingDetails['name'])
            || empty($this->shippingDetails['contact'])
            || empty($this->shippingDetails['city'])
            || empty($this->shippingDetails['state'])
            || empty($this->shippingDetails['address']));
    }

    public function render()
    {
        return view('components.shop.checkout');
    }
}
