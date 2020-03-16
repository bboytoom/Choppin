<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryRepository
{
    public function createSubCategory(Request $request)
    {
        try {
            SubCategory::create([
                'category_id' => $request->category_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => 1
            ]);

            Log::notice('La subcategoria ' . $request->name . ' se creo correctamente');

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la subcategoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updateSubCategory(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
     
        if(is_null($subcategory)) {
            return 422;
        }

        try {
            SubCategory::where('id', $subcategory->id)->update([
                'category_id' => $request->category_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => $request->status
            ]);

            Log::notice('La subcategoria ' . $request->name . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la subcategoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        
        if(is_null($subcategory)) {
            return 422;
        }

        $subcategory->delete();
        
        Log::notice('La subcategoria ' . $subcategory->name . ' se elimino correctamente');

        return 204;
    }
}
