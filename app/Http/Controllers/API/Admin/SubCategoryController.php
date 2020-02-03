<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Http\Resources\SubCategory\SubCategoryCollection;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::whereHas('category', function ($subCategoriesEstatus) {
            $subCategoriesEstatus->where('status', 1); 
        })->paginate(10);

        return new SubCategoryCollection($subCategories);
    }

    public function store(SubCategoryRequest $request)
    {
        SubCategory::create($request->all());
        return response(null, 201);
    }

    public function show(SubCategory $subcategory)
    {
        SubCategoryResource::withoutWrapping();
        return new SubCategoryResource($subcategory);
    }

    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        $subcategory->update($request->all());
        return response(null, 200);
    }

    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        return response(null, 204);
    }
}
