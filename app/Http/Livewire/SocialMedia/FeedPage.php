<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use App\Traits\CustomWithPagination;
use Livewire\Component;
use Livewire\WithPagination;

class FeedPage extends Component
{
    use CustomWithPagination;

    public $pageName = 'postPage';

    public function render()
    {
        $posts = PostModel::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(5, ['*'], $this->pageName);
        return view('components.social-media.feed-page', \compact('posts'));
    }
}
