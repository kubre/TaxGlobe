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

    public ?UserModel $user;

    private $dataSources = [
        'users.index' => 'getUsers',
        'users.followers' => 'getFollowers',
        'users.followings' => 'getFollowings',
        'users.suggestions' => 'getSuggestions',
    ];

    public function mount(Request $request)
    {
        $this->searchTerm = $request->get('q');
        $this->currentRoute = Route::currentRouteName();
        $this->user = request()->route('user');
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

    public function getFollowers()
    {
        return $this->user->followers()
            ->orderBy('name');
    }

    public function getFollowings()
    {
        return $this->user->followings()
            ->orderBy('name');
    }

    public function getSuggestions()
    {
        abort_unless(auth()->id() === $this->user->id, 403);
        return UserModel::inRandomOrder()
            ->where('id', '!=', $this->user->id);
    }
}
