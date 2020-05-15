<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\PhotoSlideUpdate;
use App\Models\PhotoSlide;

class PhotoSlideRepository
{
    public function createPhotoSlide(Request $request)
    {
        $data = $request->except(['type', 'base']);

        try {
            $photoslide = PhotoSlide::create([
                'configuration_id' =>  $data['configuration_id'],
                'name' => e(strtolower($data['name'])),
                'image' => e(strtolower($data['image'])),
                'description' => empty($data['description']) ? '' : e(strtolower($data['description'])),
                'status' => 1
            ]);

            if (!is_null($request->base)) {
                event(new PhotoSlideUpdate($photoslide->id, $photoslide->image, $request->base, $request->type));
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la imagen del slide principal ' . $data['image'] . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updatePhotoSlide(Request $request, $id)
    {
        $data = $request->except(['type', 'base']);
        $slide = PhotoSlide::find($id);
    
        if (is_null($slide)) {
            return 422;
        }

        try {
            if (!is_null($request->base)) {
                event(new PhotoSlideUpdate($slide->id, $slide->image, $request->base, $request->type));
            }

            PhotoSlide::where('id', $slide->id)->update([
                'name' => e(strtolower($data['name'])),
                'description' => empty($data['description']) ? '' : e(strtolower($data['description'])),
                'status' => $data['status']
            ]);

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la imagen del slide principal ' . $data['image'] . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deletePhotoSlide($id)
    {
        $slide = PhotoSlide::find($id);

        if (is_null($slide)) {
            return 422;
        }

        $slide->delete();
        return 204;
    }
}
