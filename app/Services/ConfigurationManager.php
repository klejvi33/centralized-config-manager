<?php

namespace App\Services;

class ConfigurationManager
{
    /**
     * The single instance of the ConfigurationManager.
     */
    private static ?self $instance = null;

    /**
     * @var array
     *
     * This property holds the configuration settings for the application.
     */
    private array $configurations = [];

    /**
     * Private constructor to prevent instantiation of the ConfigurationManager class.
     * This ensures that the class follows the singleton pattern.
     */
    private function __construct() {}

    /**
     * Returns the singleton instance of the ConfigurationManager.
     *
     * @return self The singleton instance of the ConfigurationManager.
     */
    public static function getInstance(): self
    {
        if (! self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Singletons should not be cloneable.
     */
    private function __clone() {}

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    /**
     * Load configurations into the ConfigurationManager.
     *
     * @param  array  $configurations  An associative array of configuration settings.
     */
    public function loadConfigurations(array $configurations): void
    {
        $this->configurations = $configurations;
    }

    /**
     * Retrieve the configuration value for the given key.
     *
     * @param  string  $key  The configuration key to retrieve.
     * @param  mixed  $default  The default value to return if the key does not exist.
     * @return mixed The configuration value associated with the key, or the default value if the key does not exist.
     */
    public function get(string $key, $default = null)
    {
        return $this->configurations[$key] ?? $default;
    }

    /**
     * Retrieve all configurations.
     *
     * @return array An array of all configurations.
     */
    public function getAll(): array
    {
        return $this->configurations;
    }
}
