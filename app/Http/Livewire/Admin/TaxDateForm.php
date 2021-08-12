<?php

namespace App\Http\Livewire\Admin;

use App\Models\TaxDate as TaxDateModel;
use Livewire\Component;

class TaxDateForm extends Component
{
    public $state = [];

    public $previousCategories = [];

    public $taxDateId;

    public $rules = [
        'state.title' => 'required|max:191',
        'state.description' => 'required|max:5000',
        'state.date_at' => 'required|date',
        'state.category' => 'nullable|string',
    ];

    public $messages = [
        'state.title.required' => 'Title is required',
        'state.description.required' => 'Description is required',
        'state.date_at.required' => 'Date is required',
        'state.date_at.date' => 'Date field must be Date',
        'state.category.string' => 'Category must be a valid value',
    ];

    public function mount(?TaxDateModel $taxDate)
    {
        if ($taxDate->exists) {
            $this->taxDateId = $taxDate->id;
            $this->state = $taxDate->toArray();
        }
        $this->previousCategories = TaxDateModel::whereNotNull('category')->pluck('category')->toArray();
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

        if (isset($this->state['category'])) {
            $this->state['category'] = \strtoupper($this->state['category']);

            if (empty(trim($this->state['category']))) {
                $this->state['category'] = null;
            }
        }

        $taxDate->fill($this->state)->save();

        $this->dispatchBrowserEvent('toast', [
            'title' => 'Tax Date saved to calendar successfully!',
            'icon' => 'success',
        ]);
    }
}
