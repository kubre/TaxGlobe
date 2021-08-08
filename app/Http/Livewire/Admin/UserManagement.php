<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class UserManagement extends Component
{
    public function render()
    {
        return view('components.admin.user-management')
            ->layout('layouts.admin')
            ->slot('content');
    }
}
