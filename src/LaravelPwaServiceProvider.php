<?php

namespace Jonnx\LaravelPwa;

use Illuminate\Support\ServiceProvider;

class LaravelPwaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pwa');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ], 'laravel-pwa-views');

        $this->publishes([
            __DIR__.'/../config/pwa.php' => config_path('pwa.php'),
        ], 'laravel-pwa-config');

        // Register PWA asset routes
        \Illuminate\Support\Facades\Route::get('/pwa/manifest.json', [
            \Jonnx\LaravelPwa\Http\Controllers\PwaAssetController::class, 'manifest'
        ])->name('pwa.manifest');

        \Illuminate\Support\Facades\Route::get('/pwa/service-worker.js', [
            \Jonnx\LaravelPwa\Http\Controllers\PwaAssetController::class, 'serviceWorker'
        ])->name('pwa.service-worker');

        \Illuminate\Support\Facades\Route::get('/pwa/offline', [
            \Jonnx\LaravelPwa\Http\Controllers\PwaAssetController::class, 'offline'
        ])->name('pwa.offline');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
