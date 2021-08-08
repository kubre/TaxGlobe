<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class WebsiteManagement extends Component
{
    public $settings = [
        'banner' => '',
    ];

    public $rules = [
        'settings.banner' => 'required|max:1000',
    ];

    public $messages = [
        'settings.banner.required' => 'Banner on the website is required',
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
