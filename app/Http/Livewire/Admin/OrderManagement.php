<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
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
        Order::where('id', $id)
            ->update([
                'status' => $status,
            ]);

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Updated order with status ' . (Order::$statusList[$status] ?? 'Unknown')
        ]);
    }
}
