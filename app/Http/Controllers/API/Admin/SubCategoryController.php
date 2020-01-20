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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $subCategories = SubCategory::whereHas('category', function ($subCategoriesEstatus) {
                $subCategoriesEstatus->where('status', 1); 
            })->paginate(10);

            return new SubCategoryCollection($subCategories);
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            SubCategory::create($request->all());
            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SubCategory $subcategory)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            SubCategoryResource::withoutWrapping();
            return new SubCategoryResource($subcategory);
        } else {
            abort(401);
        }
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
        if (config('app.key') == $request->header('x-api-key')) {
            $subcategory->update($request->all());
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubCategory $subcategory)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $subcategory->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
