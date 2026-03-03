<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            try {
                \Illuminate\Support\Facades\View::share('siteSetting', \App\Models\SiteSetting::first());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\View::share('siteSetting', null);
            }
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('footer_settings')) {
            try {
                \Illuminate\Support\Facades\View::share('footerSetting', \App\Models\FooterSetting::first());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\View::share('footerSetting', null);
            }
        }
    }
}
