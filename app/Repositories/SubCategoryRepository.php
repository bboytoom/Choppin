<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryRepository
{
    public function createSubCategory(Request $request)
    {
        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'description' => empty($request->description) ? '' : e(strtolower($request->description)),
            'status' => 1
        ]);

        return 201;
    }

    public function updateSubCategory(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
     
        if(is_null($subcategory)) {
            return 422;
        }

        SubCategory::where('id', $subcategory->id)->update([
            'category_id' => $request->category_id,
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'description' => empty($request->description) ? '' : e(strtolower($request->description)),
            'status' => $request->status
        ]);

        return 200;
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        
        if(is_null($subcategory)) {
            return 422;
        }

        $subcategory->delete();
        return 204;
    }
}
