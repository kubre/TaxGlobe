<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;
use Str;

class SearchBar extends Component
{
    public $term;

    public function render()
    {
        return view('components.common.search-bar');
    }

    public function searchPosts()
    {
        if (\strlen($this->term) < 3) {
            return;
        }
        return redirect()->route('explore.index', ['q' => $this->term]);
    }

    public function searchUsers()
    {
        if (\strlen($this->term) < 3) {
            return;
        }
        return \redirect()->route('users.index', ['q' => $this->term]);
    }

    public function searchProducts()
    {
        if (\strlen($this->term) < 3) {
            return;
        }
        return \redirect()->route('shop.index', ['q' => $this->term]);
    }
}
