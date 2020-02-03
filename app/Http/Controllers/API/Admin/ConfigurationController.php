<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Http\Resources\Configuration\ConfigurationResource;
use App\Http\Resources\Configuration\ConfigurationCollection;
use App\Events\LogoUpdated;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function index()
    {
        return new ConfigurationCollection(Configuration::paginate(10));
    }

    public function show(Configuration $configuration)
    {
        ConfigurationResource::withoutWrapping();
        return new ConfigurationResource($configuration);
    }

    public function update(ConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->update($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new LogoUpdated($configuration->id, $configuration->logo, $request->base, $request->type));
        }

        return response([
            'message' => 'Se actualizò correctamente'
        ], 200);
    }
}
