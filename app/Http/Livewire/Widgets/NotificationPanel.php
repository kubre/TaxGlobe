<?php

namespace App\Http\Livewire\Widgets;

use App\Notifications\OrderStatusUpdated;
use Livewire\Component;
use Illuminate\Support\Str;

class NotificationPanel extends Component
{
    public $isDesktopOnly = true;

    public function render()
    {
        return view('components.widgets.notification-panel');
    }

    public function deleteAll()
    {
        \auth()->user()->notifications()->delete();
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Cleared all notifications!'
        ]);
    }
}
