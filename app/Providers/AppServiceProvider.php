<?php

namespace App\Providers;

use App\Services\ThermalPrinterService;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ThermalPrinterService::class, function ($app) {
            return new ThermalPrinterService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('thermal-printer', asset('js/thermal-printer.js'))->loadedOnRequest(),
        ]);
    }
}
