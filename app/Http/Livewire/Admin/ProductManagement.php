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

    public function toggleHidden(Product $product)
    {
        $product->is_hidden = !$product->is_hidden;
        $product->save();
        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('toast', [
            'title' => 'Toggled hidden status successfully!',
            'icon' => 'success',
        ]);
    }
}
