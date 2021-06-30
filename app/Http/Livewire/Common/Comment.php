<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Comment extends Component
{
    public $comment;

    public function render()
    {
        return view('components.common.comment');
    }
}
