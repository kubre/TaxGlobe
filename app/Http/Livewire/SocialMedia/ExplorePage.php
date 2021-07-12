<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use App\Traits\CustomWithPagination;
use Livewire\Component;

class ExplorePage extends Component
{
    use CustomWithPagination;

    public $pageName = 'postPage';

    public function render()
    {
        $posts = PostModel::when(\auth()->check(), function ($query) {
            $query->with(['likedUsers' => function ($query) {
                $query->whereId(auth()->id());
            }]);
        })
        ->with(['user', 'comments' => function ($query) {
            $query->groupBy('post_id');
        }])
            ->orderBy('like_count', 'DESC')
            ->orderBy('id', 'DESC')
            ->simplePaginate(5, ['*'], $this->pageName);
        return view('components.social-media.explore-page', \compact('posts'));
    }
}
