<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use App\Traits\CustomWithPagination;
use Livewire\Component;

class FeedPage extends Component
{
    use CustomWithPagination;

    public $pageName = 'postPage';

    protected $listeners = [
        'toggledLike' => '$refresh',
        // 'commentsChanged' => '$refresh',
    ];

    public function render()
    {
        // @todo Change how like count is loaded
        $posts = PostModel::with(['user', 'likedUsers' => function ($query) {
            return $query->whereId(auth()->id());
        }])
            // ->withCount('comments', 'likedUsers')
            ->orderBy('id', 'DESC')
            ->paginate(5, ['*'], $this->pageName);

        return view('components.social-media.feed-page', \compact('posts'));
    }
}
