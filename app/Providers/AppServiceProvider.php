<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Cache::remember('settings', 86400, function () {
            $settings = null;
            if (!Schema::hasTable('settings')) {
                $settings = Setting::all()
                    ->mapWithKeys(
                        fn ($settings) => [$settings['key'] => $settings['value']]
                    )->toArray();
            }
            return $settings;
        });

        view()->share('settings', $settings);
    }
}
