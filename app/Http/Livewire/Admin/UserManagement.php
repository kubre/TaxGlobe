<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public function render()
    {
        return view('components.admin.user-management')
            ->layout('layouts.admin')
            ->slot('content');
    }


    public function deleteUser(User $user)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $user->delete();
        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Deleted user!'
        ]);
    }
}
