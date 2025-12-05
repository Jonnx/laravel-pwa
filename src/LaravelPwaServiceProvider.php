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
        $this->publishes([
            __DIR__.'/../config/pwa.php' => config_path('pwa.php'),
        ], 'laravel-pwa-config');

        $this->publishes([
            __DIR__.'/../resources/views/components/pwa' => resource_path('views/components/pwa'),
        ], 'laravel-pwa-components');

        $this->registerBladeDirectives();
        $this->registerComponents();
        $this->registerRoutes();
       
    }

    public function registerComponents()
    {
        // RESOURCE HINTS
        $this->loadViewsFrom([
            resource_path('views/vendor/pwa'),
            __DIR__.'/../resources/views'
        ], 'pwa');

        // LIVEWIRE COMPONENTS
        if (class_exists('Livewire\\Livewire')) {
            \Livewire\Livewire::component('push-notification-subscription-handler', \Jonnx\LaravelPwa\Http\Livewire\PushNotificationSubscriptionHandler::class);
        }
    }

    public function registerBladeDirectives()
    {
        // Register @laravelPwaScripts Blade directive
        // Usage: @laravelPwaScripts
        // This will include all the necessary PWA scripts
        Blade::directive('laravelPwaScripts', function () {
            return "<?php echo view('pwa::scripts')->render(); ?>";
        });

        // Register @laravelPwaHead Blade directive
        // Usage: @laravelPwaHead
        // This will include all the necessary PWA head elements
        Blade::directive('laravelPwaHead', function () {
            return "<?php echo view('pwa::head')->render(); ?>";
        });
    }

    protected function registerRoutes()
    {
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
