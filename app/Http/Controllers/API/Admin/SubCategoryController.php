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
    public function __construct()
    {
        $this->middleware("authheader");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::whereHas('category', function ($subCategoriesEstatus) {
            $subCategoriesEstatus->where('status', 1); 
        })->paginate(10);

        return new SubCategoryCollection($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        SubCategory::create($request->all());
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        SubCategoryResource::withoutWrapping();
        return new SubCategoryResource($subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        $subcategory->update($request->all());
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        return response(null, 204);
    }
}
