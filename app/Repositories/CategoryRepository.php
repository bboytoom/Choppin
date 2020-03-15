<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryRepository
{
    public function createCategory(Request $request)
    {
        Category::create([
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'description' => empty($request->description) ? '' : e(strtolower($request->description)),
            'status' => 1
        ]);

        return 201;
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
     
        if(is_null($category)) {
            return 422;
        }

        Category::where('id', $category->id)->update([
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'description' => empty($request->description) ? '' : e(strtolower($request->description)),
            'status' => e(strtolower($request->status))
        ]);

        return 200;
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        
        if(is_null($category)) {
            return 422;
        }
       
        $category->delete();
        return 204;
    }
}
