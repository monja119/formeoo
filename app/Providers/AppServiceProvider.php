<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Navigation;
use Faker\Provider\Base;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

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
        // sharing data to all application
        View::share('key', 'value');

        //
        Blade::component('package-alert', Alert::class);
        Blade::component('package-navigation', Navigation::class);
        Blade::component('package-base', Base::class);
    }
}
