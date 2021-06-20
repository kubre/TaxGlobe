<?php

namespace App\Http\Livewire\SocialMedia;

use Livewire\Component;

class Post extends Component
{
    public $type;
    public function render()
    {
        return view('components.social-media.post');
    }
}
