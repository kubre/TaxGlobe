<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use App\Traits\CustomWithPagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Storefront extends Component
{
    use CustomWithPagination;

    public $searchTerm = null;

    public function mount(Request $request)
    {
        $this->searchTerm = $request->get('q');
    }

    public function render()
    {
        $products = Product::with('media')
            ->when($this->searchTerm, function ($query, $term) {
                $query->where('title', 'LIKE', "%$term%");
            })
            ->withAvg('reviews', 'rating')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('components.shop.storefront', \compact('products'));
    }
}
