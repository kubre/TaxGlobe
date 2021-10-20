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
    public $category = null;

    public function mount(Request $request)
    {
        $this->searchTerm = $request->get('q');
        $this->category = \in_array($request->get('c'), ['download', 'deliver'])
            ? $request->get('c') : null;
    }

    public function render()
    {
        $products = Product::with('media')
            ->when($this->searchTerm, function ($query, $term) {
                $query->where('title', 'LIKE', "%$term%");
            })
            ->when($this->category, function ($query, $category) {
                $query->where('type', $category);
            })
            ->withAvg('reviews', 'rating')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('components.shop.storefront', \compact('products'));
    }
}
