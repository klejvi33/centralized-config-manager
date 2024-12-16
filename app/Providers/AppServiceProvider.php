<?php

namespace App\Providers;

use App\Repositories\CachedConfigurationRepository;
use App\Repositories\ConfigurationRepository;
use App\Services\ConfigurationManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ConfigurationManager::class, function () {
            return ConfigurationManager::getInstance();
        });

        $this->app->bind(ConfigurationRepository::class, CachedConfigurationRepository::class);

        $this->mergeConfigFrom(
            base_path('app/Configs/manager.php'),
            'manager'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
