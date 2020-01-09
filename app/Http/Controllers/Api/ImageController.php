<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Configuration;

class ImageController extends Controller
{
    public function updateImageConfiguration(Request $request, $id)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            if(!is_null($request->get('logo'))) {
                $name = date('YmdHis_').$request->get('name');
                $image = base64_decode(str_replace('data:image/png;base64,', '', $request->get('logo')));
                
                Configuration::where('id', $id)->update([
                    'logo' => $name
                ]);
                
                Storage::disk('configurations')->put($name, $image);

                return response(null, 200);
            } else {
                abort(404);
            }
        }
        else {
            abort(401);
        }
    }
}
