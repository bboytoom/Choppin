<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $subcategory = SubCategory::create([
            'category_id' => $request->get('category_id'),
            'name' => strip_tags($request->get('name')),
            'slug' => Str::slug($request->get('name'), '-'),
            'description' => strip_tags($request->get('description')),
            'status' => $request->get('status')
        ]);

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
        $subcategory->category_id = $request->get('category_id');
        $subcategory->name = strip_tags($request->get('name'));
        $subcategory->slug = Str::slug($request->get('name'), '-');
        $subcategory->description = strip_tags($request->get('description'));
        $subcategory->status = $request->get('status');
        $subcategory->save();

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
