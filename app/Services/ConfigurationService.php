<?php

namespace App\Services;

use App\Repositories\ConfigurationRepository;

class ConfigurationService
{
    protected ConfigurationRepository $repository;

    protected ConfigurationManager $manager;

    /**
     * ConfigurationService constructor.
     *
     * @param ConfigurationRepository $repository The repository instance for configuration data.
     * @param ConfigurationManager $manager The manager instance for handling configuration operations.
     */
    public function __construct(ConfigurationRepository $repository, ConfigurationManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Loads configurations for the specified application.
     *
     * @param string $app The name of the application for which to load configurations.
     *
     * @return void
     */
    public function loadConfigurations(string $app): void
    {
        $configurations = $this->repository->getConfigurations($app);
        $this->manager->loadConfigurations($configurations);
    }

    /**
     * Retrieve the configuration value for the given key.
     *
     * @param string $key The configuration key to retrieve.
     * @param mixed $default The default value to return if the key does not exist.
     * @return mixed The configuration value associated with the key, or the default value if the key does not exist.
     */
    public function getConfiguration(string $key, $default = null)
    {
        return $this->manager->get($key, $default);
    }

    /**
     * Retrieve all configurations.
     *
     * @return array An array of all configurations.
     */
    public function getAllConfigurations(): array
    {
        return $this->manager->getAll();
    }

    /**
     * Updates the configuration for a given application and key.
     *
     * @param string $app The name of the application.
     * @param string $key The configuration key to update.
     * @param mixed $value The new value for the configuration key.
     * @return void
     */
    public function updateConfiguration(string $app, string $key, $value): void
    {
        $this->repository->saveConfiguration($app, $key, $value);
        $this->loadConfigurations($app);
    }
}
