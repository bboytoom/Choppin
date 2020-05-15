<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Events\LogoUpdated;

class ConfigurationRepository
{
    public function updateConfiguration(Request $request, $configuration)
    {
        try {
            if (!is_null($request->base)) {
                event(new LogoUpdated($configuration->id, $configuration->logo, $request->base, $request->type));
            }

            $conf = Configuration::where('id', $configuration->id)->update([
                'domain' => e(strtolower($request->domain)),
                'name' => e(strtolower($request->name)),
                'business_name' => e(strtolower($request->business_name)),
                'slogan' => empty($request->slogan) ? '' : e(strtolower($request->slogan)),
                'email' => e(strtolower($request->email)),
                'phone' => e(strtolower($request->phone)),
                'cost_shipping' => $request->cost_shipping,
                'status' => 1
            ]);

            if (!$conf) {
                Log::warning('El configuracion no se actualizo');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la configuracion, ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }
}
