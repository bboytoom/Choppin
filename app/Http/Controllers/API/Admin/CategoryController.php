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
    private $pages = 10;

    public function __construct(CategoryRepository $cat)
    {
        $this->authorizeResource(Category::class, 'category');
        $this->cat = $cat;
    }

    public function index()
    {
        return new CategoryCollection(Category::paginate($this->pages));
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

    public function update(CategoryRequest $request, Category $category)
    {
        return response(null, $this->cat->updateCategory($request, $category));
    }

    public function destroy(Category $category)
    {
        return response(null, $this->cat->deleteCategory($category));
    }
}
