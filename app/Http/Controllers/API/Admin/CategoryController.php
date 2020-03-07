<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $cat;

    public function __construct(CategoryRepository $cat)
    {
        $this->cat = $cat;
    }

    public function index()
    {
        return new CategoryCollection(Category::paginate(10));
    }

    public function store(CategoryRequest $request)
    {
        return response(null, $this->cat->createCategory($request));
    }

    public function show(Category $category)
    {
        CategoryResource::withoutWrapping();
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request)
    {
        return response(null, $this->cat->updateCategory($request));
    }

    public function destroy($id)
    {
        return response(null, $this->cat->deleteCategory($id));
    }
}
