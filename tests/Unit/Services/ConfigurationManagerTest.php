<?php

use App\Services\ConfigurationManager;

/**
 * Test to ensure that the ConfigurationManager class implements the Singleton pattern.
 * This test verifies that multiple calls to ConfigurationManager::getInstance() return the same instance.
 *
 * @return void
 */
it('tests singleton instance', function () {
    // Arrange
    $manager1 = ConfigurationManager::getInstance();

    // Act
    $manager2 = ConfigurationManager::getInstance();

    // Assert
    expect($manager1)->toBe($manager2);
});

/**
 * Test case for loading configurations and retrieving them from the ConfigurationManager.
 *
 * This test verifies that configurations can be loaded into the ConfigurationManager
 * and subsequently retrieved. It also checks the behavior when attempting to retrieve
 * a non-existing configuration key.
 *
 * @return void
 */
it('tests load configurations and retrieve them', function () {
    // Arrange
    $manager = ConfigurationManager::getInstance();
    $configurations = ['key' => 'value'];

    // Act
    $manager->loadConfigurations($configurations);
    $retrievedValue = $manager->get('key');
    $nonExistingValue = $manager->get('non_existing_key');

    // Assert
    expect($retrievedValue)->toBe('value');
    expect($nonExistingValue)->toBeNull();
});
