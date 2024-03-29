<?php

namespace App\Http\Livewire\Common;

use App\Notifications\UserFollowed;
use Livewire\Component;

class User extends Component
{

    public $user;

    public function render()
    {
        return view('components.common.user');
    }

    public function follow()
    {
        \auth()->user()->toggleFollow($this->user);
        $this->user->notify(new UserFollowed(auth()->user()));
    }
}
