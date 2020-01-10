<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageConfigurationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Configuration;

class ImageController extends Controller
{
    public function updateImageConfiguration(ImageConfigurationRequest $request, $id)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            if(!is_null($request->get('logo'))) {
                $name = date('YmdHis_').$request->get('name');
                $base_64toImage = str_replace('data:'. $request->get('type') .';base64,', '', $request->get('logo'));
                $image = base64_decode($base_64toImage);
                
                Configuration::where('id', $id)->update([
                    'logo' => $name
                ]);
                
                Storage::disk('configurations')->put($name, $image);
                
                $imageResize = Image::make(public_path('images/'.$name))->resize(300, 120);
                $imageResize->save(public_path('images/'.$name));

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
