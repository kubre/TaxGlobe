<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SearchBar extends Component
{
    public $term;

    public function render()
    {
        return view('components.common.search-bar');
    }

    public function searchPosts()
    {
        return redirect()->route('explore.index', ['q' => $this->term]);
    }

    public function searchUsers()
    {
    }
}
