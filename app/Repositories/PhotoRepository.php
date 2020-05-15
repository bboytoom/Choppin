<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\PhotoImageUpdated;
use App\Models\Photo;

class PhotoRepository
{
    public function createPhoto(Request $request)
    {
        $data = $request->except(['type', 'base']);

        try {
            $photo = Photo::create([
                'product_id' =>  $data['product_id'],
                'name' => e(strtolower($data['name'])),
                'image' => e(strtolower($data['image'])),
                'description' => empty($data['description']) ? '' : e(strtolower($data['description'])),
                'status' => 1
            ]);

            if (!is_null($request->base)) {
                event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la imagen del producto ' . $data['image'] . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updatePhoto(Request $request, $id)
    {
        $data = $request->except(['type', 'base']);
        $photo = Photo::find($id);
    
        if (is_null($photo)) {
            return 422;
        }

        try {
            if (!is_null($request->base)) {
                event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
            }

            Photo::where('id', $photo->id)->update([
                'product_id' =>  $data['product_id'],
                'name' => e(strtolower($data['name'])),
                'description' => empty($data['description']) ? '' : e(strtolower($data['description'])),
                'status' => $data['status']
            ]);

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la imagen del producto ' . $data['image'] . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deletePhoto($id)
    {
        $photo = Photo::find($id);

        if (is_null($photo)) {
            return 422;
        }

        $photo->delete();
        return 204;
    }
}
