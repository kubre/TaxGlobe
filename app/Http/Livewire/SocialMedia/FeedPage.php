<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use App\Traits\CustomWithPagination;
use Livewire\Component;

class FeedPage extends Component
{
    use CustomWithPagination;

    public $pageName = 'postPage';

    public function render()
    {
        // Fetches latest post from followings and self
        $posts = PostModel::whereHas('user', function ($query) {
            $query->whereIn('id', \auth()->user()->followings()->pluck('following_id')->add(\auth()->id())->toArray());
        })
        ->with(['user',
        'likedUsers' => function ($query) {
            return $query->whereId(auth()->id());
        },
        'comments' => function ($query) {
            $query->groupBy('post_id');
        }])
            ->orderBy('id', 'DESC')
            ->simplePaginate(5, ['*'], $this->pageName);
        return view('components.social-media.feed-page', \compact('posts'));
    }
}
