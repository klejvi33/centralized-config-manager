# Configuration Management System

This project is a Laravel-based configuration management system that allows you to manage application configurations dynamically.

## Features

- Retrieve and update configurations for different applications.
- Cache configurations for improved performance.
- Singleton pattern for configuration management.
- Database seeding for initial configuration setup.

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy the example environment file and configure it:
    ```bash
    cp .env.example .env
    ```

4. Start the development environment using Laravel Sail:
    ```bash
    ./vendor/bin/sail up
    ```

5. Generate an application key:
    ```bash
   ./vendor/bin/sail php artisan key:generate
    ```

6. Run the database migrations and seeders:
    ```bash
   ./vendor/bin/sail php artisan migrate --seed
    ```

## Usage

### Routes

- `GET /config`: Displays the configuration settings.
- `POST /config/update`: Updates the configuration settings.

### Example

To update a configuration, send a POST request to `/config/update` with the following parameters:

- `app`: The name of the application.
- `key`: The configuration key.
- `value`: The new value for the configuration key.

## Testing

Run the following command to execute the test suite:
```bash
./vendor/bin/sail test
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
