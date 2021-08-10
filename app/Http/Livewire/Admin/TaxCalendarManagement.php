<?php

namespace App\Http\Livewire\Admin;

use App\Models\TaxDate;
use Livewire\Component;

class TaxCalendarManagement extends Component
{
    public function render()
    {
        return view('components.admin.tax-calendar-management')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function deleteDate(TaxDate $taxDate)
    {
        // $this->authorize('delete', $taxDate);
        $taxDate->delete();
        $this->emit('refreshLivewireDatatable');
    }
}
