<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::paginate(10));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return response(null, 201);
    }

    public function show(Category $category)
    {
        CategoryResource::withoutWrapping();
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response(null, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(null, 204);
    }
}
