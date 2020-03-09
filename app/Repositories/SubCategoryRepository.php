<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryRepository
{
    public function createSubCategory(Request $request)
    {
        SubCategory::create($request->all());
        return 201;
    }

    public function updateSubCategory(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
     
        if(is_null($subcategory)) {
            return 422;
        }

        SubCategory::where('id', $subcategory->id)->update($request->all());
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
