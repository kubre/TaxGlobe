<?php

namespace App\Http\Livewire\SocialMedia;

use App\Traits\CustomWithPagination;
use Livewire\Component;
use App\Models\Post as PostModel;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
        'post.show' => 'getPost',
    ];

    /** Stores route name to differentiate between different routes */
    public $routeName;

    public ?User $user;

    public $searchTerm;

    public $fullPage = false;

    public $postLoadAmount = 10;

    public $pageName = 'postPage';

    public $pinnedPosts;

    public function mount(Request $request)
    {
        if ($request->hasAny(['taxMonth', 'taxYear'])) {
            \redirect()->route('widgets.tax-widget', $request->all());
        }

        if (!isset($this->user) && Auth::check()) {
            $this->user = Auth::user();
        }
        $this->searchTerm = $request->get('q');
        $this->routeName = Route::currentRouteName();
        $this->pinnedPosts = \collect(\json_decode(Cache::get('settings')['pinned_posts'] ?? ''));
    }

    public function render(Request $request)
    {
        $posts = $this->{$this->dataSources[$this->routeName]}()
            ->orderBy('id', 'DESC')
            ->simplePaginate($this->postLoadAmount, ['*'], $this->pageName);
        if (!Cache::has('view')) {
            $this->incrementViewCount($posts);
        }
        Cache::put('view', true, 60);
        return view('components.social-media.post-list', \compact('posts'));
    }

    public function loadMore()
    {
        $this->postLoadAmount += 10;
    }

    public function incrementViewCount($posts)
    {
        DB::table('posts')
            ->whereIn('id', $posts->pluck('id'))
            ->increment('view_count');
    }

    public function delete(PostModel $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $this->emit('postDeleted');
    }

    public function pin($postSlug, $pinTitle)
    {
        $settings = Cache::get('settings');
        if (\is_null($settings)) {
            return
                $this->dispatchBrowserEvent('toast', [
                    'icon' => 'warning',
                    'title' => 'Please login again!',
                ]);
        }

        $pinnedPosts = collect(\json_decode($settings['pinned_posts'] ?? ''));

        if ($pinnedPosts->has($postSlug)) {
            return $this->dispatchBrowserEvent('toast', [
                'icon' => 'info',
                'title' => 'This post is already pinned!',
            ]);
        }

        Setting::upsert([
            'key' => 'pinned_posts',
            'value' => $pinnedPosts->put($postSlug, $pinTitle)->toJson(),
        ], ['key'], ['value']);

        Cache::forget('settings');

        return $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Pined post successfully!',
        ]);
    }

    public function deletePin($postSlug)
    {
        $settings = Cache::get('settings');
        if (\is_null($settings)) {
            return
                $this->dispatchBrowserEvent('toast', [
                    'icon' => 'warning',
                    'title' => 'Please login again!',
                ]);
        }
        $pinnedPosts = collect(\json_decode($settings['pinned_posts'] ?? ''));

        $pinnedPosts->forget($postSlug);

        Setting::upsert([
            'key' => 'pinned_posts',
            'value' => $pinnedPosts->toJson(),
        ], ['key'], ['value']);

        Cache::forget('settings');

        return $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Removed pin successfully!',
        ]);
    }

    public function reportPost(PostModel $post, $reason)
    {
        $post->fill([
            'reported_at' => now(),
            'reported_reason' => $reason,
        ])->save();
        $this->emit('postReported');
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
            }]);
    }

    public function getPost()
    {
        \abort_unless(request()->route('slug'), 404);
        $this->fullPage = true;
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
            ->where('slug', request()->route('slug'));
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
