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
        'user.bookmarks' => 'getBookmarkedPosts',
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
            $authId = auth()->id();
            $query->with([
                'likedUsers' => function ($query) use ($authId) {
                    $query->whereId($authId);
                },
                'bookmarkedUsers' => function ($query) use ($authId) {
                    $query->whereId($authId);
                },
            ]);
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
        $authId = \auth()->id();
        return PostModel::whereHas('user', function ($query) use ($authId) {
            $query->whereIn('id', \auth()->user()->followings()->pluck('following_id')->add($authId)->toArray());
        })
            ->with([
                'user',
                'likedUsers' => function ($query) use ($authId) {
                    return $query->whereId($authId);
                },
                'bookmarkedUsers' => function ($query) use ($authId) {
                    $query->whereId($authId);
                },
                'comments' => function ($query) {
                    $query->groupBy('post_id');
                }
            ]);
    }

    public function getProfilePosts()
    {
        $authId = auth()->id();
        return PostModel::with([
            'user',
            'likedUsers' => function ($query) use ($authId) {
                return $query->whereId($authId);
            },
            'bookmarkedUsers' => function ($query) use ($authId) {
                $query->whereId($authId);
            },
            'comments' => function ($query) {
                $query->groupBy('post_id');
            }
        ])->where('user_id', $this->user->id);
    }

    public function getBookmarkedPosts()
    {
        $authId = auth()->id();
        \abort_unless($this->user->id === $authId, 403);
        return auth()->user()->bookmarkedPosts()->with([
            'user',
            'likedUsers' => function ($query) use ($authId) {
                return $query->whereId($authId);
            },
            'bookmarkedUsers' => function ($query) use ($authId) {
                $query->whereId($authId);
            },
            'comments' => function ($query) {
                $query->groupBy('post_id');
            }
        ]);
    }
}
