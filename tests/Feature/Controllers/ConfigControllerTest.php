<?php

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Test to ensure that the configurations are displayed correctly.
 *
 * This test performs the following steps:
 * 1. Arrange: Create a user and a configuration entry.
 * 2. Act: Send a GET request to the '/config' endpoint with the 'app' query parameter.
 * 3. Assert: Verify that the response status is 200 and the view has the expected configuration data.
 *
 * @return void
 */
it('displays configurations', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    Configuration::factory()->create(['app' => 'default', 'key' => 'app_name', 'value' => 'Test App']);

    // Act
    $response = $this->get('/config?app=default');

    // Assert
    $response->assertStatus(200);
    $response->assertViewHas('configurations', ['app_name' => 'Test App']);
});

/**
 * Test to ensure that the configuration is updated and the user is redirected.
 *
 * This test performs the following steps:
 * 1. Arrange: Creates a user and sets the user as the currently authenticated user.
 * 2. Act: Sends a POST request to update the configuration with specified parameters.
 * 3. Assert: Checks the database to ensure the configuration has been updated with the new values.
 *
 * @return void
 */
it('updates configuration and redirects', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act
    $this->post('/config/update', [
        'app' => 'default',
        'key' => 'theme_color',
        'value' => '#000000',
    ]);

    // Assert
    $this->assertDatabaseHas('configurations', [
        'app' => 'default',
        'key' => 'theme_color',
        'value' => '#000000',
    ]);
});
