<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class AddressForm extends Component
{

    public $state = [
        'state' => '',
        'city' => '',
    ];

    public $rules = [
        'state.contact' => ['required', 'digits:10'],
        'state.address' => ['required', 'max:191', 'string'],
        'state.state' => ['required', 'max:191', 'string'],
        'state.city' => ['required', 'max:191', 'string'],
        'state.pincode' => ['nullable', 'digits:6', 'string'],
        'state.shipping_details' => ['nullable', 'max:191', 'string'],
    ];

    public $messages = [
        'state.contact.*' => 'Required and fill properly!',
        'state.address.*' => 'Required and fill properly!',
        'state.state.*' => 'Required and fill properly!',
        'state.city.*' => 'Required and fill properly!',
        'state.pincode.*' => 'Required and fill properly!',
        'state.shipping_details.*' => 'Required and fill properly!',
    ];

    public function render()
    {
        return view('components.shop.address-form');
    }

    public function addNewAddress()
    {
        $this->validate();

        auth()->user()
            ->addresses()
            ->create($this->state);

        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'Added new address successfully!'
        ]);
    }
}
