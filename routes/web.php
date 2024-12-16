<?php

use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Define routes for the configuration management.
     *
     * Prefix: 'config'
     * Name: 'config.'
     *
     * Routes:
     * - GET '/' : Displays the configuration settings.
     *   - Controller: ConfigController
     *   - Method: show
     *   - Route Name: config.show
     *
     * - POST '/update' : Updates the configuration settings.
     *   - Controller: ConfigController
     *   - Method: update
     *   - Route Name: config.update
     */
    Route::prefix('config')->name('config.')->group(function () {
        Route::get('/', [ConfigController::class, 'show'])->name('show');
        Route::post('/update', [ConfigController::class, 'update'])->name('update');
    });
});
