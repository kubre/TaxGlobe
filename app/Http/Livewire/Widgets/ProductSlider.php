<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Product;
use Livewire\Component;

class ProductSlider extends Component
{
    public $products;
    public $slides = [];
    public $activeSlide;

    public function mount()
    {
        $this->products = Product::inRandomOrder()->limit(5)->get();
        $this->slides = \range(0, $this->products->count());
    }

    public function render()
    {
        return view('components.widgets.product-slider');
    }
}
