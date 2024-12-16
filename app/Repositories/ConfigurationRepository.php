<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ConfigurationRepository
{
    /**
     * Retrieve configurations for a given application from the cache or database.
     *
     * @param string $app The name of the application for which to retrieve configurations.
     * @return array An associative array of configuration key-value pairs.
     */
    public function getConfigurations(string $app): array
    {
        return Cache::remember("configurations:{$app}", now()->addMinutes(10), function () use ($app) {
            return DB::table('configurations')
                ->where('app', $app)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Save a configuration value for a given application and key.
     *
     * @param string $app The name of the application.
     * @param string $key The configuration key.
     * @param string $value The configuration value.
     *
     * @throws \InvalidArgumentException If the value is not a string.
     *
     * @return void
     */
    public function saveConfiguration(string $app, string $key, string $value): void
    {
        if (! is_string($value)) {
            throw new \InvalidArgumentException('Value must be a string.');
        }

        DB::table('configurations')->updateOrInsert(
            ['app' => $app, 'key' => $key],
            ['value' => $value]
        );

        Cache::forget("configurations:{$app}");
    }
}
