<?php

namespace Jonnx\LaravelPwa;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaravelPwaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Register Blade components namespace for package
        $this->loadViewComponentsAs('pwa', [
            \Jonnx\LaravelPwa\View\Components\PushNotificationBanner::class,
        ]);
        // Register Livewire component for package
        if (class_exists('Livewire\\Livewire')) {
            \Livewire\Livewire::component('push-notification-subscription-handler', \Jonnx\LaravelPwa\Http\Livewire\PushNotificationSubscriptionHandler::class);
        }
        
        // Register @laravelPwaScripts Blade directive
        Blade::directive('laravelPwaScripts', function () {
            return "<?php echo view('pwa::scripts')->render(); ?>";
        });

        // Register @laravelPwaHead Blade directive
        Blade::directive('laravelPwaHead', function () {
            return "<?php echo view('pwa::head')->render(); ?>";
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pwa');

        $this->publishes([
            __DIR__.'/../config/pwa.php' => config_path('pwa.php'),
        ], 'laravel-pwa-config');

        // Register PWA asset routes
        \Illuminate\Support\Facades\Route::get('/manifest.json', [
            \Jonnx\LaravelPwa\Http\Controllers\PwaAssetController::class, 'manifest'
        ])->name('pwa.manifest');

        \Illuminate\Support\Facades\Route::get('/sw.js', [
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
