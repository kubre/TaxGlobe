<?php

namespace App\Http\Livewire\SocialMedia;

use App\Traits\CustomWithPagination;
use Livewire\Component;
use App\Models\Post as PostModel;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        'explore.index' => 'getExplorePosts',
        'user.profile' => 'getProfilePosts',
    ];

    /** Stores route name to differentiate between different routes */
    public $routeName;

    public ?User $user;

    public $searchTerm;

    public function mount(Request $request)
    {
        if (!isset($this->user) && Auth::check()) {
            $this->user = Auth::user();
        }
        $this->searchTerm = $request->get('q');
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
            ->when($this->searchTerm, function ($query, $term) {
                $query->where('title', 'LIKE', "%$term%");
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

    public function getProfilePosts()
    {
        return PostModel::with([
            'user',
            'likedUsers' => function ($query) {
                return $query->whereId(auth()->id());
            },
            'comments' => function ($query) {
                $query->groupBy('post_id');
            }
        ])
            ->where('user_id', $this->user->id);
    }
}
