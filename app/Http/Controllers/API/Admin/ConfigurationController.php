<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Http\Resources\Configuration\ConfigurationResource;
use App\Http\Resources\Configuration\ConfigurationCollection;
use App\Repositories\ConfigurationRepository;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    protected $config;

    public function __construct(ConfigurationRepository $config)
    {
        $this->config = $config;
    }

    public function index()
    {
        return new ConfigurationCollection(Configuration::paginate(10));
    }

    public function show(Configuration $configuration)
    {
        ConfigurationResource::withoutWrapping();
        return new ConfigurationResource($configuration);
    }

    public function update(ConfigurationRequest $request, $id)
    {
        return response(null, $this->config->updateConfiguration($request, $id));
    }
}
