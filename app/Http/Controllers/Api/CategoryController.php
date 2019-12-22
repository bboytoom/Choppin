<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(Category::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'admin_id' => $request->get('admin_id'),
            'name' => strip_tags($request->get('name')),
            'slug' => Str::slug($request->get('name'), '-'),
            'description' => strip_tags($request->get('description')),
            'status' => $request->get('status')
        ]);

        return response()->json(
            [
                'data' => [
                    'category' => [
                        'name' => $category->name
                    ]
                ]
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  Category::find($id);

        if ($category == null) {
            return response(null, 404);
        }

        CategoryResource::withoutWrapping();
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category =  Category::find($id);

        if ($category == null) {
            return response(null, 404);
        }

        $category->name = strip_tags($request->get('name'));
        $category->slug = Str::slug($request->get('name'), '-');
        $category->description = strip_tags($request->get('description'));
        $category->status = $request->get('status');
        $category->save();

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
        $category =  Category::find($id);

        if ($category == null) {
            return response(null, 404);
        }
        
        $category->delete();

        return response(null, 204);
    }
}
