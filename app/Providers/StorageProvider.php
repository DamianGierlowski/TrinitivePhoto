<?php

namespace App\Providers;

use App\Services\StorageService;
use Illuminate\Support\ServiceProvider;

class StorageProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StorageService::class, function ($app) {
            return new StorageService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
