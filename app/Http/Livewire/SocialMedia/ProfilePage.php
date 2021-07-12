<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\User;
use App\Traits\CustomWithPagination;
use Livewire\Component;
use App\Models\Post as PostModel;
use Livewire\Commands\CopyCommand;

class ProfilePage extends Component
{
    use CustomWithPagination;

    public $pageName = 'postPage';

    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $posts = PostModel::with(['user',
        'likedUsers' => function ($query) {
            return $query->whereId(auth()->id());
        },
        'comments' => function ($query) {
            $query->groupBy('post_id');
        }
        ])
            ->where('user_id', $this->user->id)
            ->orderBy('id', 'DESC')
            ->simplePaginate(5, ['*'], $this->pageName);

        return view('components.social-media.profile-page', \compact('posts'));
    }
}
