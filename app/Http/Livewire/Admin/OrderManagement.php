<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
use Livewire\Component;

class OrderManagement extends Component
{
    public function render()
    {
        return view('components.admin.order-management')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function updateStatus($id, $status)
    {
        $order = Order::with('user', 'product')->where('id', $id)->first();
        $order->status = $status;
        $order->save();

        $order->user->notify(new OrderStatusUpdated($order));

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Updated order with status ' . (Order::$statusList[$status] ?? 'Unknown')
        ]);
    }
}
