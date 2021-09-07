<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $statistics = [];

    public $orders;

    public function mount()
    {
        $this->orders = Order::where('status', 'success')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
    }

    public function render()
    {
        $this->statistics['total_posts'] = Post::count();
        $this->statistics['total_users'] = User::where('role', User::ROLE_USER)->count();
        $this->statistics['total_admins'] = User::where('role', User::ROLE_ADMIN)->count();

        return view('components.admin.dashboard')
            ->layout('layouts.admin')
            ->slot('content');
    }
}
