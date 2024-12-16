<?php

use App\Repositories\ConfigurationRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Test case to verify that configurations are retrieved from cache if available.
 *
 * This test mocks the Cache facade to ensure that the `remember` method is called
 * once with the expected parameters and returns a predefined configuration array.
 * It then asserts that the `getConfigurations` method of the `ConfigurationRepository`
 * class returns the expected configuration array.
 *
 * @return void
 */
it('retrieves configurations from cache if available', function () {
    // Arrange
    Cache::shouldReceive('remember')
        ->once()
        ->with('configurations:default', \Mockery::type('Illuminate\Support\Carbon'), \Mockery::type('Closure'))
        ->andReturnUsing(function () {
            return ['key' => 'value'];
        });

    $repository = new ConfigurationRepository;

    // Act
    $result = $repository->getConfigurations('default');

    // Assert
    expect($result)->toEqual(['key' => 'value']);
});

/**
 * Test case for saving configuration which updates the database and clears the cache.
 *
 * This test ensures that when a configuration is saved:
 * - The cache is cleared for the specific configuration key.
 * - The database is updated or a new record is inserted with the given configuration.
 *
 * @return void
 */
it('saves configuration updates database and clears cache', function () {
    // Arrange
    Cache::shouldReceive('forget')->once()->with('configurations:default');
    DB::shouldReceive('table->updateOrInsert')
        ->once()
        ->with(
            ['app' => 'default', 'key' => 'key'],
            ['value' => 'value']
        );
    $repository = new ConfigurationRepository;

    // Act
    $repository->saveConfiguration('default', 'key', 'value');

    // Assert
    expect(true)->toBeTrue();
});
