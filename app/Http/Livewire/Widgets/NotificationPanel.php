<?php

namespace App\Http\Livewire\Widgets;

use App\Notifications\OrderStatusUpdated;
use Livewire\Component;
use Illuminate\Support\Str;

class NotificationPanel extends Component
{
    public function render()
    {
        $notifications = $this->getNotifications();
        return view('components.widgets.notification-panel', \compact('notifications'));
    }

    private function getNotifications()
    {
        return auth()->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(
                fn ($n) => $this->{'format' . Str::afterLast($n->type, '\\')}($n)
            );
    }

    public function deleteAll()
    {
        \auth()->user()->notifications()->delete();
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Cleared all notifications!'
        ]);
    }

    public function formatOrderStatusUpdated($notification)
    {
        return (object)[
            'message' => "Status for order {$notification->data['product_title']} has been updated to \"{$notification->data['order_status']}\"",
            'time' => $notification->created_at->diffForHumans(null, false, true),
            'action' => route('shop.order.receipt', $notification->data['order_id']),
        ];
    }
}
