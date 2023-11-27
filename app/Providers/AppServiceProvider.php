<?php

namespace App\Providers;

use App\Http\Managers\DocumentManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        $this->app->singleton(DocumentManager::class, function (Application $app) {
            return new DocumentManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
