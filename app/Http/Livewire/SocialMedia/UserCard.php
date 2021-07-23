<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public ?User $user;

    public $followersCount;

    public $followingsCount;

    public $postsCount;

    // public $likesCount;

    // public $commentsCount;

    public function mount()
    {
        if (is_null($this->user)) {
            return;
        }
        $this->user->loadCount('followers', 'followings', 'posts');
        // $this->user->loadSum('posts', 'like_count');
        // $this->user->loadSum('posts', 'comment_count');
        $this->followersCount = $this->user->followers_count;
        $this->followingsCount = $this->user->followings_count;
        $this->postsCount = $this->user->posts_count;
        // $this->likesCount = $this->user->posts_sum_like_count;
        // $this->likesCount = $this->user->posts_sum_like_count;
        
        // dd($this->user);
    }

    public function render()
    {
        return view('components.social-media.user-card');
    }

    public function follow()
    {
        \auth()->user()->toggleFollow($this->user);

        $this->user->loadCount('followers');

        $this->followersCount = $this->user->followers_count;
    }
}
