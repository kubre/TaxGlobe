<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ReportedPostManagement extends Component
{

    use AuthorizesRequests;

    public function render()
    {
        return view('components.admin.reported-post-management')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $this->emit('refreshLivewireDatatable');

        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Deleted post!'
        ]);
    }
}
