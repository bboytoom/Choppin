<?php

namespace App\Http\Controllers\API\Admin;

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
        $configuration = Configuration::find($id);

        if (!is_null($configuration) and !is_null($request->logo)) {
            $name = date('YmdHis_').$request->name;

            $this->uploadImage($request, $id, $name);
        } else {
            abort(404);
        }
    }

    private function uploadImage(ImageConfigurationRequest $request, $id, $name)
    {
        $base_64toImage = str_replace('data:'. $request->type .';base64,', '', $request->logo);
        $image = base64_decode($base_64toImage);
                
        Configuration::where('id', $id)->update([
            'logo' => $name
        ]);
                
        Storage::disk('configurations')->put($name, $image);
            
        $imageResize = Image::make(public_path('storage/images/'.$name))->resize(300, 120);
        $imageResize->save(public_path('storage/images/'.$name));

        return response(null, 200);
    }
}
