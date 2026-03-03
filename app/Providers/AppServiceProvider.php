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
        // Cache site settings for 1 hour to reduce DB hits
        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            try {
                $siteSetting = \Illuminate\Support\Facades\Cache::remember('site_setting', 3600, function () {
                    return \App\Models\SiteSetting::first();
                });
                \Illuminate\Support\Facades\View::share('siteSetting', $siteSetting);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\View::share('siteSetting', null);
            }
        }

        // Cache footer settings
        if (\Illuminate\Support\Facades\Schema::hasTable('footer_settings')) {
            try {
                $footerSetting = \Illuminate\Support\Facades\Cache::remember('footer_settings', 3600, function () {
                    return \App\Models\FooterSetting::first();
                });
                \Illuminate\Support\Facades\View::share('footerSetting', $footerSetting);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\View::share('footerSetting', null);
            }
        }

        // Share notice existence to avoid redundant checks in header/hero
        if (\Illuminate\Support\Facades\Schema::hasTable('notices')) {
            try {
                $hasNotices = \Illuminate\Support\Facades\Cache::remember('notices_exist', 600, function () {
                    return \App\Models\Notice::active()->exists();
                });
                \Illuminate\Support\Facades\View::share('hasNotices', $hasNotices);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\View::share('hasNotices', false);
            }
        }
    }
}
