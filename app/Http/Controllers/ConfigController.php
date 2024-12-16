<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConfigurationService;
use App\Http\Requests\UpdateConfigurationRequest;

class ConfigController extends Controller
{
    protected ConfigurationService $service;

    /**
     * ConfigController constructor.
     *
     * @param ConfigurationService $service The configuration service instance.
     */
    public function __construct(ConfigurationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the configuration settings for a specified application.
     *
     * @param \Illuminate\Http\Request $request The HTTP request instance.
     * @return \Illuminate\View\View The view displaying the configuration settings.
     */
    public function show(Request $request)
    {
        $app = $request->get('app', 'default');
        $this->service->loadConfigurations($app);

        return view('config.show', [
            'app_name' => $this->service->getConfiguration('app_name', 'Default App'),
            'configurations' => $this->service->getAllConfigurations(),
        ]);
    }

    /**
     * Update the configuration for a specific application.
     *
     * @param \App\Http\Requests\UpdateConfigurationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateConfigurationRequest $request)
    {
        $app = $request->get('app', 'default');

        $this->service->updateConfiguration($app, $request->input('key'), $request->input('value'));

        return redirect()->route('config.show', ['app' => $app])
            ->with('status', 'Configuration updated successfully.');
    }
}
