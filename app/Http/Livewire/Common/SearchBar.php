<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SearchBar extends Component
{
    public $term = '';

    public function render()
    {
        return view('components.common.search-bar');
    }
}
