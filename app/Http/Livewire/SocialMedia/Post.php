<?php

namespace App\Http\Livewire\SocialMedia;

use Livewire\Component;
use App\Models\Post as PostModel;

class Post extends Component
{
    public PostModel $post;

    public function render()
    {
        return view('components.social-media.post');
    }
}
