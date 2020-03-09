<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Events\LogoUpdated;

class ConfigurationRepository
{
    public function updateConfiguration(Request $request, $id)
    {
        $configuration = Configuration::find($id);

        if(is_null($configuration)) {
            return 422;
        }

        if (!is_null($request->base)) {
            event(new LogoUpdated($configuration->id, $configuration->logo, $request->base, $request->type));
        }

        Configuration::where('id', $configuration->id)->update($request->except(['type', 'base']));
        return 200;
    }
}
