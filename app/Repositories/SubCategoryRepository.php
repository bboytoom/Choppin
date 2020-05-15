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
            $subcat = SubCategory::create([
                'category_id' => $request->category_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => 1
            ]);

            if (!$subcat) {
                Log::warning('La subcategoria ' . $request->name . ' no se creo');
                return 400;
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la subcategoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateSubCategory(Request $request, $subcategory)
    {
        try {
            $subcat = SubCategory::where('id', $subcategory->id)->update([
                'category_id' => $request->category_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => $request->status
            ]);

            if (!$subcat) {
                Log::warning('La subcategoria ' . $request->name . ' no se actualizo');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la subcategoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteSubCategory($subcategory)
    {
        $subcat = $subcategory->delete();

        if (!$subcat) {
            Log::warning('La subcategoria ' . $subcategory->name . ' no se elimino');
            return 400;
        }

        return 204;
    }
}
