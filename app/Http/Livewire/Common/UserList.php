<?php

namespace App\Http\Livewire\Common;

use App\Models\User as UserModel;
use App\Traits\CustomWithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class UserList extends Component
{
    use CustomWithPagination;

    public $searchTerm;

    public $currentRoute;

    public $pageName = 'userPage';

    private $dataSources = [
        'users.index' => 'getUsers'
    ];

    public function mount(Request $request)
    {
        $this->searchTerm = $request->get('q');
        $this->currentRoute = Route::currentRouteName();
    }

    public function render()
    {
        $users = $this->{$this->dataSources[$this->currentRoute]}()
            ->simplePaginate(5, ['*'], $this->pageName);

        return view('components.common.user-list', \compact('users'));
    }

    public function getUsers()
    {
        return UserModel::where('name', 'LIKE', "%{$this->searchTerm}%")
            ->orderBy('points', 'DESC');
    }
}
