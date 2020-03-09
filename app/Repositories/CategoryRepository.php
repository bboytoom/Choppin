<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryRepository
{
    public function createCategory(Request $request)
    {
        Category::create($request->all());
        return 201;
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
     
        if(is_null($category)) {
            return 422;
        }

        Category::where('id', $category->id)->update($request->all());
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
