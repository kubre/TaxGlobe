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
        if (auth()->user()->isAdmin()) {
            $user->delete();
            $this->emit('refreshLivewireDatatable');
            $this->dispatchBrowserEvent('userDeleted');
        }
    }
}
