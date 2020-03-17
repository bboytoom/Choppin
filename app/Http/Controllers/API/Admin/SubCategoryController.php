<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Http\Resources\SubCategory\SubCategoryCollection;
use App\Repositories\SubCategoryRepository;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    protected $subcat;
    private $pages = 10;

    public function __construct(SubCategoryRepository $subcat)
    {
        $this->subcat = $subcat;
    }

    public function index()
    {
        $subCategories = SubCategory::whereHas('category', function ($subCategoriesEstatus) {
            $subCategoriesEstatus->where('status', 1); 
        })->paginate($this->pages);

        return new SubCategoryCollection($subCategories);
    }

    public function store(SubCategoryRequest $request)
    {
        return response(null, $this->subcat->createSubCategory($request));
    }

    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        SubCategoryResource::withoutWrapping();
        return new SubCategoryResource($subcategory);
    }

    public function update(SubCategoryRequest $request, $id)
    {
        return response(null, $this->subcat->updateSubCategory($request, $id));
    }

    public function destroy($id)
    {
        return response(null, $this->subcat->deleteSubCategory($id));
    }
}
