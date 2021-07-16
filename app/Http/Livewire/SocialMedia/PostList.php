<?php

namespace App\Http\Livewire\SocialMedia;

use App\Traits\CustomWithPagination;
use Livewire\Component;
use App\Models\Post as PostModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;

class PostList extends Component
{
    use CustomWithPagination;
    use AuthorizesRequests;

    protected $listeners = [
        'postDeleted' => '$refresh',
    ];

    public $dataSources = [
        'feed.index' => 'getFeedPosts',
        'explore.index' => 'getExplorePosts'
    ];

    /** Stores route name to differentiate between different routes */
    public $routeName;

    public function mount()
    {
        $this->routeName = Route::currentRouteName();
    }

    public $pageName = 'postPage';

    public function render()
    {
        return view('components.social-media.post-list', [
            'posts' => $this->{$this->dataSources[$this->routeName]}()
                ->orderBy('id', 'DESC')
                ->simplePaginate(5, ['*'], $this->pageName),
        ]);
    }

    public function delete(PostModel $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $this->emit('postDeleted');
    }

    public function getExplorePosts()
    {
        return PostModel::when(\auth()->check(), function ($query) {
            $query->with(['likedUsers' => function ($query) {
                $query->whereId(auth()->id());
            }]);
        })
            ->with(['user', 'comments' => function ($query) {
                $query->groupBy('post_id');
            }])
            ->orderBy('like_count', 'DESC');
    }

    public function getFeedPosts()
    {
        return PostModel::whereHas('user', function ($query) {
            $query->whereIn('id', \auth()->user()->followings()->pluck('following_id')->add(\auth()->id())->toArray());
        })
            ->with([
                'user',
                'likedUsers' => function ($query) {
                    return $query->whereId(auth()->id());
                },
                'comments' => function ($query) {
                    $query->groupBy('post_id');
                }
            ]);
    }
}
