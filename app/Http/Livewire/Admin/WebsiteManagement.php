<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class WebsiteManagement extends Component
{
    public $settings = [
        'banner' => '',
        'shipping_cost' => 0,
    ];

    public $rules = [
        'settings.banner' => 'required|max:1000',
        'settings.shipping_cost' => 'required|numeric|min:0',
    ];

    public $messages = [
        'settings.banner.required' => 'Banner on the website is required',
        'settings.shipping_cost.required' => 'Shipping cost for deliverable products is required',
        'settings.shipping_cost.numeric' => 'Shipping cost must be a number',
    ];

    public function mount()
    {
        $this->settings = \array_merge($this->settings, Setting::all()
            ->mapWithKeys(
                fn ($settings) => [$settings['key'] => $settings['value']]
            )->toArray());
    }

    public function render()
    {
        return view('components.admin.website-management')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function updateBasicSettings()
    {
        $this->validate();

        $data = collect($this->settings)->map(fn ($value, $key) => [
            'key' => $key,
            'value' => $value,
        ])->values()->toArray();

        Setting::upsert($data, ['key'], ['value']);

        Cache::forget('settings');

        $this->dispatchBrowserEvent('toast', [
            'title' => 'Updated settings successfully!',
            'icon' => 'success',
        ]);
    }
}
