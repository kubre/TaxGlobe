<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ProductManagement extends Component
{
    public function render()
    {
        return view('components.admin.product-management')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function toggleStock(Product $product)
    {
        $product->in_stock = !$product->in_stock;
        $product->save();
        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('toast', [
            'title' => 'Toggled stock status successfully!',
            'icon' => 'success',
        ]);
    }
}
