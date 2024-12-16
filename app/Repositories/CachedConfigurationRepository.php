<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CachedConfigurationRepository extends ConfigurationRepository
{
    protected int $cacheDuration;

    /**
     * CachedConfigurationRepository constructor.
     *
     * Initializes the repository by setting the cache duration from the configuration.
     */
    public function __construct()
    {
        $this->cacheDuration = config('manager.configuration_cache_duration');
    }

    /**
     * Retrieve configurations for the specified application from the cache.
     *
     * @param string $app The name of the application for which configurations are to be retrieved.
     * @return array The configurations for the specified application.
     */
    public function getConfigurations(string $app): array
    {
        return Cache::remember("configurations:{$app}", now()->addMinutes($this->cacheDuration), function () use ($app) {
            return parent::getConfigurations($app);
        });
    }

    /**
     * Save the configuration value for a given application and key.
     *
     * @param string $app The name of the application.
     * @param string $key The configuration key.
     * @param mixed $value The configuration value to be saved.
     *
     * @return void
     */
    public function saveConfiguration(string $app, string $key, $value): void
    {
        parent::saveConfiguration($app, $key, $value);
        Cache::forget("configurations:{$app}");
    }
}
