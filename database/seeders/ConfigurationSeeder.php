<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::factory()->createMany([
            [
                'app' => 'default',
                'key' => 'app_name',
                'value' => 'Default App',
            ],
            [
                'app' => 'default',
                'key' => 'theme_color',
                'value' => '#1E3A8A',
            ],
        ]);
    }
}
