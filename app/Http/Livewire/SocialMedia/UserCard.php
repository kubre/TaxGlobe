<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public User $user;

    public $followersCount;

    public $followingsCount;

    public $postsCount;

    public function mount()
    {
        $this->user->loadCount('followers', 'followings', 'posts');
        $this->followersCount = $this->user->followers_count;
        $this->followingsCount = $this->user->followings_count;
        $this->postsCount = $this->user->posts_count;
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
