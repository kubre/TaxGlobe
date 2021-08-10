<?php

namespace App\Http\Livewire\Admin;

use App\Models\TaxDate as TaxDateModel;
use Livewire\Component;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class TaxDateForm extends Component
{

    public $state = [];

    public $taxDateId;

    public $rules = [
        'state.title' => 'required|max:191',
        'state.description' => 'required|max:5000',
        'state.date_at' => 'required|date',
    ];

    public $messages = [
        'state.title.required' => 'Title is required',
        'state.description.required' => 'Description is required',
        'state.date_at.required' => 'Date is required',
        'state.date_at.date' => 'Date field must be Date',
    ];

    public function mount(?TaxDateModel $taxDate)
    {
        if ($taxDate->exists) {
            $this->taxDateId = $taxDate->id;
            $this->state = $taxDate->toArray();
        }
    }

    public function render()
    {
        return view('components.admin.tax-date-form')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function save()
    {
        $this->validate();

        $taxDate = new TaxDateModel();

        if (!is_null($this->taxDateId)) {
            $taxDate = TaxDateModel::find($this->taxDateId);
        }

        $taxDate->fill($this->state)->save();

        $this->dispatchBrowserEvent('toast', [
            'title' => 'Tax Date saved to calendar successfully!',
            'icon' => 'success',
        ]);
    }
}
