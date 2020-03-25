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
            $categ = Category::create([
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => 1
            ]);

            if ($categ) {
                Log::notice('La categoria ' . $request->name . ' se creo correctamente');
                return 201;
            }

            Log::warning('La categoria ' . $request->name . ' no se creo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al crear una categoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateCategory(Request $request, $category)
    {
        try {
            $categ = Category::where('id', $category->id)->update([
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'description' => empty($request->description) ? '' : e(strtolower($request->description)),
                'status' => e(strtolower($request->status))
            ]);

            if ($categ) {
                Log::notice('La categoria ' . $request->name . ' se actualizo correctamente');
                return 200;
            }

            Log::warning('La categoria ' . $request->name . ' no se actualizo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al actualizar una categoria ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteCategory($category)
    {
        $categ = $category->delete();

        if ($categ) {
            Log::notice('La categoria ' . $category->name . ' se elimino correctamente');
            return 204;
        }

        Log::warning('La categoria ' . $category->name . ' no se elimino');
        return 400;
    }
}
