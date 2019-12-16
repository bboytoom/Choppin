<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryCollection;
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
        return new SubCategoryCollection(SubCategory::paginate(10));
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
            'admin_id' => $request->get('admin_id'),
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name'), '-'),
            'description' => $request->get('description'),
            'status' => $request->get('status')
        ]);

        return response()->json(
        [
            'data' => [
                'subcategory' => [
                    'name' => $subcategory->name
                ]
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory =  SubCategory::find($id);

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
    public function update(SubCategoryRequest $request, $id)
    {
        $subcategory =  SubCategory::find($id);
        $subcategory->category_id = $request->get('category_id');
        $subcategory->name = $request->get('name');
        $subcategory->slug = Str::slug($request->get('name'), '-');
        $subcategory->description = $request->get('description');
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
    public function destroy($id)
    {
        $subcategory =  SubCategory::find($id);
        $subcategory->delete();

        return response(null, 204);
    }
}
