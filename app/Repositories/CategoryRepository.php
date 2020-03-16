<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryRepository
{
    public function createCategory(Request $request)
    {
        try {
            Category::create([
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => 1
            ]);

            Log::notice('La categoria ' . $request->name . ' se creo correctamente');

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear una categoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
     
        if(is_null($category)) {
            return 422;
        }

        try {
            Category::where('id', $category->id)->update([
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => e(strtolower($request->status))
            ]);

            Log::notice('La categoria ' . $request->name . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar una categoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        
        if(is_null($category)) {
            return 422;
        }

        $category->delete();

        Log::notice('La categoria ' . $category->name . ' se elimino correctamente');
        
        return 204;
    }
}
